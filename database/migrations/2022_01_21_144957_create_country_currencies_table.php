<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountryCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('country_currencies', function (Blueprint $table) {
            $table->id();
            $table->char('country_id', 2);
            $table->char('currency_id', 3);
            $table->boolean('enabled')->index()->default(1);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('country_id')->references('id')->on('countries')->cascadeOnDelete();
            $table->foreign('currency_id')->references('id')->on('currencies')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('country_currencies');
    }
}
