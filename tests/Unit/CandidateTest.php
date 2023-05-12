<?php

namespace Tests\Feature;

use App\Models\Candidate;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CandidateTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_post_candidate_with_manager_role(): void
    {
        $login = $this->post('/api/auth', [ "username" => "tester", "password" => "PASSWORD" ]);
        $token = $login->json()['data']['token'];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('/api/lead', [ "name" => "Mi candidato", "source" => "Foto casa", "owner" => 1 ]);
        $response->assertStatus(200);
    }

    public function test_post_candidate_with_agent_role(): void
    {
        $login = $this->post('/api/auth', [ "username" => "agent", "password" => "PASSWORD" ]);
        $token = $login->json()['data']['token'];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('/api/lead', [ "name" => "Mi candidato", "source" => "Foto casa", "owner" => 1 ]);

        $response->assertStatus(401);
    }

    public function test_get_leads_with_token(): void
    {
        $login = $this->post('/api/auth', [ "username" => "tester", "password" => "PASSWORD" ]);
        $token = $login->json()['data']['token'];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/leads');

        $response->assertStatus(200);
    }

    public function test_get_leads_without_token(): void
    {
        $response = $this->get('/api/lead/1');

        $response->assertStatus(401);
    }

    public function test_get_an_lead_with_token(): void
    {
        $login = $this->post('/api/auth', [ "username" => "tester", "password" => "PASSWORD" ]);
        $token = $login->json()['data']['token'];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/leads');

        $response->assertStatus(200);
    }

    public function test_get_an_lead_without_token(): void
    {
        $response = $this->get('/api/lead/1');

        $response->assertStatus(401);
    }

    public function test_get_an_lead_who_is_not_assigned_with_an_manager_role(): void
    {
        $login = $this->post('/api/auth', [ "username" => "tester", "password" => "PASSWORD" ]);
        $token = $login->json()['data']['token'];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/lead/8');

        $response->assertStatus(200);
    }

    public function test_get_an_lead_who_is_not_assigned_with_an_agent_role(): void
    {
        $login = $this->post('/api/auth', [ "username" => "agent", "password" => "PASSWORD" ]);
        $token = $login->json()['data']['token'];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/lead/1');

        $response->assertStatus(404);
    }

}
