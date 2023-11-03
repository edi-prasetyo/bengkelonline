<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceItemFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'service_id' => [
                'required',
                'string'
            ],
            'name' => [
                'required',
                'string'
            ],
            'price' => [
                'required',
                'string'
            ],
            'description' => [
                'required',
                'string'
            ],
            'status' => [
                'required',
                'string'
            ],
            'meta_title' => [
                'nullable',
                'string'
            ],
            'meta_description' => [
                'nullable',
            ],
            'meta_keyword' => [
                'nullable',
            ],
            'image' => [
                'nullable',
            ],
        ];
    }
}
