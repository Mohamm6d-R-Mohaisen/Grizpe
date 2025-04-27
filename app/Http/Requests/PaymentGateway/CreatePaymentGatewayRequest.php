<?php

namespace App\Http\Requests\PaymentGateway;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Contracts\Validation\Validator;

class CreatePaymentGatewayRequest extends BaseRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'status'                => ['nullable', 'in:0,1'],
            'name_ar'               => ['required', 'max:255'],
            'name_en'               => ['required', 'max:255'],
            'description_ar'        => ['required'],
            'description_en'        => ['required'],
        ];
    }
}