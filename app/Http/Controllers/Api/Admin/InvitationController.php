<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Invitation\StoreRequest;
use App\Models\Invitation;
use Illuminate\Support\Str;
use App\Http\Resources\InvitationResource;

class InvitationController extends Controller
{
    /**
     * Store invitation
     *
     * @return void
     */
    public function store(StoreRequest $request)
    {
        return new InvitationResource(Invitation::create([
            'email' => $request->email,
            'code' => Str::random(100),
            'pin' => rand(60000, 999999),
        ]));
    }
}
