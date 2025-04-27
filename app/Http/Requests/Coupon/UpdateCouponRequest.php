<?php

namespace App\Http\Requests\Coupon;

use App\Http\Requests\BaseRequest;
use Illuminate\Http\Request;

class UpdateCouponRequest extends BaseRequest
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
            'name'           => ['required', 'string', 'max:255'],
            'code'           => ['required', 'string', 'unique:coupons,code,' . $id, 'max:255'],            
            'start_date'     => ['required', 'date', 'after_or_equal:today'],
            'discount_type'  => ['required', 'in:percentage,fixed'], // Replace with valid types
            'discount_value' => ['required', 'numeric', 'min:0'],
            'start_date'     => ['required', 'date', 'before_or_equal:end_date'],
            'end_date'       => ['required', 'date', 'after_or_equal:start_date'],
            'status'         => ['required', 'boolean'],
        ];
    }
}
