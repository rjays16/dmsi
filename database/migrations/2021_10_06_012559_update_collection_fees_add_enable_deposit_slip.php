<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCollectionFeesAddEnableDepositSlip extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('collection_fees', function (Blueprint $table) {
            $table->boolean('enable_deposit_slip')->default(true)->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('collection_fees', function (Blueprint $table) {
            $table->dropColumn('enable_deposit_slip');
        });
    }
}
