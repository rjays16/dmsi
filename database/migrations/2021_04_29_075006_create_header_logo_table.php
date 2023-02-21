<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHeaderLogoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('header_logos', function (Blueprint $table) {
            $table->id();
            $table->string('header_logo_img', 990)->nullable()->default('');
            $table->string('header_company_name', 300)->nullable()->default('');
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
        Schema::dropIfExists('header_logos');
    }
}
