<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ApiLoginRequest;
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
        $url = env('MIX_PORTFOLIO_API_URL') . 'api/find-client';
        try {
            $client = new GuzzleHttpClient;
            $api_response = $client->post(
                $url,
                [
                    'form_params' => $request->all(),
                ]
            );
            $client = $this->saveClient($this->createClientArray($request, $api_response));
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

    private function createClientArray(ApiLoginRequest $request, GuzzleHttpResponse $response): array
    {
        $client_data = json_decode($response->getBody()->getContents());
        return [
            'email_address' => $client_data->email_address,
            'ssn' => $request->ssn,
            'portfolio_id' => Portfolio::getPortfolio()->id,
            'lead_id' => $client_data->id,
            'lead_status_id' => $client_data->client_status ?? Client::LEAD_ID_NEW_CLIENT,
        ];
    }

    private function saveClient($client): Client
    {
        return Client::create($client);
    }
}
