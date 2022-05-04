<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUniqueIndexToCodebaseSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {
            Schema::table('codebase_skills', function (Blueprint $table) {
                $table->unique(['codebase_id', 'skill_id']);
            });
        } catch (\Exception $e) {
            //
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        try {
            Schema::table('codebase_skills', function (Blueprint $table) {
                $table->dropUnique(['codebase_id', 'skill_id']);
            });
        } catch (\Exception $e) {
            //
        }
    }
}
