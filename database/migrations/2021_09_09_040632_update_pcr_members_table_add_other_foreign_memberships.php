<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePcrMembersTableAddOtherForeignMemberships extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pcr_members', function (Blueprint $table) {
            $table->unsignedBigInteger('spec_div_mem_type')->nullable()->after('mem_type_id');
            $table->foreign('spec_div_mem_type')->references('id')->on('specialty_division_memberships');

            $table->unsignedBigInteger('affi_soc_mem_type')->nullable()->after('spec_div_mem_type');
            $table->foreign('affi_soc_mem_type')->references('id')->on('affiliate_society_memberships');
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
            $table->dropForeign(['spec_div_mem_type']);
            $table->dropColumn('spec_div_mem_type');

            $table->dropForeign(['affi_soc_mem_type']);
            $table->dropColumn('affi_soc_mem_type');
        });
    }
}
