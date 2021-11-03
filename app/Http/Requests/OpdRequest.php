<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OpdRequest extends FormRequest
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
            'opd' => 'required',
            'telepon' => 'max:14',
            'lat' => 'required',
            'lng' => 'required',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'opd.required' => 'OPD wajib diisi!',
            'telepon.max' => 'Nomor telepon maksimal 14 angka!',
            'lat.required' => 'Latitude wajib diisi!',
            'lng.required' => 'Longitude wajib diisi!',
        ];
    }
}
