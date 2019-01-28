<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonStoreRequest extends FormRequest
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
            'client_id' => 'required|numeric|exists:clients,id',
            'name' => 'required|string|min:5|max:80',
            'surname' => 'nullable|min:3|max:10',
            'email' => 'required|email|min:8|max:50',
            'phone' => 'nullable|numeric|digits_between:7,11:', // seen? ghost numbers! bad practice
            'department' => 'nullable|string|min:2|max:30',
            'designation' => 'nullable|string|min:1|max:25',
            'note' => 'nullable|string|min:5|max:250',
        ];
    }

    /**
     * Custom attributes
     * @return array
     */
    public function attributes()
    {
        return [
        ];
    }

    public function messages()
    {
        return [
            'client_id' => [
                'required' => 'Something went wrong !',
                'numeric' => 'Something went wrong !!',
                'exists' => 'Something went wrong !!!'
            ]
        ];
    }
}
