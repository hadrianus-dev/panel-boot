<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1\Service;

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
            'title' => [
                'required',
                'string',
                'min:3',
                'max:255',
                'unique:categories,title'
            ],
            'body' => [
                'required',
                'string',
            ],
            'description' => [
                'nullable',
                'string',
                'max:120',
            ],
            'category_id' => [
                'required',
                'integer',
            ],
            'published' => [
                'nullable',
                'boolean',
            ],
        ];
    }
}
