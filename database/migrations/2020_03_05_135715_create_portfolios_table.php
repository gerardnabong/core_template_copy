<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePortfoliosTable extends Migration
{

    public function up()
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('url');
            $table->string('logo');
            $table->string('button_color');
            $table->string('button_hover_color');
            $table->string('header_background_mobile');
            $table->string('header_background');
            $table->string('wave_image');
            $table->string('wave_mobile_image');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('portfolios');
    }
}
