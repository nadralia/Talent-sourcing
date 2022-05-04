<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateForexTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('forex', function (Blueprint $table) {
            if (Schema::hasColumn('forex', 'name')) {
                $table->dropColumn('name');
            }

            $table->decimal('value', 10, 6)->after('id');
        });
    }
}
