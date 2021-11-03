<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermissionStoreRequest extends FormRequest
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
            'name' => 'required|unique:permissions',
            'display_name' => 'required',
            'description' => 'required',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Permission wajib diisi!',
            'email.unique' => 'Permission sudah ada!',
            'display_name.required' => 'Nama Display wajib diisi!',
            'description.required' => 'Deskripsi wajib diisi!',
        ];
    }
}
