<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConventionContestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('convention_contests', function (Blueprint $table) {
            $table->id();
            $table->string('contest_name', 450)->nullable()->default('');
            $table->string('contest_author', 450)->nullable()->default('');
            $table->string('convention_year', 450)->nullable()->default('');
            $table->string('contest_title', 450)->nullable()->default('');
            $table->string('contest_institution', 450)->nullable()->default('');
            $table->string('contest_description', 999)->nullable()->default('');
            $table->string('contest_pdf', 400)->nullable()->default('');
            $table->string('contest_image', 400)->nullable()->default('');
            $table->string('contest_rank', 400)->nullable()->default('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('convention_contests');
    }
}
