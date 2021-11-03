<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Opd extends Model
{
    protected $fillable = [
        'opd',
        'kode_opd',
        'deskripsi',
        'alamat',
        'telepon',
        'lat',
        'lang'
    ];
}
