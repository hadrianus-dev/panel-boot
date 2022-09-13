<?php

namespace App\Http\Requests\Api\V1\Service;

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
            'title' => [
                'nullable',
                'string',
                'min:3',
                'max:255'
            ],
            'body' => [
                'nullable',
                'string',
            ],
            'description' => [
                'nullable',
                'string',
                'max:120',
            ],
            'category_id' => [
                'nullable',
                'integer',
            ],
            'published' => [
                'nullable',
                'boolean',
            ],
        ];
    }
}
