<?php

namespace App\Http\Requests\Review;

use App\Http\Requests\BaseRequest;
use Illuminate\Http\Request;

class UpdateReviewRequest extends BaseRequest
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
            'user_id'       => ['required'],
            'product_id'    => ['required'],
            'rating'        => ['required'],
            'comment'       => ['required'],
            'status'        => ['nullable'],
        ];
    }
}
