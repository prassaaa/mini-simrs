<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTransaksiRequest extends FormRequest
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
            'no_registrasi_kunjungan' => 'required|exists:kunjungans,no_registrasi_kunjungan',
            'details' => 'required|array|min:1',
            'details.*.nama_tindakan' => 'required|string|max:255',
            'details.*.harga' => 'required|numeric|min:0',
            'details.*.qty' => 'required|integer|min:1',
        ];
    }
}
