<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\SignupRequest;
use App\Models\Invitation;
use App\Models\User;
use App\Http\Resources\UserResource;

class SignUpController extends Controller
{
    /**
     * Display sign-up view
     *
     * @param [type] $code
     * @return void
     */
    public function index($code)
    {
        # code...
    }

    /**
     * Store user
     *
     * @return App\Http\Resources\UserResource
     */
    public function store(SignupRequest $request)
    {
        $invitation = Invitation::whereCode($request->code)->firstOrFail();
        return new UserResource(User::create([
            'email' => $invitation->email,
            'password' => $request->password,
            'user_name' => $request->user_name,
            'registered_at' => now(),
            'pin' => rand(60000, 999999),
        ]));
    }
}
