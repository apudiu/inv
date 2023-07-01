<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectStoreRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:100',
            'client_id' => 'required|numeric|exists:clients,id',
            'description' => 'required|string|min:2',
            'entry' => 'required|array|min:1',
            'entry.*' => 'required',
            'entry.*.hour' => 'numeric|min:1',
            'entry.*.description' => 'string|min:5',
            'entry.*.rate' => 'numeric|min:1',
        ];
    }

    /**
     * Custom attributes
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => 'Project Name',
            'client_id' => 'Client',
            'entry.*.hour' => 'Entry Hour',
            'entry.*.rate' => 'Entry Rate',
            'entry.*.description' => 'Entry Description',
        ];
    }

    public function messages()
    {
        return [
            'client_id.required' => 'Choosing a client is required.',
            'entry.required' => 'At least one :attribute is required.',
        ];
    }
}
