<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return !empty($this->user());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_id' => 'required|exists:invoice_categories,id',
            'status_id' => 'required|exists:invoice_statuses,id',
            'vendor_id' => 'required|exists:vendors,id',
            'customer_id' => 'required|exists:customers,id',
            'price' => 'required|numeric',
        ];
    }
}
