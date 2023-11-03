<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponFormRequest extends FormRequest
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
            'name' => [
                'required',
                'string'
            ],
            'description' => [
                'required',
            ],
            'code' => [
                'required',
                'string'
            ],
            'start_date' => [
                'required'
            ],
            'end_date' => [
                'required'
            ],
            'max_redemtions' => [
                'nullable',
            ],
            'amount' => [
                'required',
            ],
            'status' => [
                'nullable',
            ],
            'bank_logo' => [
                'nullable',
                'mimes:jpg,jpeg,png'
            ],
        ];
    }
}
