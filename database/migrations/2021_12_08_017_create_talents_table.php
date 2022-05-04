<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTalentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('talents', function (Blueprint $table) {
            $table->id('id');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('avatar')->nullable();
            $table->foreignId('title_id')->constrained('titles');
            $table->string('first_name');
            $table->string('last_name');
            $table->unsignedBigInteger('phone')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('github')->nullable();
            $table->string('twitter')->nullable();
            $table->string('website')->nullable();
            $table->char('nationality', 2)->nullable();
            $table->foreignId('gender_id')->nullable()->contrained('genders');
            $table->boolean('enabled')->index()->default(1);
            $table->string('referral_code')->nullable();
            $table->foreignId('referrer')->nullable();
            $table->foreignId('admin_id')->nullable()->constrained('admins');
            $table->boolean('do_not_contact')->nullable()->default(0);
            $table->foreignId('notice_period_id')->nullable()->constrained('notice_periods');
            $table->integer('min_salary')->nullable();
            $table->integer('max_salary')->nullable();
            $table->integer('completeness')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('nationality')->references('id')->on('countries')->cascadeOnDelete();
            $table->foreign('referrer')->references('id')->on('talents')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('talents');
    }
}
