<?php

namespace App\Http\Requests\ShippingCompany;

use App\Http\Requests\BaseRequest;
use Illuminate\Http\Request;

class UpdateShippingCompanyRequest extends BaseRequest
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
    public function rules(Request $request)
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
