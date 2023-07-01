<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRecurStoreRequest extends FormRequest
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
    public function rules()
    {
        return [
            'client' => 'required|numeric|exists:clients,id',
            'invoice' => 'required|numeric|exists:invoices,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'interval' => 'required|numeric|min:1',
        ];
    }

    /**
     * Custom attributes
     * @return array
     */
    public function attributes()
    {
        return [
//            'tax' => 'Tax ID',
        ];
    }

    public function messages()
    {
        return [
//            'img.dimensions' => 'Invalid dimension! The :attribute shouldn\'t exceed 300px in any direction.'
        ];
    }
}
