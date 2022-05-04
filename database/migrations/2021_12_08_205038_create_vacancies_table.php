<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->foreignId('business_id')->constrained('businesses');
            $table->string('title');
            $table->text('description');
            $table->char('country_id', 2)->constrained('countries');
            $table->foreignId('state_id')->constrained('states');
            $table->foreignId('seniority_id')->constrained('seniorities');
            $table->foreignId('degree_id')->nullable()->constrained('degrees');
            $table->foreignId('remote_type_id')->constrained('remote_types');
            $table->boolean('has_relocation')->index()->default(0);
            $table->integer('min_salary')->nullable()->index();
            $table->integer('max_salary')->nullable()->index();
            $table->integer('min_years')->index();
            $table->integer('max_years')->index();
            $table->boolean('featured')->nullable();
            $table->integer('vetting_score')->nullable();
            $table->text('video_instructions')->nullable();
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
        Schema::dropIfExists('vacancies');
    }
}
