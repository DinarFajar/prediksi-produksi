<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PermintaanRequest extends FormRequest
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
            'sisa_or_kekurangan' => 'Sisa atau Kekurangan',
            'sisa_or_kekurangan_value' => 'Nilai dari Sisa atau Kekurangan',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'tanggal' => 'required|date',
            'permintaan' => 'required|numeric',
            'sisa_or_kekurangan' => ['required', Rule::in(['sisa', 'kekurangan'])],
            'sisa_or_kekurangan_value' => 'required|numeric',
        ];
    }
}
