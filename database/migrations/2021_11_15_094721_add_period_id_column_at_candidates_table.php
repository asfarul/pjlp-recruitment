<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPeriodIdColumnAtCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candidates', function (Blueprint $table) {
            $table->unsignedInteger('period_id')->after('vacancy_id')->nullable();
        });
        Schema::table('candidate_khususes', function (Blueprint $table) {
            $table->unsignedInteger('period_id')->after('vacancy_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('candidates', function (Blueprint $table) {
            $table->dropColumn('period_id');
        });
        Schema::table('candidate_khususes', function (Blueprint $table) {
            $table->dropColumn('period_id');
        });
    }
}
