<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTalentVettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('talent_vettings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('talent_id')->constrained('talents');
            $table->foreignId('admin_id')->constrained('admins');
            $table->foreignId('vetting_stage_id')->constrained('vetting_stages');
            $table->text('comment')->nullable();
            $table->boolean('enabled')->index()->default(1);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('talent_vettings');
    }
}
