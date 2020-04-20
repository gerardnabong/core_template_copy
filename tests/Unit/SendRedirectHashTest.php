<?php

declare(strict_types=1);

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response as GuzzleResponse;

class SendRedirectHashTest extends TestCase
{
    protected $mockHandler;
    protected $httpClient;

    protected function setUp(): void
    {
        parent::setup();

        $this->mockHandler = new MockHandler();

        $this->httpClient = new Client([
            'handler' => $this->mockHandler,
        ]);
    }

    public function testIfHashIsSend()
    {
        $this->withoutExceptionHandling();
        $this->mockHandler->append(new GuzzleResponse(Response::HTTP_OK));
        $this->httpClient->request('POST', '/api/send-redirect-query');
        $this->postJson('/api/send-redirect-query', ['hash' => 'dwasdwasdwadsda'])->assertOk();
        $this->mockHandler->reset();
    }

    public function testIfHashIsNotIncluded()
    {
        $this->mockHandler->append(new GuzzleResponse(Response::HTTP_UNPROCESSABLE_ENTITY));
        $this->httpClient->request('POST', '/api/send-redirect-query');
        $this->postJson('/api/send-redirect-query')->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $this->mockHandler->reset();
    }
}
