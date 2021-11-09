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
        'period_id'
    ];

    /**
     * Get the periode that owns the Vacancy
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function periode()
    {
        return $this->belongsTo('App\Models\Periode', 'period_id');
    }

    /**
     * Get the dinas that owns the Vacancy
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dinas()
    {
        return $this->belongsTo('App\Models\Opd', 'opd_id');
    }

    public function type()
    {
        return $this->belongsTo('App\Models\VacancyType', 'type_id');
    }
}
