<?php

namespace App\Http\Requests\HomeSection;

use App\Http\Requests\BaseRequest;

class CreateHomeSectionRequest extends BaseRequest
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
            'type'                      => ['required', 'string'],
            'name_ar'                   => ['nullable', 'string', 'max:255'],
            'name_en'                   => ['nullable', 'string', 'max:255'],
            'description_ar'            => ['nullable', 'string'],
            'description_en'            => ['nullable', 'string'],
            'section_items'             => ['nullable', 'array'], // العناصر المرتبطة بالقسم
            'section_items.*.name_ar'   => ['nullable', 'string', 'max:255'],
            'section_items.*.name_en'   => ['nullable', 'string', 'max:255'],
            'section_items.*.description_ar' => ['nullable', 'string'],
            'section_items.*.description_en' => ['nullable', 'string'],
            'section_items.*.image'     => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'section_items.*.link'      => ['nullable'],
            'section_items.*.order'     => ['nullable', 'integer'],
        ];  
    }
}
