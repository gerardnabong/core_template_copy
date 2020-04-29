<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use App\Model\Page;

class AddRegisterPageDetail extends Migration
{
    public function up()
    {
        $page = [
            'id' => '10001',
            'name' => 'register',
            'url' => '/register',
        ];
        Page::create($page);
    }

    public function down()
    {
        Page::where('url', '/register')->delete();
    }
}
