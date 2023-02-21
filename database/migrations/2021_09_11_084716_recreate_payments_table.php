<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RecreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('payments');
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pcr_member_id');
            $table->foreign('pcr_member_id')->references('id')->on('pcr_members'); 
            $table->unsignedBigInteger('payment_method');
            $table->foreign('payment_method')->references('id')->on('payment_methods'); 
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders'); 
            $table->decimal('amount', 8, 2)->default(0);
            $table->date('date_paid');
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
        Schema::dropIfExists('payments');
    }
}
