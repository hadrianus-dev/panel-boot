<?php

namespace App\Http\Requests\Api\V1\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'first_name' => [
                'nullable',
                'string',
                'min:3',
                'max:255',
            ],
            'last_name' => [
                'nullable',
                'string',
            ],
            'email' => [
                'nullable',
                'email',
                'unique:users,email'
            ],
            'password' => [
                'nullable',
                'alpha_num',
                'min:6',
                'max:14',
            ]
        ];
    }
}
