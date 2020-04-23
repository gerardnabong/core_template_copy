<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ApiLoginRequest;
use App\Http\Requests\CheckVerificationRequest;
use App\Http\Requests\LogoutRequest;
use App\Http\Requests\NewLoanRequest;
use App\Http\Requests\SendRedirectHashRequest;
use App\Http\Requests\VerifyBankDetailRequest;
use App\Model\Client;
use App\Model\Portfolio;
use Exception;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Response as GuzzleHttpResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Log;
use stdClass;

class ApiController extends Controller
{
    const DECISION_LOGIC_URL = 'https://www.decisionlogic.com/';

    public function loginClient(ApiLoginRequest $request): JsonResponse
    {
        $response = null;
        $status_code = Response::HTTP_OK;
        $url = getPortfolioApiUrl() . 'api/find-client';
        $form_params = [
            'email_address' => $request->email_address,
            'ssn' => $request->ssn,
            'portfolio_id' => Portfolio::getPortfolio()->lead_portfolio_id,
        ];
        try {
            $client = new GuzzleHttpClient;
            $api_response = $client->post(
                $url,
                [
                    'query' => ['waf' => config_safe('app.waf')],
                    'form_params' => $form_params,
                ]
            );
            $api_decoded_response = $this->decodeApiResponse($api_response);
            $client_data = $this->createClientArray($api_decoded_response);
            if ($client_data['client_status_id']) {
                $client = $this->saveClient($request, $client_data, $api_decoded_response);
                $response = $client;
            } else {
                $response = ['message' => 'Client not found'];
                $status_code = Response::HTTP_NOT_FOUND;
            }
        } catch (RequestException $exception) {
            switch ($exception->getCode()) {
                case Response::HTTP_UNPROCESSABLE_ENTITY:
                    $message = 'Invalid Credentials';
                    break;
                default:
                    $message = 'An Error has occured';
                    Log::error($exception);
            }
            $response = ['message' => $message];
            $status_code = $exception->getCode();
        } catch (Exception $exception) {
            Log::error($exception);
            $response = [['message' => 'An Error has occured']];
        }

        return response()->json($response, $status_code);
    }

    public function decodeApiResponse(GuzzleHttpResponse $api_response): stdClass
    {
        return json_decode($api_response->getBody()->getContents());
    }

    private function createClientArray(stdClass $response): array
    {
        return [
            'portfolio_id' => Portfolio::getPortfolio()->id,
            'lead_id' => $response->id,
            'client_status_id' => $response->client_status,
        ];
    }

    private function saveClient(ApiLoginRequest $request, array $client_Data, stdClass $api_response): Client
    {
        $client = Client::create($client_Data);
        $client->email_address = $api_response->email_address;
        $client->ssn = $request->ssn;
        $client->first_name = $api_response->first_name;
        $client->hash = Client::setHashClient($client);
        return $client;
    }

    public function logout(LogoutRequest $request): void
    {
        Client::logout($request->hash);
    }

    public function verifyBankDetails(VerifyBankDetailRequest $request): JsonResponse
    {
        // TODO Create a global function for checking and returning expired cache
        $response = null;
        $status_code = Response::HTTP_OK;
        $hash_client = Client::getHashClient($request->token);
        if ($hash_client) {
            $api_request_data = [
                'email_address' => $hash_client->email_address,
                'ssn' => $hash_client->ssn,
                'id' => $hash_client->lead_id,
                'bank_account_number' => $request->account_number,
                'bank_routing_number' => $request->routing_number,
            ];
            $url = getPortfolioApiUrl() . 'api/request-client-code';
            try {
                $client = new GuzzleHttpClient;
                $api_response = $client->post(
                    $url,
                    [
                        'query' => ['waf' => config_safe('app.waf')],
                        'form_params' => $api_request_data,
                    ]
                );
                $response = [
                    'decision_logic_url' => self::DECISION_LOGIC_URL,
                    'request_code' =>  json_decode($api_response->getBody()->getContents()),
                    'bank_account_number' => $request->account_number,
                    'bank_routing_number' => $request->routing_number,
                ];
            } catch (RequestException $exception) {
                switch ($exception->getCode()) {
                    case Response::HTTP_UNPROCESSABLE_ENTITY:
                        $message = 'Invalid Credentials';
                        break;
                    default:
                        $message = 'An Error has occured';
                        Log::error($exception);
                }
                $response = ['message' => $message];
                $status_code = $exception->getCode();
            } catch (Exception $exception) {
                Log::error($exception);
                $response = [['message' => 'An Error has occured']];
            }
        } else {
            $response = ['message' => 'Expired Session'];
            $status_code = Response::HTTP_UNAUTHORIZED;
        }
        return response()->json($response, $status_code);
    }

