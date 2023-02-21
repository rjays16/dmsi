<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePcrMembersTableAddMemberSinceColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pcr_members', function (Blueprint $table) {
            $table->unsignedBigInteger('member_since')->after('id')->default(2021);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pcr_members', function (Blueprint $table) {
            $table->dropColumn('member_since');
        });
    }
}
