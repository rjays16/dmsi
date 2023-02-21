<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ElectionNominees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
        Schema::create('election_nominees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('election_period_id')
            ->unsigned();
            $table->foreign('election_period_id')
            ->references('id')
            ->on('election_period')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->bigInteger('member_id')
            ->unsigned();
            $table->foreign('member_id')
            ->references('id')
            ->on('pcr_members')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->longText('short_bio')->nullable();
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
        Schema::dropIfExists('election_nominees');
    }
}
