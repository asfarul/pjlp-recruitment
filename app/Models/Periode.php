<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    protected $table = "periods";
    protected $fillable = ['start_date', 'end_date', 'description',];
}
