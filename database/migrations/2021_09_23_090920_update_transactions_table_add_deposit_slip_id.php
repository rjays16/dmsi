<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTransactionsTableAddDepositSlipId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->unsignedBigInteger('deposit_slip_id');
            // $table->foreign('deposit_slip_id')->references('id')->on('deposit_slips');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            // $table->dropForeign('deposit_slip_id');
            $table->dropColumn('deposit_slip_id');
        });
    }
}
