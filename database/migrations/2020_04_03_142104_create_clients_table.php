<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('portfolio_id')->unsigned();
            $table->integer('lead_id')->unsigned();
            $table->integer('lead_status_id')->unsigned()->nullable();
            $table->timestamp('login_at')->useCurrent();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
