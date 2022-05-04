<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJobStatusToTalentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('talents', function (Blueprint $table) {
            if (! Schema::hasColumn('talents', 'job_status_id')) {
                $table->unsignedBigInteger('job_status_id')->default(1)->after('phone');
                $table->foreign('job_status_id')->references('id')->on('job_statuses')->cascadeOnDelete();
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
            if (Schema::hasColumn('talents', 'job_status_id')) {
                $table->dropForeign([ 'job_status_id' ]);
                $table->dropColumn('job_status_id');
            }
        });
    }
}
