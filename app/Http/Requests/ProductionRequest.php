<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductionRequest extends FormRequest
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
        return [
            'demand' => 'Permintaan',
            'balance' => 'Sisa',
            'deficit' => 'Kekurangan',
            'production' => 'Produksi',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // store the data
        if($this->is('productions') && $this->isMethod('post')) {
            return [
                'demand' => 'required|numeric',
                'balance' => 'numeric',
                'deficit' => 'numeric',
                'production' => 'required|numeric',
            ];
        }
    }
}