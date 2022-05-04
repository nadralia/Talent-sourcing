<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStartDateToSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('skills', function (Blueprint $table) {
            if (! Schema::hasColumn('skills', 'start_date')) {
                $table->date('start_date')->nullable()->after('enabled');
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
            if (Schema::hasColumn('skills', 'start_date')) {
                $table->dropColumn('start_date');
            }
        });
    }
}
