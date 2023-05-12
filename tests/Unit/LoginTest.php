<?php

namespace Tests\Feature;

use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_the_login(): void
    {
        $response = $this->post('/api/auth', [ "username" => "tester", "password" => "PASSWORD" ]);
        $response->assertStatus(200);
    }
}
