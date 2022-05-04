<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBirthdayToTalentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('talents', function (Blueprint $table) {
            if (! Schema::hasColumn('talents', 'birthday')) {
                $table->string('birthday', 5)->nullable()->index()->after('phone');
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
            if (Schema::hasColumn('talents', 'birthday')) {
                $table->dropIndex([ 'birthday' ]);
                $table->dropColumn('birthday');
            }
        });
    }
}
