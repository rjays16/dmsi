<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUserRelatedTablesAddSoftdeletes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('pcr_members', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('educational_background', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->softDeletes();
        });
        
        Schema::table('deposit_slips', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('ideapay', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('pcr_members', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('educational_background', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('deposit_slips', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('ideapay', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
