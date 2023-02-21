<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberDepositSlipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_deposit_slips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained('pcr_members');
            $table->string('file_path', 999)->nullable()->default('');
            $table->integer('month')->unsigned()->nullable()->default(0);
            $table->integer('date')->unsigned()->nullable()->default(0);
            $table->integer('year')->unsigned()->nullable()->default(0);
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
        Schema::dropIfExists('member_deposit_slips');
    }
}
