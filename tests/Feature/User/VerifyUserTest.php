<?php

namespace Tests\Feature\Admin;

use App\Models\Invitation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VerifyUserTest extends TestCase
{
    /**
     * Test user can verify its account using pin
     *
     */
    public function testUserCanVerifyAccount()
    {
        $user = User::orderByRaw('RAND()')->unVerified()->first();
        $this->loginAsUser($user);
        $response = $this->json('POST', route('user.verify'), [
            'pin' => $user->pin,
        ]);
        $response->assertStatus(self::RESPONSE_SUCCESS);

        // Check user is verified
        $verifiedUser = User::find($user->id);
        $this->assertNotNull($verifiedUser);
        $this->assertTrue($verifiedUser->is_verified);
    }

    /**
     * Test user cannot verify
     *
     */
    public function testUserCannotVerifyAccount()
    {
        $user = User::orderByRaw('RAND()')->unVerified()->first();
        $this->loginAsUser($user);

        // Wrong pin given
        $response = $this->json('POST', route('user.verify'), [
            'pin' => $this->faker->randomDigit(),
        ]);
        $response->assertStatus(self::RESPONSE_ERROR);

        // Error when user is already verified
        $user = User::orderByRaw('RAND()')->verified()->first();
        $this->loginAsUser($user);
        $response = $this->json('POST', route('user.verify'), [
            'pin' => $user->pin,
        ]);
        $response->assertStatus(self::RESPONSE_ERROR_FORBIDDEN);
    }
}
