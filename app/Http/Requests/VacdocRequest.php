<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VacdocRequest extends FormRequest
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
            'vacancy_id' => 'required',
            'title' => 'required',
            'document' => 'required|mimes:doc,docx,pdf|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'opd_id.required' => 'OPD wajib diisi!',
            'vacancy_id.required' => 'Lowongan wajib diisi!',
            'title.required' => 'Nama dokumen wajib diisi!',
            'document.required' => 'File wajib diupload!',
            'document.mimes' => 'Hanya dapat mengupload file berformat DOC/DOCX/PDF!',
            'document.max' => 'File maksimal 2MB!',
        ];
    }
}
