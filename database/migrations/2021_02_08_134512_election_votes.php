<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ElectionVotes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('election_votes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('election_nominee_id')
            ->unsigned();
            $table->bigInteger('voted_by')
            ->unsigned();
            $table->foreign('election_nominee_id')
            ->references('id')
            ->on('election_nominees')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreign('voted_by')
            ->references('id')
            ->on('pcr_members')
            ->onDelete('cascade')
            ->onUpdate('cascade');
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
        Schema::dropIfExists('election_votes');
    }
}
