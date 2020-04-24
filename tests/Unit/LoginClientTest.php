<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Model\Client;
use Illuminate\Http\Response;
use Tests\TestCase;

class LoginClientTest extends TestCase
{
    public function testSuccessLoginClient()
    {
        $params = [
            'email_address' => 'john_buster@email.com',
            'ssn' => '583139200',
        ];
        $response = $this->post(route('login.client'), $params);
        $response->assertOk();
        $response->assertJsonPath('client_status_id', Client::CLIENT_STATUS_NEW_CLIENT);
    }

    public function testClientNotFoundLoginClient()
    {
        $params = [
            'email_address' => 'aguinaldogemil+9@gmail.com',
            'ssn' => '612388829',
        ];
        $response = $this->post(route('login.client'), $params);
        $response->assertNotFound();
        $response->assertExactJson([
            'message' => 'Client not found',
        ]);
    }

    public function testErrorLoginClient()
    {
        $params = [
            'email_address' => 'john_buster@email.com',
            'ssn' => '357422000',
        ];
        $response = $this->post(route('login.client'), $params);
        $response->assertNotFound();
        $response->assertExactJson([
            'message' => 'An Error has occured',
        ]);
    }

    public function testSuccessRegisterClient()
    {
        $params = [
            'email_address' => 'john_buster@email.com',
            'ssn' => '583139200',
        ];
        $response = $this->post(route('register.client'), $params);
        $response->assertOk();
        $response->assertJsonPath('client_status_id', Client::CLIENT_STATUS_NEW_CLIENT);
    }

    public function testShouldNotRegisterClient()
    {
        $params = [
            'email_address' => 'abigail+test@arbcalls.com',
            'ssn' => '303157353',
        ];
        $response = $this->post(route('register.client'), $params);
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }
}
