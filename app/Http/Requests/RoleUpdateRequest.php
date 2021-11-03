<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleUpdateRequest extends FormRequest
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
            'name' => 'required',
            'display_name' => 'required',
            'color' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama role wajib diisi!',
            'email.unique' => 'Role sudah pernah terdaftar!',
            'display_name.required' => 'Nama Display wajib diisi!',
            'color.required' => 'Warna label wajib diisi!',
        ];
    }
}
