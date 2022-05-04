<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ChangeStartEndDatesToDateInExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('experiences', function (Blueprint $table) {
            $table->string('start_date', 10)->change();
            $table->string('end_date', 10)->change();
        });

        DB::table('experiences')->update([
            'start_date' => DB::raw("CONCAT(start_date, '-01')"),
            'end_date'   => DB::raw("CONCAT(end_date, '-01')")
        ]);

        DB::table('experiences')->where('end_date', '-01')->update([ 'end_date' => null ]);

        Schema::table('experiences', function (Blueprint $table) {
            $table->date('start_date')->change();
            $table->date('end_date')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('experiences', function (Blueprint $table) {
            $table->string('start_date', 10)->change();
            $table->string('end_date', 10)->change();
        });

        DB::table('experiences')->update([
            'start_date' => DB::raw('SUBSTRING(start_date, 1, 7)'),
            'end_date'   => DB::raw('SUBSTRING(start_date, 1, 7)')
        ]);

    }
}
