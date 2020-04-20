<?php

declare(strict_types=1);

namespace Tests\Unit;

use Illuminate\Http\Response;
use Tests\TestCase;

class SendRedirectHashTest extends TestCase
{
    public function testIfHashIsSend()
    {
        $this->postJson('/api/send-redirect-query', ['hash' => 'dwasdwasdwadsda'])->assertOk();
    }

    public function testIfHashIsNotIncluded()
    {
        $this->postJson('/api/send-redirect-query')->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
