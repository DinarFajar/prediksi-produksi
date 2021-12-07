<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TemplateRequest extends FormRequest
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
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes() 
    {
        return ['name' => 'Nama'];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // update the data
        if($this->is('templates/*') && $this->isMethod('put')) {
            return ['name' => ['required', 'max:255', Rule::unique('templates')->ignore($this->template->id)]];
        }

        // store the data
        elseif($this->is('templates') && $this->isMethod('post')) {
            return ['name' => 'required|max:255|unique:templates'];
        }
    }
}
