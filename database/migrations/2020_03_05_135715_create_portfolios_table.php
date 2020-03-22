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
            $table->string('url')->index();
            $table->string('logo_url');
            $table->string('primary_color');
            $table->string('icon_color');
            $table->string('button_hover_color');
            $table->string('header_image_mobile_url');
            $table->string('header_image_url');
            $table->string('footer_image_url');
            $table->string('footer_image_mobile_url');
            $table->string('phone_number');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('portfolios');
    }
}
