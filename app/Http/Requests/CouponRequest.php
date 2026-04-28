<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'code' => 'required|string|unique:coupons,code,' . $this->route('coupon'),
            'type' => 'required|in:percentage,fixed',
            'value' => 'required|numeric|min:0',
            'min_cart' => 'nullable|numeric|min:0',
            'max_discount' => 'nullable|numeric|min:0',
            'expires_at' => 'nullable|date',
            'usage_limit' => 'nullable|integer|min:1',
            'status' => 'boolean',
        ];
    }
}
