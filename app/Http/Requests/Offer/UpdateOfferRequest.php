<?php

namespace App\Http\Requests\Offer;

use App\Http\Requests\BaseRequest;
use Illuminate\Http\Request;

class UpdateOfferRequest extends BaseRequest
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
        $id = $this->route('coupon');
            return [
                'name_ar'          => ['required', 'string', 'max:255'], 
                'name_en'          => ['required', 'string', 'max:255'], 
                'description_ar'    => ['nullable', 'string', 'max:1000'], 
                'description_en'    => ['nullable', 'string', 'max:1000'], 
                'discount_type'     => ['required', 'in:percentage,fixed'], 
                'discount_value'    => ['required', 'numeric', 'min:0'], 
                'start_date'        => ['required', 'date', 'after_or_equal:today'], 
                'end_date'          => ['required', 'date', 'after:start_date'],   
                'status'            => ['required', 'in:0,1'],  
                'products.*.id'     => ['nullable', 'exists:products,id'], 
                'categories.*.id'   => ['nullable', 'exists:categories,id'], 
            ];
    }
}
