<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTalentToSkillInCodebaseSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::table('codebase_skills', function (Blueprint $table) {
            if (Schema::hasColumn('codebase_skills', 'talent_id')) {
                $table->dropForeign([ 'talent_id' ]);
                $table->renameColumn('talent_id', 'skill_id');
            }

            if (Schema::hasColumn('codebase_skills', 'score')) {
                $table->dropColumn('score');
            }

            if (Schema::hasColumn('codebase_skills', 'admin_id')) {
                $table->dropForeign([ 'admin_id' ]);
                $table->dropColumn('admin_id');
            }
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('codebase_skills', function (Blueprint $table) {
            //
        });
    }
}
