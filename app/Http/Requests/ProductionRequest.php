<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'balance_or_deficit' => 'Sisa atau Kekurangan',
            'balance_or_deficit_value' => 'Nilai dari Sisa atau Kekurangan',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if($this->is('predictions/*') && $this->isMethod('put')) {
            return ['production' => 'required|numeric'];
        }

        return [
            'demand' => 'required|numeric',
            'balance_or_deficit' => ['required', Rule::in(['balance', 'deficit'])],
            'balance_or_deficit_value' => 'required|numeric',
        ];
    }
}
