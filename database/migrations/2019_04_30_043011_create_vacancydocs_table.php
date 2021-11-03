<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVacancydocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacancydocs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('opd_id');
            $table->unsignedInteger('vacancy_id');
            $table->string('title');
            $table->string('document');
            $table->timestamps();

            $table->foreign('opd_id')
                ->references('id')
                ->on('opds')
                ->onDelete('cascade');

            $table->foreign('vacancy_id')
                ->references('id')
                ->on('vacancies')
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
        Schema::dropIfExists('vacancydocs');
    }
}
