<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ClientInteractionRequest;
use App\Model\ClientInteraction;
use App\Model\Client;
use App\Model\Portfolio;
use Exception;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Response as GuzzleHttpResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Log;
use stdClass;

class ClientInteractionController extends Controller
{
    public function store(ClientInteractionRequest $request): JsonResponse
    {
        $this->sendClientUpdate(collect(['client_hash' => $request->client_hash, 'field' => $request->button_name]));
        return response()->json(ClientInteraction::create($request->except(['client_hash'])), 200);
    }

    public function update(ClientInteractionRequest $request, ClientInteraction $clientInteraction): void
    {
        $this->sendClientUpdate(collect(['client_hash' => $request->client_hash, 'field' => $request->button_name]));
        $clientInteraction->update($request->except(['client_hash']));
    }

    private function sendClientUpdate(Collection $data): void
    {
        try {
            $client_hash = Client::getHashClient($data->client_hash);
            $form_params = [
                'email_address' => $client_hash->email_address,
                'ssn' => $client_hash->ssn,
                'id' => $client_hash->lead_id,
                'field' => $data->field,
            ];
            $url = Portfolio::getPortfolio()->getPortfolioApiUrl('api/update-client');
            $client = new GuzzleHttpClient;
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
}
