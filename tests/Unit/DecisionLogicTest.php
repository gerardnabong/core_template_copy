<?php

declare(strict_types=1);

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Http\Response;

class DecisionLogicTest extends TestCase
{
    private $client = null;

    private function login(): void
    {
        $params = [
            'email_address' => 'john_buster@email.com',
            'ssn' => '583139200',
        ];
        $this->client = $this->postJson(route('login.client'), $params);
    }

    public function testIfUserIsHasValidAccountAndRoutingNumber()
    {
        $this->login();
        $params = [
            'account_number' => '210129010',
            'routing_number' => '111323809',
            'token' => $this->client['hash'],
        ];

        $this->postJson(route('verify.bank_details'), $params)->assertOk();
    }

    public function testIfUserIsHasInalidAccountNumber()
    {
        $this->login();
        $params = [
            'account_number' => '2467859410',
            'routing_number' => '111323809',
            'token' => $this->client['hash'],
        ];

        $this->postJson(route('verify.bank_details'), $params)->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function testIfUserIsHasInalidRoutingNumber()
    {
        $this->login();
        $params = [
            'account_number' => '210129010',
            'routing_number' => '040121000',
            'token' => $this->client['hash'],
        ];

        $this->postJson(route('verify.bank_details'), $params)->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function testIfHashIsMissing()
    {
        $params = [
            'account_number' => '210129010',
            'routing_number' => '111323809',
        ];

        $this->postJson(route('verify.bank_details'), $params)->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
