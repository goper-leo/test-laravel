<?php

namespace Tests\Feature\Admin;

use App\Models\Invitation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserSignupTest extends TestCase
{
    /**
     * Test user can sign up
     *
     */
    public function testInvitedUserCanSignUp()
    {
        $invitee = Invitation::orderByRaw('RAND()')->first();

        $username = $this->faker->userName();

        $response = $this->json('POST', route('auth.sign_up.store', [
            'code' => $invitee->code,
        ]), [
            'user_name' => $username,
            'password' => self::PASSWORD,
            'password_confirmation' => self::PASSWORD,
            'code' => $invitee->code,
        ]);
        $data = $response->getData();
        $response
            ->assertStatus(self::RESPONSE_POST_SUCCESS);

        // Check username is present on database 
        $signupUser = User::where(['user_name' => $username])->first();
        $this->assertNotNull($signupUser);
        $this->assertNotNull($signupUser->password);
        // Check user has `pin`
        $this->assertNotNull($signupUser->pin);
        // Check user is not verified
        $this->assertFalse($signupUser->is_verified);
        $this->assertNull(Invitation::whereEmail($invitee->email)->first());
    }

    /**
     * Invited user cannot sign up
     *
     */
    public function testInvitedUserCannotSignup()
    {
        $invitee = Invitation::orderByRaw('RAND()')->first();
        $username = $this->faker->userName();
        // test user that have no code
        $response = $this->json('POST', route('auth.sign_up.store', [
            'code' => $invitee->code,
        ]), [
            'user_name' => $username,
            'password' => self::PASSWORD,
            'password_confirmation' => self::PASSWORD,
        ]);
        $response
            ->assertStatus(self::RESPONSE_ERROR);
        // Wrong code 
        $response = $this->json('POST', route('auth.sign_up.store', [
            'code' => 'wrong_code',
        ]), [
            'user_name' => $username,
            'password' => self::PASSWORD,
            'password_confirmation' => self::PASSWORD,
            'code' => 'wrong_code',
        ]);
        $response->assertStatus(self::RESPONSE_ERROR);
    }
}
