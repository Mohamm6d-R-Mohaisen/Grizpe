<?php

namespace App\Http\Requests\Frontend;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest 
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
            'product_id'        => ['required', 'exists:products,id'],
            // 'year'              => ['required', 'string'],
            // 'memory'            => ['required', 'string'],
            // 'condition'         => ['required', 'string'],
            'delivery_method'   => ['required', 'string', 'in:mail-in,in-store'],
            'first_name'        => ['required', 'string', 'max:100'],
            'last_name'         => ['required', 'string', 'max:100'],
            'email'             => ['required', 'email'],
            'phone'             => ['required', 'string'],
            'address'           => ['required', 'string'],
            'address_details'   => ['nullable', 'string'],
            'city'              => ['nullable', 'string'],
            'state'             => ['required', 'string'],
            'postal_code'       => ['required', 'string'],
            'preferred_date'    => ['required'],
            'preferred_time'    => ['required'],
        ];
    }
}
