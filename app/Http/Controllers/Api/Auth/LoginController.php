<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;

class LoginController extends Controller
{
    /**
     * Login
     *
     * @return void
     */
    public function index(LoginRequest $request)
    {
        $user = User::where('user_name', $request->user_name)->firstOrFail();
        $token = $user->createToken(config('app.name'))->plainTextToken;

        return (new UserResource($user))->additional(['meta' => [
            'token' => $token,
        ]]);
    }
}
