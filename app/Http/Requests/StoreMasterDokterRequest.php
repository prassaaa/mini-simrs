<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMasterDokterRequest extends FormRequest
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
            'kode_dokter' => 'required|string|max:255|unique:master_dokters,kode_dokter',
            'nama_dokter' => 'required|string|max:255',
            'spesialisasi' => 'required|string|max:255',
            'no_telp' => 'nullable|string|max:20',
        ];
    }
}
