<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOrdersTableChangeForeignUserToPcrMember extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');

            $table->unsignedBigInteger('pcr_member_id')->after('id');
            $table->foreign('pcr_member_id')->references('id')->on('pcr_members');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->after('id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->dropForeign(['pcr_member_id']);
            $table->dropColumn('pcr_member_id');
        });
    }
}
