<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropSalaryColumnsFromTalentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('talents', function (Blueprint $table) {
            if (Schema::hasColumn('talents', 'max_salary')) {
                $table->dropColumn('max_salary');
            }

            if (Schema::hasColumn('talents', 'min_salary')) {
                $table->dropColumn('min_salary');
            }
        });
    }
}
