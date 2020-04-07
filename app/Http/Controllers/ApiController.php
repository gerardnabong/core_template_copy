<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ApiLoginRequest;
use App\Http\Requests\LogoutRequest;
use App\Model\Client;
use App\Model\Portfolio;
use Exception;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Response as GuzzleHttpResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Log;

class ApiController extends Controller
{
    public function loginClient(ApiLoginRequest $request): JsonResponse
    {
        // TODO: create facade for those apis for mock the response in tests
        $url = env('MIX_PORTFOLIO_API_URL') . 'api/find-client';
        try {
            $client = new GuzzleHttpClient;
            $api_response = $client->post($url, ['form_params' => $request->all()]);
            $api_decoded_response = $this->decodeApiResponse($api_response);
            $client_data = $this->createClientArray($api_decoded_response);
            $client = $this->saveClient($client_data, $api_decoded_response, $request);
            return response()->json($client);
        } catch (RequestException $exception) {
            switch ($exception->getCode()) {
                case Response::HTTP_UNPROCESSABLE_ENTITY:
                    $message = 'Invalid Credentials';
                    break;
                default:
                    $message = 'An Error has occured';
                    Log::error($exception);
                    break;
            }
            return response()->json(['message' => $message], $exception->getCode());
        } catch (Exception $exception) {
            Log::error($exception);
            return response()->json(['message' => 'An Error has occured']);
        }
    }

    public function decodeApiResponse(GuzzleHttpResponse $api_response): object
    {
        return json_decode($api_response->getBody()->getContents());
    }

    private function createClientArray(object $response): array
    {
        return [
            'portfolio_id' => Portfolio::getPortfolio()->id,
            'lead_id' => $response->id,
            'lead_status_id' => $response->client_status ?? Client::CLIENT_STATUS_NEW_CLIENT,

        ];
    }

    private function saveClient(array $client_Data, object $api_response, ApiLoginRequest $request): Client
    {
        // TODO: Implement Spatie/Laravel Permission based on lead_status_id
        $client = Client::create($client_Data);
        $client->email_address = $api_response->email_address;
        $client->ssn = $request->ssn;
        $client->hash = Client::setHashClient($client);
        return $client;
    }

    public function logout(LogoutRequest $request)
    {
        Client::logout($request->hashKey);
    }
}
