<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOdontogramRequest extends FormRequest
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
            'pemeriksaan_ekstra_oral' => 'nullable|string',
            'pemeriksaan_intra_oral' => 'nullable|string',
            'occlusi' => 'nullable|in:normal_bite,cross_bite,steep_bite',
            'torus_palatinus' => 'nullable|in:tidak_ada,kecil,sedang,besar,multiple',
            'torus_mandibularis' => 'nullable|in:tidak_ada,kiri,kanan,kedua',
            'palatum' => 'nullable|in:dalam,sedang,rendah',
            'diastema' => 'nullable|boolean',
            'gigi_anomali' => 'nullable|boolean',
            'status_d' => 'nullable|integer|min:0',
            'status_m' => 'nullable|integer|min:0',
            'status_f' => 'nullable|integer|min:0',
            'hasil_pemeriksaan_penunjang' => 'nullable|string',
            'diagnosa' => 'nullable|string',
            'planning' => 'nullable|string',
            'edukasi' => 'nullable|string',
            'gigi' => 'nullable|array',
            'gigi.*.kondisi' => 'nullable|string|max:20',
            'gigi.*.dinding_atas' => 'nullable|in:normal,bermasalah',
            'gigi.*.dinding_bawah' => 'nullable|in:normal,bermasalah',
            'gigi.*.dinding_kiri' => 'nullable|in:normal,bermasalah',
            'gigi.*.dinding_kanan' => 'nullable|in:normal,bermasalah',
            'gigi.*.dinding_tengah' => 'nullable|in:normal,bermasalah',
            'gigi.*.keterangan' => 'nullable|string',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'occlusi.in' => 'Occlusi harus Normal Bite, Cross Bite, atau Steep Bite',
            'torus_palatinus.in' => 'Torus Palatinus tidak valid',
            'torus_mandibularis.in' => 'Torus Mandibularis tidak valid',
            'palatum.in' => 'Palatum harus Dalam, Sedang, atau Rendah',
        ];
    }
}
