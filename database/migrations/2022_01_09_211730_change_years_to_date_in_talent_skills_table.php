<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeYearsToDateInTalentSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('talent_skills', function (Blueprint $table) {
            if (Schema::hasColumn('talent_skills', 'years')) {
                $table->dropColumn('years');
                $table->date('start_date')->after('skill_id')->default(now()->subYear()->startOfYear()->toDateString());
            }
        });
    }
}
