<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check() && auth()->user()->is_verified;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'sometimes|min:3',
            'user_name' => [
                'sometimes',
                'unique:users,user_name,' . auth()->user()->id,
            ],
            'avatar' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|dimensions:max_width=256,max_height=256',
            'email' => [
                'sometimes',
                'unique:users,email,' . auth()->user()->id,
            ]
        ];
    }
}
