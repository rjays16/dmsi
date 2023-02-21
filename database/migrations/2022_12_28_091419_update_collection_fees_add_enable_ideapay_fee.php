<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCollectionFeesAddEnableIdeapayFee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('collection_fees', function (Blueprint $table) {
            $table->boolean('enable_ideapay_fee')->default(true)->after('fiscal_period_id');
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
            $table->dropColumn('enable_ideapay_fee');
        });
    }
}
