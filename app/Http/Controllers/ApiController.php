<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Model\Login;
use App\Model\Portfolio;

class ApiController extends Controller
{

    private const LEAD_ID_NEW_CLIENT = 38000;

    public function loginClient(Request $credentials): JsonResponse
    {
        $url = env('MIX_PORTFOLIO_API_URL') . 'api/find-client';
        try {
            $client = new \GuzzleHttp\Client();
            $request = $client->post(
                $url,
                [
                    'form_params' => $credentials->all()
                ]
            );
            $client = $this->saveClient($this->createClientArray($credentials, $request));
            return response()->json($client);
        } catch (\GuzzleHttp\Exception\RequestException $error) {
            switch ($error->getCode()) {
                case 422:
                    $message = 'Invalid Credentials';
                    break;
                default:
                    $message = 'An Erroc has Occured';
                    break;
            }

            return response()->json($message, $error->getCode());
        }
    }

    private function createClientArray(Request $credentials, \GuzzleHttp\Psr7\Response $request): array
    {
        $client_data = json_decode($request->getBody()->getContents());
        return [
            'email_address' => $client_data->email_address,
            'ssn' => $credentials->ssn,
            'portfolio_id' => Portfolio::getPortfolio()->id,
            'lead_id' => $client_data->id,
            'lead_status_id' => $client_data->client_status ?? self::LEAD_ID_NEW_CLIENT,
        ];
    }

    private function saveClient($client): Login
    {
        return Login::create($client);
    }
}
