<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\BaseRequest;

class CreateOrderRequest extends BaseRequest 
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
            'cart_id'           => ['required'],
            'checkout_method.*' => ['required'],
        ];
    }
}
