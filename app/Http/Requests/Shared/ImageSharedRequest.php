<?php

declare(strict_types=1);

namespace App\Http\Requests\Shared;

use Illuminate\Foundation\Http\FormRequest;

class ImageSharedRequest extends FormRequest
{
   
    public function authorize(): bool
    {
        return true;
    }

   
    public function rules()
    {
        return [
            'image' => [
                'required',
                'image',
                'mimes:jpeg,png,jpg,gif'
            ]
        ];
    }
}
