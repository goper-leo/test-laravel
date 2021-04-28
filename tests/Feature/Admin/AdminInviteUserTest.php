<?php

namespace Tests\Feature\Admin;

use App\Models\Invitation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class AdminInviteUserTest extends TestCase
{
    /**
     * Test admin can send email invitations
     *
     */
    public function testAdminSendInvitation()
    {
        $this->loginAsAdmin();
        $email = $this->faker->email();
        
        $response = $this->json('POST', route('admin.user.send.invitations', [
            'email' => $email,
        ]));

        $data = $response->getData();
        $response
            ->assertStatus(self::RESPONSE_POST_SUCCESS);

        // Check email is present on database 
        $this->assertNotNull(Invitation::whereEmail($email)->first());
    }

    /**
     * @depends testAdminSendInvitation
     */
    public function testAdminCannotSendInvitation()
    {
        $this->loginAsAdmin();
        // Test duplicate email on invitation
        $email = Invitation::orderByRaw('RAND()')->first()->email;

        $response = $this->json('POST', route('admin.user.send.invitations', [
            'email' => $email,
        ]));
        $response
            ->assertStatus(self::RESPONSE_ERROR);
    }
}
