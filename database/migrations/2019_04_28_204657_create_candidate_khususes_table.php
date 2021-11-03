<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidateKhususesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_khususes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nik');
            $table->string('nama');
            $table->string('email');
            $table->string('notel');
            $table->unsignedInteger('vacancy_id');
            $table->string('ktp');
            $table->string('ijazah');
            $table->string('transkrip');
            $table->string('foto');
            $table->string('sertifikat')->nullable();
            $table->string('surat_penawaran');
            $table->string('pakta_integritas');
            $table->string('formulir_kualifikasi');
            $table->string('kontrak_spk');
            $table->string('evaluasi_prestasi');
            $table->unsignedInteger('status_id');
            $table->timestamps();

            $table->foreign('vacancy_id')
                ->references('id')
                ->on('vacancies')
                ->onDelete('cascade');

            $table->foreign('status_id')
                ->references('id')
                ->on('candidatestatuses')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('candidate_khususes');
    }
}
