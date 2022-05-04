<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameProficiencyIdInBusinessLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_languages', function (Blueprint $table) {
            if (Schema::hasColumn('business_languages', 'proficiency_id')) {
                $table->dropForeign([ 'proficiency_id' ]);
                $table->renameColumn('proficiency_id', 'language_level_id');
            }
        });

        Schema::table('business_languages', function (Blueprint $table) {
            if (Schema::hasColumn('business_languages', 'language_level_id')) {
                $table->foreignId('language_level_id')->nullable()->change();
                $table->foreign('language_level_id')->references('id')->on('language_levels')->cascadeOnDelete();
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
        Schema::table('business_languages', function (Blueprint $table) {
            if (Schema::hasColumn('business_languages', 'language_level_id')) {
                $table->dropForeign([ 'language_level_id' ]);
                $table->renameColumn('language_level_id', 'proficiency_id');
            }
        });
    }
}
