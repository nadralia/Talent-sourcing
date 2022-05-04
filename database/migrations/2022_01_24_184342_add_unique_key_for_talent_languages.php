<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUniqueKeyForTalentLanguages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('talent_languages', function (Blueprint $table) {
            $table->unique([ 'talent_id', 'language_id' ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('talent_languages', function (Blueprint $table) {
            $table->dropUnique([ 'talent_id', 'language_id' ]);
        });
    }
}
