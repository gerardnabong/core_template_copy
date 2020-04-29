<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ClientInteractionRequest;
use App\Model\ClientInteraction;
use Exception;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Response as GuzzleHttpResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Log;
use stdClass;

class ClientInteractionController extends Controller
{
    public function store(ClientInteractionRequest $request): JsonResponse
    {
        return response()->json(ClientInteraction::create($request->all()), 200);
    }

    public function update(ClientInteractionRequest $request, ClientInteraction $clientInteraction): void
    {
        $clientInteraction->update($request->all());
    }
}
