<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CandidateRequest extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'vacancy_id' => 'required',
            'nik' => 'required|unique:candidates',
            'nama' => 'required',
            'email' => 'required',
            'notel' => 'required',
            'ktp' => 'required',
            'ijazah' => 'required',
            'transkrip' => 'required',
            'foto' => 'required',
            'surat_penawaran' => 'required',
            'pakta_integritas' => 'required',
            'formulir_kualifikasi' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'vacancy_id.required' => 'Posisi wajib diisi!',
            'nik.required' => 'NIK wajib diisi!',
            'nama.required' => 'Nama wajib diisi!',
            'email.required' => 'Email wajib diisi!',
            'notel.required' => 'No Telepon/Handphone wajib diisi!',
            'ktp.required' => 'KTP wajib diisi!',
            'ijazah.required' => 'Ijazah wajib diisi!',
            'transkrip.required' => 'Transkrip wajib diisi!',
            'foto.required' => 'Foto wajib diisi!',
            'surat_penawaran.required' => 'Surat Penawaran wajib diisi!',
            'pakta_integritas.required' => 'Pakta Integritas wajib diisi!',
            'formulir_kualifikasi.required' => 'Formulir Kualifikasi wajib diisi!',
        ];
    }
}
