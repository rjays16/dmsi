<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateChatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('chats', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->change();
            $table->unsignedBigInteger('receiver_id')->nullable();
            $table->string('type', 50)->nullable()->default('text');
            $table->boolean('viewed')->nullable()->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chats', function (Blueprint $table) {
            $table->dropColumn('receiver_id');
            $table->dropColumn('type');
            $table->dropColumn('viewed');
        });
    }
}
