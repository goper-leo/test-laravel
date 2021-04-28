<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, WithFaker;

    const RESPONSE_SUCCESS = 200;
    const RESPONSE_POST_SUCCESS = 201;
    const RESPONSE_ERROR = 422;

    const PASSWORD = 'secret';
    
    /**
     * Authenticated user
     *
     * @var [type]
     */
    public $auth;

    /**
     * Login as admin
     *
     * @return void
     */
    public function loginAsAdmin()
    {
        $admin = User::orderByRaw('RAND()')->admin()->first();
        $this->auth = $admin;
        Sanctum::actingAs($admin, ['*']);
    }

    /**
     * Login as user
     *
     * @return void
     */
    public function loginAsUser()
    {
        $user = User::orderByRaw('RAND()')->basic()->first();
        $this->auth = $user;
        Sanctum::actingAs($user, ['*']);
    }
}
