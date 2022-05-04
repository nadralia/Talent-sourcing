<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class DropProficienciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('proficiencies')) {
            Schema::table('proficiencies', function (Blueprint $table) {
                // $table->dropIndex('proficiencies_enabled_index');
            });
    
            Schema::drop('proficiencies');   
        }
    }
}
