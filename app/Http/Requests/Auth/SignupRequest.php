<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
use Hash;

class SignupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_name' => 'required|unique:users|min:4|max:20',
            'code' => 'required|exists:invitations',
            'password' => 'required|confirmed|min:4'
        ];
    }
}
