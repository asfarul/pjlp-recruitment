<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CandidateKhusus extends Model
{
    protected $fillable = [
        'nik',
        'nama',
        'email',
        'notel',
        'vacancy_id',
        'ktp',
        'ijazah',
        'transkrip',
        'foto',
        'sertifikat',
        'surat_penawaran',
        'pakta_integritas',
        'formulir_kualifikasi',
        'kontrak_spk',
        'evaluasi_prestasi',
        'status_id',
    ];

    /**
     * Get the vacancy that owns the CandidateKhusus
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vacancy()
    {
        return $this->belongsTo('App\Models\Vacancy', 'vacancy_id');
    }

    public function periode()
    {
        return $this->belongsTo(Periode::class, 'period_id', 'id');
    }

    /**
     * Get the candidate_status that owns the CandidateKhusus
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function candidate_status()
    {
        return $this->belongsTo('App\Models\Candidatestatuses', 'status_id');
    }
}
