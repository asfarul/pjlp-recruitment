<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'name' => 'required|max:120',
            'email'=>'required|email|unique:users,email,'. $this->route('user'),
            'role_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama lengkap wajib diisi!',
            'name.max' => 'Nama lengkap maksimal 120 karakter!',
            'email.required' => 'Email wajib diisi!',
            'email.email' => 'Email tidak sesuai format!',
            'email.unique' => 'Email sudah pernah terdaftar!',
            'role_id.required' => 'Silakan pilih role!',
        ];
    }
}
