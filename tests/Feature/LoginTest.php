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
        $admin = User::admin()->first();
        $response = $this->json('POST', route('auth.login', [
            'user_name' => $admin->user_name,
            'password' => self::PASSWORD,
        ]));

        $response
            ->assertStatus(self::RESPONSE_SUCCESS);
    }

    /**
     * Test basic user can login
     *
     */
    public function testBasicUserCanLogin()
    {
        $user = User::basic()->first();
        $response = $this->json('POST', route('auth.login', [
            'user_name' => $user->user_name,
            'password' => self::PASSWORD,
        ]));
        $responseData = $response->getData()->data;
        $response->assertStatus(self::RESPONSE_SUCCESS);

        $this->assertEquals($responseData->email, $user->email);
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
        $response->assertStatus(self::RESPONSE_ERROR);
    }
}
