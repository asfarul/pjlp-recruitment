<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $fillable = [
        'vacancy_id',
        'nik',
        'email',
        'notel',
        'ktp',
        'ijazah',
        'transkrip',
        'sertifikat',
        'foto',
        'surat_penawaran',
        'pakta_integritas',
        'formulir_kualifikasi',
    ];
}
