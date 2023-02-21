<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFooterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('footers', function (Blueprint $table) {
            $table->id();
            $table->string('footer_rights_text', 100)->nullable()->default('');
            $table->string('footer_logo_img', 100)->nullable()->default('');
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
        Schema::dropIfExists('footers');
    }
}
