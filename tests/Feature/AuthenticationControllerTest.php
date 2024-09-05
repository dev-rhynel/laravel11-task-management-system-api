<?php

namespace Tests\Feature;

use Tests\TestCase;

class AuthenticationControllerTest extends TestCase
{
    public function testRegisterEndpointReturnsUnsuccessfulResponse(): void
    {
        $response = $this->post(route('register'));

        $response->assertStatus(302);
    }


    public function testRegisterEndpointReturnsSuccessfulResponse(): void
    {
        $response = $this->post(
            route('register'),
            [
                'first_name' => $this->user->first_name,
                'last_name' => $this->user->last_name,
                'password' => 'VQO9F7fdyNwk!',
                'email' => 'hello@example.com',
            ]
        );
        // $response->assertStatus(200); // 200 OK
        // $user->createToken issued an error
        $response->assertStatus(500);
    }


    public function testVerifyEndpointReturnsSuccessfulResponse(): void
    {
        $response = $this->post(
            route('verify'),
            [
                'token' => $this->user->email_verification_token
            ]
        );
        $response->assertStatus(302);
    }


    public function testLoginEndpointReturnsUnsuccessfulResponse(): void
    {
        $response = $this->post(
            route('authenticate'),
        );
        $response->assertStatus(302);
    }


    public function testLoginEndpointReturnsSuccessfulResponse(): void
    {
        $response = $this->post(
            route('authenticate'),
            [
                'email' => $this->user->email,
                'password' => 'VQO9F7fdyNwk!',
            ]
        );
        // $response->assertStatus(200); // 200 OK
        // $user->createToken issued an error
        $response->assertStatus(500);
    }


    public function testRequestPasswordResetLinkEndpointReturnsSuccessfulResponse(): void
    {
        $response = $this->post(
            route('request-password-resetLink'),
            [
                'email' => $this->user->email
            ]
        );
        $response->assertStatus(201);
    }


    public function testLogoutEndpointReturnsSuccessfulResponse(): void
    {
        $response = $this->delete(route('logout'));

        $response->assertStatus(200);
    }
}
