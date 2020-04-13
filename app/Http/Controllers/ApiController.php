<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ApiLoginRequest;
use App\Http\Requests\LogoutRequest;
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
    public function loginClient(ApiLoginRequest $request): JsonResponse
    {
        $response = null;
        $status_code = Response::HTTP_OK;
        $url = env('MIX_PORTFOLIO_API_URL') . 'api/find-client';
        try {
            $client = new GuzzleHttpClient;
            $api_response = $client->post($url, ['form_params' => $request->all()]);
            $api_decoded_response = $this->decodeApiResponse($api_response);
            $client_data = $this->createClientArray($api_decoded_response);
            $client = $this->saveClient($request, $client_data, $api_decoded_response);
            $response = $client;
        } catch (RequestException $exception) {
            switch ($exception->getCode()) {
                case Response::HTTP_UNPROCESSABLE_ENTITY:
                case Response::HTTP_NOT_FOUND:
                    $message = 'Invalid Credentials';
                    break;
                default:
                    $message = 'An Error has occured';
                    Log::error($exception);
                    break;
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
            'client_status_id' => $response->client_status ?? Client::CLIENT_STATUS_NEW_CLIENT,
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

    public function verifyBankDetails(VerifyBankDetailRequest $request): void
    {
        // TODO add implementation when the api is available
    }
}
