<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\BaseRequest;
use App\Traits\Rule\CustomValidationRulesTrait;

class RegisterRequest extends BaseRequest
{
    use CustomValidationRulesTrait;

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
        $check_phone = $this->checkPhone('users', $this->request->get('phone_code'), $this->request->get('phone'));

        return [
            'first_name'    => ['required'],
            'last_name'     => ['required'],
            'phone_code'    => ['nullable', 'numeric'],
            'phone'         => ['required', 'numeric', 'digits_between:9,13', $check_phone],
            'email'         => ['required', 'email' , 'unique:users,email'],
            'password'      => ['required', 'confirmed'],
        ];
    }



}
