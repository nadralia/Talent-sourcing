<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRemoteTypeIdToTalentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('talents', function (Blueprint $table) {
            Schema::table('talents', function (Blueprint $table) {
                if (! Schema::hasColumn('talents', 'remote_type_id')) {
                    $table->foreignId('remote_type_id')->default(1)
                        ->after('job_status_id')
                        ->constrained('remote_types')
                        ->cascadeOnDelete();
                }
            });
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
            if (Schema::hasColumn('talents', 'remote_type_id')) {
                $table->dropForeign([ 'remote_type_id' ]);
                $table->dropColumn('remote_type_id');
            }
        });
    }
}
