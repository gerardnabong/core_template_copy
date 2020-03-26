<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientInteractionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_interactions', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('lead_id');
            $table->integer('page_id');
            $table->boolean('is_button_click')->default(false);
            $table->string('button_name');
            $table->timestamp('clicked_at');
            $table->timestamp('visited_at');
            $table->boolean('is_successful')->default(false);
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
        Schema::dropIfExists('client_interactions');
    }
}
