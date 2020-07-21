<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'delivery_type'      => 'nullable',
            'delivery_date'      => 'string|nullable',
            'delivery_time'      => 'string|nullable',
            'payment_type'       => 'nullable',
            'city'               => 'string|required',
            'street'             => 'string|required',
            'house_number'       => 'string|required',
            'last_name'          => 'string|max:255|nullable',
            'name'               => 'required|string|max:255',
            'middle_name'        => 'string|max:255|nullable',
            'phone'              => 'string|required',
            'email'              => 'required|string|email',
            'message'            => 'nullable|string',
        ];
    }
}
