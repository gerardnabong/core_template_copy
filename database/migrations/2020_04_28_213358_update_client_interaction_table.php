<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateClientInteractionTable extends Migration
{
    public function up()
    {
        Schema::table('client_interactions', function (Blueprint $table) {
            $table->dropColumn(['clicked_at', 'visited_at']);
        });

        Schema::table('client_interactions', function (Blueprint $table) {
            $table->string('button_name')->nullable()->change();
            $table->timestamp('clicked_at')->nullable();
            $table->timestamp('visited_at')->useCurrent();
        });
    }
}
