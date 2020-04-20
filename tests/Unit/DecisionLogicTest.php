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
            'email_address' => 'celine.oropesa@email.com',
            'ssn' => '357422009',
        ];
        $this->client = $this->postJson(route('login.client'), $params);
    }

    public function testIfUserIsHasValidAccountAndRoutingNumber()
    {
        $this->login();
        $params = [
            'account_number' => '2467859400',
            'routing_number' => '040120000',
            'token' => $this->client['hash'],
        ];

        $this->postJson(route('verify.bank_details'), $params)->assertOk();
    }

    public function testIfUserIsHasInalidAccountNumber()
    {
        $this->login();
        $params = [
            'account_number' => '2467859410',
            'routing_number' => '040120000',
            'token' => $this->client['hash'],
        ];

        $this->postJson(route('verify.bank_details'), $params)->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function testIfUserIsHasInalidRoutingNumber()
    {
        $this->login();
        $params = [
            'account_number' => '2467859400',
            'routing_number' => '040121000',
            'token' => $this->client['hash'],
        ];

        $this->postJson(route('verify.bank_details'), $params)->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function testIfHashIsMissing()
    {
        $params = [
            'account_number' => '2467859400',
            'routing_number' => '040120000',
        ];

        $this->postJson(route('verify.bank_details'), $params)->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
