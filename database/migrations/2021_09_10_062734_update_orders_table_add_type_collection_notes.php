<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOrdersTableAddTypeCollectionNotes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('type')->nullable()->after('year');
            $table->foreign('type')->references('id')->on('order_types');
            $table->unsignedBigInteger('collection_type_id')->nullable()->after('type');
            $table->string('admin_notes', 255)->nullable()->after('collection_type_id');
            $table->string('member_notes', 255)->nullable()->after('admin_notes');
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
            $table->dropForeign(['type']);
            $table->dropColumn(['type', 'collection_type_id', 'admin_notes', 'member_notes']);
        });
    }
}
