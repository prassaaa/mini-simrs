<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMasterPoliRequest extends FormRequest
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
        $masterPoli = $this->route('master_poli');
        $poliId = $masterPoli->id ?? $masterPoli;

        return [
            'kode_poli' => 'required|string|max:255|unique:master_polis,kode_poli,' . $poliId,
            'nama_poli' => 'required|string|max:255',
            'lokasi' => 'nullable|string|max:255',
        ];
    }
}
