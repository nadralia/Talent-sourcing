<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPrimarySecondaryToTalentSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('talent_skills', function (Blueprint $table) {
            if (! Schema::hasColumn('talent_skills', 'is_secondary')) {
                $table->boolean('is_secondary')->index()->after('skill_id')->nullable();
            }

            if (! Schema::hasColumn('talent_skills', 'is_primary')) {
                $table->boolean('is_primary')->index()->after('skill_id')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('talent_skills', function (Blueprint $table) {
            if (Schema::hasColumn('talent_skills', 'is_primary')) {
                $table->dropIndex([ 'is_primary' ]);
                $table->dropColumn('is_primary');
            }

            if (Schema::hasColumn('talent_skills', 'is_secondary')) {
                $table->dropIndex([ 'is_secondary' ]);
                $table->dropColumn('is_secondary');
            }
        });
    }
}
