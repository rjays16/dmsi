<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ElectionPeriod extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('election_period', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('year');
            $table->dateTime('date_started');
            $table->dateTime('date_end');
            $table->tinyInteger('is_active')->default(1);
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
        Schema::dropIfExists('election_period');
    }
}
