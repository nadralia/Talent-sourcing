<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('talent_id')->constrained('talents');
            $table->string('company_name');
            $table->foreignId('state_id')->constrained('states');
            $table->char('country_id', 2)->constrained('countries');
            $table->foreignId('seniority_id')->constrained('seniorities');
            $table->foreignId('title_id')->contraiend('titles');
            $table->text('description');
            $table->foreignId('industry_id')->constrained('industries');
            $table->string('start_date', 7)->nullable();
            $table->string('end_date', 7)->nullable();
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
        Schema::dropIfExists('experiences');
    }
}
