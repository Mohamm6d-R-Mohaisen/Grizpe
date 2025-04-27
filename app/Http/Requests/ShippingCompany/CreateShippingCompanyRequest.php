<?php

namespace App\Http\Requests\ShippingCompany;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Contracts\Validation\Validator;

class CreateShippingCompanyRequest extends BaseRequest
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
            'cost'          => ['required'],
            'status'        => ['required'],
            'tracking_url'  => ['required'],
            'name_ar'       => ['required'],
            'name_en'       => ['required'],
        ];
    }
}