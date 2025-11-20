<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMasterPenjaminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'kode_penjamin' => 'required|string|max:255|unique:master_penjamins,kode_penjamin',
            'nama_penjamin' => 'required|string|max:255',
            'jenis' => 'required|in:BPJS,Umum,Asuransi',
        ];
    }
}
