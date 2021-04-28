<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * Test admin can login
     *
     */
    public function testAdminCanLogin()
    {
        $admin = User::where('user_role', User::ADMIN)->first();
        $response = $this->json('POST', route('auth.login', [
            'user_name' => $admin->user_name,
            'password' => 'secret',
        ]));

        $data = $response->getData();
        $response
            ->assertStatus(self::RESPONSE_SUCCESS);
    }

    /**
     * Test cannot login if credentials are wrong
     *
     */
    public function testCannotLogin()
    {
        $response = $this->json('POST', route('auth.login', [
            'user_name' => 'user_name-doesnotexist',
            'password' => 'secret123123123',
        ]));
        $response
            ->assertStatus(self::RESPONSE_ERROR);
    }
}
