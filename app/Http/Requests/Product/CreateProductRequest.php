<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\BaseRequest;

class CreateProductRequest extends BaseRequest
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
            // 'sku'                       => ['required'],
            // 'quantity'                  => ['required'],
            'categories.*'              => ['required', 'exists:categories,id'],
            'name_ar'                   => ['required'],
            'name_en'                   => ['nullable'],
            'short_description_ar'      => ['nullable'],
            'short_description_en'      => ['nullable'],
            'long_description_ar'       => ['nullable'],
            'long_description_en'       => ['nullable'],

            'media_repeater.*.image'    => ['nullable'],
            'media_repeater.*.title'    => ['nullable'],

            'meta_title'                => ['nullable'],
            'meta_description'          => ['nullable'],

            // 'price'                     => ['required'],
            
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',

            'attributes_repeater.*.attribute_id'        => ['nullable', 'exists:attributes,id'],
            'attributes_repeater.*.attribute_value_id'  => ['nullable', 'exists:attribute_values,id'],
            
            'variants.*.attribute_values' => 'nullable|min:1',

            // 'video' => ['nullable', 'mimes:mp4,avi,mov', 'max:102400'],
        ];  
    }
}
