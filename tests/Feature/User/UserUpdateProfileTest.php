<?php

namespace Tests\Feature\Admin;

use App\Models\Invitation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class UserUpdateProfileTest extends TestCase
{
    /**
     * Test user can update profile
     *
     */
    public function testUserCanUpdateProfile()
    {
        $user = User::orderByRaw('RAND()')->basic()->verified()->first();
        $this->loginAsUser($user);

        $newName = $this->faker->name();

        $response = $this->json('POST', route('user.update'), [
            'name' => $newName,
        ]);
        $response->assertStatus(self::RESPONSE_SUCCESS);
        $responseData = $response->getData()->data;

        // Check user new name
        $this->assertEquals($responseData->name, $newName);
    }

    /**
     * Test can upload and change avatar
     *
     */
    public function testUserCanUploadAvatar()
    {
        $user = User::orderByRaw('RAND()')->basic()->verified()->first();
        $this->loginAsUser($user);

        // Update user avatar - upload file 
        $response = $this->json('POST', route('user.update'), [
            'avatar' => UploadedFile::fake()->image('avatar.jpg'),
        ]);
        $response->assertStatus(self::RESPONSE_SUCCESS);
        $data = $response->getData()->data;
        Storage::disk('local')->assertExists($data->avatar_url);
    }

    public function testCannotUploadAvatarIfBig()
    {
        $user = User::orderByRaw('RAND()')->basic()->verified()->first();
        $this->loginAsUser($user);

        // Update user avatar - upload file 
        $response = $this->json('POST', route('user.update'), [
            'avatar' => UploadedFile::fake()->image('avatar.jpg', 300, 255),
        ]);
        $response->assertStatus(self::RESPONSE_ERROR);
    }
}
