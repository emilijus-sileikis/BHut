<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string'
            ],
            'slug' => [
                'required',
                'string'
            ],
            'description' => [
                'required',
                'string'
            ],
            'image' => [
                'nullable',
                'mimes:jpg,jpeg,png',
                'max:4000',
            ],
            'meta_title' => [
                'required',
                'string'
            ],
            'meta_description' => [
                'required',
                'string'
            ],
            'meta_keyword' => [
                'required',
                'string'
            ],
            'status' => [
              'nullable'
            ],
        ];
    }
}
