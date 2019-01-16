<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientStoreRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:80',
            'city' => 'required|min:5|max:40',
            'address' => 'required|min:10|max:200',
            'zip' => 'required|numeric|digits:4',
            'tax' => 'nullable|string|min:5|max:100',
            'note' => 'nullable|string|min:5|max:250',
            'img' => 'nullable|image|mimes:jpeg,jpg,png|max:500|min:10|dimensions:max_width=300,max_height=300', // size in KB
        ];
    }

    /**
     * Custom attributes
     * @return array
     */
    public function attributes()
    {
        return [
            'tax' => 'Tax ID',
            'img' => 'Company Logo'
        ];
    }

    public function messages()
    {
        return [
            'img.dimensions' => 'Invalid dimension! The :attribute shouldn\'t exceed 300px in any direction.'
        ];
    }
}
