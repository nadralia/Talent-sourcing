<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameCommentToInternalNotesInTalentVettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('talent_vettings', function (Blueprint $table) {
            if (Schema::hasColumn('talent_vettings', 'comment')) {
                $table->renameColumn('comment', 'internal_notes');
            }
        });
    }
}
