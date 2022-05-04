<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTitleStartDateToTalentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('talents', function (Blueprint $table) {
            if (! Schema::hasColumn('talents', 'title_start_date')) {
                $table->date('title_start_date')->index()->after('title_id')->nullable();
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
            if (Schema::hasColumn('talents', 'title_start_date')) {
                $table->dropIndex([ 'title_start_date' ]);
                $table->dropColumn('title_start_date');
            }
        });
    }
}
