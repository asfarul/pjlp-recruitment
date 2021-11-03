<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            'title' => 'required',
            'category_id' => 'required',
            'image_header' => 'mimes:jpeg,png|max:2048',
            'content' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Judul wajib diisi!',
            'category_id.required' => 'Kategori wajib diisi!',
            'image_header.mimes' => 'Hanya dapat mengupload file berformat JPG/PNG!',
            'image_header.max' => 'File maksimal 2MB!',
            'content.required' => 'Konten wajib diisi!',
        ];
    }
}
