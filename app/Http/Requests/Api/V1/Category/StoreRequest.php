<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1\Category;

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
            'parent' => [
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
