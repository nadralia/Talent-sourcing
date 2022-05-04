<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RestoreMinMaxSalaryToTalentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('talents', function (Blueprint $table) {
            if (! Schema::hasColumn('talents', 'max_salary')) {
                $table->integer('max_salary')->nullable()->index()->after('salary_currency_id');
            }

            if (! Schema::hasColumn('talents', 'min_salary')) {
                $table->integer('min_salary')->nullable()->index()->after('salary_currency_id');
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
        Schema::table('talents', function (Blueprint $table) {
            if (Schema::hasColumn('talents', 'max_salary')) {
                $table->dropIndex([ 'max_salary' ]);
                $table->dropColumn('max_salary');
            }

            if (Schema::hasColumn('talents', 'min_salary')) {
                $table->dropIndex([ 'min_salary' ]);
                $table->dropColumn('min_salary');
            }
        });
    }
}
