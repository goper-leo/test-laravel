<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\User\VerifyRequest;
use App\Http\Resources\UserResource;

class IndexController extends Controller
{
    /**
     * Verify user
     *
     * @param Type $var
     * @return void
     */
    public function verify(VerifyRequest $request)
    {
        return new UserResource(tap(auth()->user())->update([
            'is_verified' => true
        ]));
    }
}
