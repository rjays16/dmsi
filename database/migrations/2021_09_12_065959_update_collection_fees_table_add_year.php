<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCollectionFeesTableAddYear extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('collection_fees', function (Blueprint $table) {
            $table->year('year')->nullable()->after('payment_type');
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
            $table->dropColumn('year');
        });
    }
}
