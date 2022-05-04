<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMaxChoicesToCultureFitCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('culture_fit_categories', function (Blueprint $table) {
            if (! Schema::hasColumn('culture_fit_categories', 'max_choices')) {
                $table->unsignedInteger('max_choices')->default(10)->after('enabled');
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
        Schema::table('culture_fit_categories', function (Blueprint $table) {
            if (Schema::hasColumn('culture_fit_categories', 'max_choices')) {
                $table->dropColumn('max_choices');
            }
        });
    }
}
