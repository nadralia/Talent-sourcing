<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddScoreToDegreesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('degrees', function (Blueprint $table) {
            if (! Schema::hasColumn('degrees', 'score')) {
                $table->integer('score')->after('name')->default(1)->inde();
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
        Schema::table('degrees', function (Blueprint $table) {
            if (Schema::hasColumn('degrees', 'score')) {
                $table->dropColumn('score');
            }
        });
    }
}
