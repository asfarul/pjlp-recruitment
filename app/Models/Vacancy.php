<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{

    protected $dates = ['start_date', 'finish_date'];

    protected $fillable = [
        'opd_id',
        'vacancy_code',
        'title',
        'description',
        'selection',
        'salary_estimate',
        'occupation_id',
        'number_of_employee',
        'start_date',
        'finish_date',
        'type_id',
        'status',
    ];
}
