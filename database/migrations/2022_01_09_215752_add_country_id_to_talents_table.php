<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCountryIdToTalentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('talents', function (Blueprint $table) {
            $table->char('country_id', 2)->after('nationality')->nullable();
            $table->foreign('country_id')->references('id')->on('countries')->cascadeOnDelete();
        });
    }
}
