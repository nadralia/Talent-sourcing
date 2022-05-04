<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCompoundIndexToTalentSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {
            Schema::table('talent_skills', function (Blueprint $table) {
                $table->unique([ 'talent_id', 'skill_id' ]);
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
            Schema::table('talent_skills', function (Blueprint $table) {
                $table->dropUnique([ 'talent_id', 'skill_id' ]);
            });
        } catch (\Exception $e) {
            //
        }
    }
}
