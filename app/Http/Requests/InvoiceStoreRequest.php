<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceStoreRequest extends FormRequest
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
        $invoiceEntryTypes = implode(',', config('app.invoice.entry.types'));
        $invoiceTypes = implode(',', config('app.invoice.type'));

        return [
            'client' => 'required|numeric|exists:clients,id',
            'date' => 'required|string|date',
            'contact' => 'required|array|min:1',
            'contact.*' => 'numeric|exists:persons,id',
            'pon' => 'nullable|string|min:3|max:30',
            'type' => 'required|string|in:'.$invoiceTypes,
            'entry' => 'required|array|min:1',
            'entry.*' => 'required',
            'entry.*.qty' => 'numeric|min:1|digits_between:1,10',
            'entry.*.qt_type' => 'string|min:1|in:'.$invoiceEntryTypes,
            'entry.*.description' => 'string|min:5',
            'entry.*.price' => 'numeric|min:1|digits_between:1,10',
        ];
    }

    /**
     * Custom attributes
     * @return array
     */
    public function attributes()
    {
        return [
            'client' => 'Client',
            'date' => 'Date',
            'contact' => 'Contact',
            'pon' => 'P.O. No.',
            'type' => 'Invoice Type',
            'entry.*.qty' => 'Quantity',
            'entry.*.qt_type' => 'Type',
            'entry.*.description' => 'Description',
            'entry.*.price' => 'Price',
        ];
    }

    public function messages()
    {
        return [
            'entry.required' => 'At least one :attribute is required.',
        ];
    }
}
