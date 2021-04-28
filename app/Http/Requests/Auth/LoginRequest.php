<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
use Hash;

class LoginRequest extends FormRequest
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
            'user_name' => [
                'required',
                'exists:users,user_name',
            ],
            'password' => [
                'required',
                function ($attribute, $value, $fail) {
                    $user = User::where(['user_name' => $this->user_name])->first();
                    
                    if (!$user || !Hash::check($value, $user->password)) {
                        $fail('These credentials do not match our records.');
                    }
                }
            ]
        ];
    }
}