    public function checkVerificationStatus(CheckVerificationRequest $request): JsonResponse
    {
        $client = Client::getHashClient($request->token);
        $response = [];
        $status_code = Response::HTTP_OK;
        if ($client) {
            $url = getPortfolioApiUrl() . 'api/verify-status';
            $form_params = [
                'bank_account_number' => $request->bank_account_number,
                'bank_routing_number' => $request->bank_routing_number,
                'id' => $client->lead_id,
                'request_code' => $request->request_code,
            ];
            try {
                $client = new GuzzleHttpClient;
                $api_response = $client->post(
                    $url,
                    [
                        'query' => ['waf' => config_safe('app.waf')],
                        'form_params' => $form_params,
                    ]
                );
                $response = json_decode($api_response->getBody()->getContents());
            } catch (RequestException $exception) {
                switch ($exception->getCode()) {
                    case Response::HTTP_UNPROCESSABLE_ENTITY:
                        $message = 'Invalid Credentials';
                        break;
                    default:
                        $message = 'An Error has occured';
                        Log::error($exception);
                }
                $response = ['message' => $message];
                $status_code = $exception->getCode();
            } catch (Exception $exception) {
                Log::error($exception);
                $response = [['message' => 'An Error has occured']];
            }
        } else {
            $response = ['message' => 'Expired Session'];
        }
        return response()->json($response, $status_code);
    }
    public function sendRedirectQuery(SendRedirectHashRequest $request): void
    {
        try {
            $url = env('MIX_PORTFOLIO_API_URL') . 'api/channel-tracking';
            $client = new GuzzleHttpClient;
            $form_params = [
                'hash' => $request->hash,
                'ip_address' => $this->getIp(),
            ];
            $client->post(
                $url,
                [
                    'query' => ['waf' => config_safe('app.waf')],
                    'form_params' => $form_params,
                ]
            );
        } catch (RequestException $exception) {
            Log::error($exception);
            $this->sendRedirectQuery($request);
        } catch (Exception $exception) {
            Log::error($exception);
        }
    }

    private function getIP(): string
    {
        $ip_address = '0.0.0.0'; // safety incase ip is hidden / localhost
        $keys = [
            'HTTP_CLIENT_IP',
            'HTTP_X_FORWARDED_FOR',
            'HTTP_X_FORWARDED',
            'HTTP_X_CLUSTER_CLIENT_IP',
            'HTTP_FORWARDED_FOR',
            'HTTP_FORWARDED',
            'REMOTE_ADDR',
        ];

        foreach ($keys as $key) {
            $ip = $_SERVER[$key] ?? null;
            if (
                $ip &&
                filter_var(
                    $ip,
                    FILTER_VALIDATE_IP,
                    FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE
                ) !== false
            ) {
                $ip_address = $ip;
                break;
            }
        }
        return $ip_address;
    }

    public function registerClient(ApiLoginRequest $request): JsonResponse
    {
        $client = $this->loginClient($request);
        $response = json_decode($client->content());
        $status_code = $client->status();
        if (isset($response->client_status_id) && $response->client_status_id !== Client::CLIENT_STATUS_NEW_CLIENT) {
            Client::logout($response->hash);
            $response = ['message' => 'Invalid Credentials'];
            $status_code = Response::HTTP_UNAUTHORIZED;
        }
        return response()->json($response, $status_code);
    }

    public function requestNewLoan(NewLoanRequest $request): JsonResponse
    {
        $response = [];
        $status_code = Response::HTTP_OK;
        $hash_client = Client::getHashClient($request->token);
        if ($hash_client) {
            $api_request_data = [
                'id' => $hash_client->lead_id,
            ];
            $url = getPortfolioApiUrl() . 'api/reapply-lead';
            try {
                $client = new GuzzleHttpClient;
                $api_response = $client->post(
                    $url,
                    [
                        'query' => ['waf' => config_safe('app.waf')],
                        'form_params' => $api_request_data,
                    ]
                );
                $response = json_decode($api_response->getBody()->getContents());
            } catch (RequestException $exception) {
                switch ($exception->getCode()) {
                    case Response::HTTP_UNPROCESSABLE_ENTITY:
                        $message = 'Invalid Credentials';
                        break;
                    default:
                        $message = 'An Error has occured';
                        Log::error($exception);
                }
                $response = ['message' => $message];
                $status_code = $exception->getCode();
            } catch (Exception $exception) {
                Log::error($exception);
                $response = [['message' => 'An Error has occured']];
                $status_code = $exception->getCode();
            }
        } else {
            $response = ['message' => 'Expired Session'];
            $status_code = Response::HTTP_UNAUTHORIZED;
        }
        return response()->json($response, $status_code);
    }
}
