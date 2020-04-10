<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientInteractionsTable extends Migration
{
    public function up()
    {
        Schema::create('client_interactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lead_id')->unsigned();
            $table->integer('page_id')->unsigned();
            $table->boolean('is_button_click')->default(false);
            $table->string('button_name');
            $table->timestamp('clicked_at');
            $table->timestamp('visited_at');
            $table->boolean('is_successful')->default(false);
            $table->timestamps();
        });

        $this->addForeignKey();
    }

    private function addForeignKey()
    {
        Schema::table('client_inputs', function (Blueprint $table) {
            $table->foreign('client_interaction_id')->references('id')->on('client_inputs');
        });
    }

    public function down()
    {
        Schema::dropIfExists('client_interactions');
    }
}
