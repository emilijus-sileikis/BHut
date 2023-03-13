<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductFormRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'category_id' => [
                'required',
                'integer'
            ],
            'name' => [
                'required',
                'string',
                'max:50'
            ],
            'slug' => [
                'required',
                'string',
                'max:100'
            ],
            'small_description' => [
                'required',
                'string',
                'max:200'
            ],
            'description' => [
                'required',
                'string',
                'max:500'
            ],
            'original_price' => [
                'required',
                'numeric',
                'between:0,999999'

            ],
            'selling_price' => [
                'required',
                'numeric',
                'between:0,999999'
            ],
            'quantity' => [
                'required',
                'integer'
            ],
            'trending' => [
                'nullable'
            ],
            'status' => [
                'nullable'
            ],
            'meta_title' => [
                'required',
                'string',
                'max:100'
            ],
            'meta_keyword' => [
                'required',
                'string',
                'max:100'
            ],
            'meta_description' => [
                'required',
                'string',
                'max:500'
            ],
        ];
    }
}
