<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStateToTalentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('talents', function (Blueprint $table) {
            if (! Schema::hasColumn('talents', 'state_id')) {
                $table->unsignedBigInteger('state_id')->after('country_id')->nullable();
                $table->foreign('state_id')->references('id')->on('states')->cascadeOnDelete();
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
            if (Schema::hasColumn('talents', 'state_id')) {
                $table->dropForeign([ 'state_id' ]);
                $table->dropColumn('state_id');
            }
        });
    }
}
