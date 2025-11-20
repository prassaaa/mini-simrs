<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKunjunganRequest extends FormRequest
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
            'no_rm' => 'required|exists:pasiens,no_rm',
            'tanggal_kunjungan' => 'required|date',
            'kode_dokter' => 'required|exists:master_dokters,kode_dokter',
            'poli' => 'required|exists:master_polis,kode_poli',
            'instalasi' => 'required|in:Rawat Jalan,IGD,Rawat Inap',
            'penjamin_id' => 'required|exists:master_penjamins,id',
        ];
    }
}
