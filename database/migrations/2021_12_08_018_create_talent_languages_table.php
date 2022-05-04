<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTalentLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('talent_languages', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('talent_id')->constrained('talents');
            $table->char('language_id', 2)->constrained('languages');
            $table->integer('proficiency_id')->constained('proficiencies');
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
        Schema::dropIfExists('talent_languages');
    }
}
