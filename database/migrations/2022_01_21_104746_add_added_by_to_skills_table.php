<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAddedByToSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('skills', function (Blueprint $table) {
            if (! Schema::hasColumn('skills', 'added_by')) {
                $table->unsignedBigInteger('added_by')->nullable()->after('enabled');
                $table->foreign('added_by')->references('id')->on('talents')->cascadeOnDelete();
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
        Schema::table('skills', function (Blueprint $table) {
            if (Schema::hasColumn('skills', 'added_by')) {
                $table->dropForeign([ 'added_by' ]);
                $table->dropColumn('added_by');
            }
        });
    }
}
