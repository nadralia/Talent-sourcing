<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameDescritionColumnInVettingStagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vetting_stages', function (Blueprint $table) {
            if (Schema::hasColumn('vetting_stages', 'desscription')) {
                $table->renameColumn('desscription', 'description');
            }
        });
    }
}
