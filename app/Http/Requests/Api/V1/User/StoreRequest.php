<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
   
    public function authorize(): bool
    {
        return true;
    }

   
    public function rules()
    {
        return [
            'first_name' => [
                'required',
                'string',
                'min:3',
                'max:255',
            ],
            'last_name' => [
                'required',
                'string',
            ],
            'email' => [
                'required',
                'email',
                'unique:users,email'
            ],
            'password' => [
                'required',
                'alpha_num',
                'min:6',
                'max:14',
            ]
        ];
    }
}
