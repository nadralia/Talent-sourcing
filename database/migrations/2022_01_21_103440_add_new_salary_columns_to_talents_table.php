<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewSalaryColumnsToTalentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('talents', function (Blueprint $table) {
            if (! Schema::hasColumn('talents', 'salary')) {
                $table->unsignedBigInteger('salary')->index()->nullable()->after('notice_period_id');
            }

            if (! Schema::hasColumn('talents', 'salary_rate')) {
                $table->unsignedInteger('salary_rate')->index()->nullable()->after('salary');
            }

            if (! Schema::hasColumn('talents', 'salary_currency_id')) {
                $table->char('salary_currency_id', 3)->default('CAD')->nullable()->after('salary');
                $table->foreign('salary_currency_id')->references('id')->on('currencies')->cascadeOnDelete();
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
            if (Schema::hasColumn('talents', 'salary')) {
                $table->dropIndex([ 'salary' ]);
                $table->dropColumn('salary');
            }

            if (Schema::hasColumn('talents', 'salary_rate')) {
                $table->dropIndex([ 'salary_rate' ]);
                $table->dropColumn('salary_rate');
            }

            if (Schema::hasColumn('talents', 'salary_currency_id')) {
                $table->dropForeign([ 'salary_currency_id' ]);
                $table->dropColumn('salary_currency_id');
            }
        });
    }
}
