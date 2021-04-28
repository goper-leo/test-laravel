<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MiddlewareTests extends TestCase
{
    
    public function testUserCannotAccessAdminRoute()
    {
        $this->loginAsUser();

        $email = $this->faker->email();
        $response = $this->json('POST', route('admin.user.send.invitations', [
            'email' => $email,
        ]));
        $response
            ->assertStatus(self::RESPONSE_ERROR_FORBIDDEN);
    }
}
