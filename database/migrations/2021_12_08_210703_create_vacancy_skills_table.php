<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVacancySkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacancy_skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->constrained('businesses');
            $table->foreignId('skill_id')->constrained('skills');
            $table->foreignId('vacancy_id')->constrained('vacancies');
            $table->integer('min_years')->index()->nullable();
            $table->integer('max_years')->index()->nullable();
            $table->boolean('must_have')->default(1);
            $table->integer('min_vetting_score')->nullable();
            $table->boolean('enabled')->index()->default(1);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vacancy_skills');
    }
}
