<?php

namespace App\Http\Requests\AttributeValue;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Contracts\Validation\Validator;

class CreateAttributeValueRequest extends BaseRequest
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
            'attribute_id'      => ['required', 'exists:attributes,id'],
            'name_ar'           => ['required', 'max:255'],
            'name_en'           => ['required', 'max:255'],
            'description_ar'    => ['nullable'],
            'description_en'    => ['nullable'],
        ];
    }
}