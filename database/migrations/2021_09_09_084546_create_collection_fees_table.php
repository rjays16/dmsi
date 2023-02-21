<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectionFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collection_fees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('payment_type');
            $table->foreign('payment_type')->references('id')->on('order_types');
            $table->string('description', 255)->nullable();
            $table->decimal('amount', 8, 2)->default(0);
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('collection_fees');
    }
}
