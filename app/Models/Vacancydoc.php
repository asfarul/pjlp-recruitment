<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vacancydoc extends Model
{
    protected $fillable = [
        'opd_id',
        'vacancy_id',
        'title',
        'document',
    ];
}
