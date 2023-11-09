<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderFormRequest extends FormRequest
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

            'full_name' => [
                'required',
                'string'
            ],
            'phone_number' => [
                'required',
                'string'
            ],
            'province' => [
                'nullable',
                'string'
            ],
            'city' => [
                'nullable',
                'string'
            ],
            'car_brand' => [
                'required',
                'string'
            ],
            'car_model' => [
                'required',
                'string'
            ],
            'car_year' => [
                'required',
                'string'
            ],
            'schedule_date' => [
                'required',
                'string'
            ],
            'schedule_time' => [
                'required',
                'string'
            ],
            'grand_total' => [
                'required',
                'string'
            ],
            'payment_method' => [
                'required',
                'string'
            ],
            'payment_status' => [
                'nullable',
                'string'
            ],
            'home_service' => [
                'required',
                'string'
            ],
            'status' => [
                'nullable',
                'string'
            ],
            'address' => [
                'nullable',
                'string'
            ],

        ];
    }
    public function messages()
    {
        return [
            'phone_number.required' => 'Nomor Whatsapp Harus Di isi.',
        ];
    }
}
