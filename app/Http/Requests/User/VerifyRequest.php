<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class VerifyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check() && !auth()->user()->is_verified;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'pin' => [
                'required',
                'min:5',
                'max:6',
                function ($attribute, $value, $fail) {
                    if (auth()->user()->pin != $value)
                        $fail('Verification pin was incorrect.');
                }
            ]
        ];
    }
}
