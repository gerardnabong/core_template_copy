<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientInputsTable extends Migration
{
    public function up()
    {
        Schema::create('client_inputs', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('input_name');
            $table->string('input_value');
            $table->integer('client_interaction_id')->unsigned();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('client_inputs');
    }
}
