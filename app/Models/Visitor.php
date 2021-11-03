<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $table = 'visitor';

    protected $fillable = ['ip_pengunjung', 'jumlah_kunjungan','hari_kunjungan'];

    public $timestamps = true;
   	protected $primaryKey = 'id';
}
