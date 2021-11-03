<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'email' => 'required|email|unique:users',
            'password' => 'min:6|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'min:6',
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
            'password.required' => 'Password wajib diisi!',
            'password.min' => 'Password minimal 6 karakter!',
            'password.same' => 'Password tidak sama, Silakan ulangi!',
            'confirm_password.min' => 'Password minimal 6 karakter!',
            'role_id.required' => 'Silakan pilih role!',
        ];
    }
}
