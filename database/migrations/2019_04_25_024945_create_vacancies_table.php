<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVacanciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacancies', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('opd_id');
            $table->string('vacancy_code');
            $table->string('title');
            $table->text('selection');
            $table->text('requirement');
            $table->string('salary_estimate')->nullable();
            $table->unsignedInteger('occupation_id')->nullable();
            $table->integer('number_of_employee');
            $table->date('start_date');
            $table->date('finish_date')->nullable();
            $table->unsignedInteger('type_id');
            $table->tinyInteger('status');
            $table->timestamps();

            $table->foreign('opd_id')
                ->references('id')
                ->on('opds')
                ->onDelete('cascade');

            $table->foreign('occupation_id')
                ->references('id')
                ->on('occupations')
                ->onDelete('cascade');

            $table->foreign('type_id')
                ->references('id')
                ->on('vacancy_types')
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
        Schema::dropIfExists('vacancies');
    }
}
