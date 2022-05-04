<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForexTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forex', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->char('from_currency', 3);
            $table->char('to_currency', 3);
            $table->boolean('enabled')->index()->default(1);
            $table->softDeletes();
            $table->timestamps();
            
            $table->foreign('from_currency')->references('id')->on('currencies')->cascadeOnDelete();
            $table->foreign('to_currency')->references('id')->on('currencies')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('forex');
    }
}
