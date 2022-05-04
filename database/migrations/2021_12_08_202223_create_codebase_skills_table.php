<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCodebaseSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('codebase_skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('talent_id')->constrained('talents');
            $table->foreignId('codebase_id')->constrained('codebases');
            $table->integer('score');
            $table->foreignId('admin_id')->constrained('admins');
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
        Schema::dropIfExists('codebase_skills');
    }
}
