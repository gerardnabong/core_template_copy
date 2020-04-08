<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use \GuzzleHttp\Client as GuzzleHttpClient;
use \GuzzleHttp\Exception\RequestException;
use \GuzzleHttp\Psr7\Response as GuzzleHttpResponse;
use App\Model\Client;
use App\Model\Portfolio;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Log;

class ApiController extends Controller
{

    private const LEAD_ID_NEW_CLIENT = 38000;

    public function loginClient(Request $request): JsonResponse
    {
        $url = env('MIX_PORTFOLIO_API_URL') . 'api/find-client';
        try {
            $client = new GuzzleHttpClient;
            $clientRequest = $client->post(
                $url,
                [
                    'form_params' => $request->all(),
                ]
            );
            $client = $this->saveClient($this->createClientArray($request, $clientRequest));
            return response()->json($client);
        } catch (RequestException $error) {
            switch ($error->getCode()) {
                case Response::HTTP_UNPROCESSABLE_ENTITY:
                    $message = 'Invalid Credentials';
                    break;
                default:
                    $message = 'An Error has occured';
                    break;
            }

            Log::error($error);
            return response()->json($message, $error->getCode());
        } catch (Exception $error) {
            Log::error($error);
            return response()->json('An Error has occured');
        }
    }

    private function createClientArray(Request $request, GuzzleHttpResponse $response): array
    {
        $client_data = json_decode($response->getBody()->getContents());
        return [
            'email_address' => $client_data->email_address,
            'ssn' => $request->ssn,
            'portfolio_id' => Portfolio::getPortfolio()->id,
            'lead_id' => $client_data->id,
            'lead_status_id' => $client_data->client_status ?? self::LEAD_ID_NEW_CLIENT,
        ];
    }

    private function saveClient($client): Client
    {
        return Client::create($client);
    }
}
