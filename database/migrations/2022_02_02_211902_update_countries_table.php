<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('countries', function (Blueprint $table) {
            if (! Schema::hasColumn('countries', 'timezone')) {
                $table->string('timezone')->nullable()->after('code');
            }

            if (! Schema::hasColumn('countries', 'phone_code')) {
                $table->integer('phone_code')->nullable()->after('code');
            }

            if (! Schema::hasColumn('countries', 'currency_id')) {
                $table->char('currency_id')->nullable()->after('code');
                $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('cascade');
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
        Schema::table('countries', function (Blueprint $table) {
            if (Schema::hasColumn('countries', 'timezone')) {
                $table->dropColumn('timezone');
            }

            if (Schema::hasColumn('countries', 'phone_code')) {
                $table->dropColumn('phone_code');
            }

            if (Schema::hasColumn('countries', 'currency_id')) {
                $table->dropForeign([ 'currency_id' ]);
                $table->dropColumn('currency_id');
            }
        });
    }
}
