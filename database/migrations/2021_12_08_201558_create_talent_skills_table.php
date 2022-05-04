<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTalentSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('talent_skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('talent_id')->constrained('talents');
            $table->foreignId('skill_id')->constrained('skills');
            $table->integer('years');
            $table->foreignId('skill_level_id')->nullable()->constrained('skill_levels');
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
        Schema::dropIfExists('talent_skills');
    }
}
