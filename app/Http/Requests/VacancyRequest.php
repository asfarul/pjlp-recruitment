<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VacancyRequest extends FormRequest
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
            'opd_id' => 'required',
            'vacancy_code' => 'required|unique:vacancies',
            'title' => 'required',
            'description' => 'required',
            'selection' => 'required',
            'number_of_employee' => 'required',
            'start_date' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'opd_id.required' => 'Silakan pilih OPD!',
            'vacancy_code.required' => 'Kode Lowongan wajib diisi!',
            'vacancy_code.unique' => 'Kode Lowongan sudah ada, silakan isi dengan kode yang berbeda!',
            'title.required' => 'Judul wajib diisi!',
            'description.required' => 'Deskripsi wajib diisi!',
            'selection.required' => 'Tahapan seleksi wajib diisi!',
            'number_of_employee.required' => 'Jumlah pegawai wajib diisi!',
            'start_date.required' => 'Tanggal mulai wajib diisi!',
        ];
    }
}
