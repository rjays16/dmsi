<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCollectionFeesAddFiscalPeriodRelation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('collection_fees', function (Blueprint $table) {
            $table->unsignedBigInteger('fiscal_period_id')->after('enable_deposit_slip')->nullable();
            $table->foreign('fiscal_period_id')->references('id')->on('fiscal_periods');
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
            $table->dropForeign(['fiscal_period_id']);
            $table->dropColumn('fiscal_period_id');
        });
    }
}
