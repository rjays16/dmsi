<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIdeapayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ideapay', function (Blueprint $table) {
            $table->id();
            $table->string('payment_ref')->nullable();
            $table->string('payment_url')->nullable();
            $table->unsignedBigInteger('status');
            $table->foreign('status')->references('id')->on('ideapay_status');
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
        Schema::dropIfExists('ideapay');
    }
}
