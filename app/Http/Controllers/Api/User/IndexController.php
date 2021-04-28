<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\User\VerifyRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\UserResource;

class IndexController extends Controller
{
    /**
     * Get auth user
     *
     * @return void
     */
    public function index()
    {
        return new UserResource(auth()->user());
    }

    /**
     * Verify user
     *
     * @param Type $var
     * @return App\Http\Resources\UserResource
     */
    public function verify(VerifyRequest $request)
    {
        return new UserResource(tap(auth()->user())->update([
            'is_verified' => true,
            'registered_at' => now()
        ]));
    }

    /**
     * Update user profile
     *
     * @param UpdateRequest $request
     * @return App\Http\Resources\UserResource
     */
    public function update(UpdateRequest $request)
    {
        $user = auth()->user();

        if ($request->filled('name'))
            $user->name = $request->name;

        if ($request->filled('user_name'))
            $user->user_name = $request->user_name;

        if ($request->filled('email'))
            $user->email = $request->email;

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store("avatars/$user->id");
            $user->avatar_url = $path;
        }

        $user->save();

        return new UserResource($user);
    }
}
