<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Schema;
use App\Model\Portfolio;

class CreatePortfoliosTable extends Migration
{
    public function up()
    {
        // TODO will remove all assets to a static json file by next commit
        Schema::create('portfolios', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('url')->index();
            $table->string('name');
            $table->string('primary_color');
            $table->string('secondary_color');
            $table->string('primary_color_hover');
            $table->string('phone_number');
            $table->timestamps();
        });

        Portfolio::insert($this->getPortfolios());
    }

    private function getPortfolios()
    {
        $portfolios = [
            [
                'url' => 'inboxcredit',
                'name' => 'InboxCredit',
                'primary_color' => '#004F95',
                'secondary_color' => '#004F95',
                'primary_color_hover' => '#014A8D',
                'phone_number' => '1-855-573-4504',
            ], [
                'url' => 'betterdaysloan',
                'name' => 'BetterDayLoans',
                'primary_color' => '#2CA6CF',
                'secondary_color' => '#FAC401',
                'primary_color_hover' => '#24A2CC',
                'phone_number' => '1-866-258-0165',
            ], [
                'url' => 'firstloan',
                'name' => 'FirstLoan',
                'primary_color' => '#0D64A5',
                'secondary_color' => '#0D64A5',
                'primary_color_hover' => '#0B5E9D',
                'phone_number' => '1-888-340-2911',
            ], [
                'url' => 'comet',
                'name' => 'CometLoans',
                'primary_color' => '#FD6A00',
                'secondary_color' => '#FD6A00',
                'primary_color_hover' => '#F36804',
                'phone_number' => '1-888-552-6638',
            ], [
                'url' => 'inboxloan',
                'name' => 'InboxLoan',
                'primary_color' => '#004F95',
                'secondary_color' => '#004F95',
                'primary_color_hover' => '#014A8D',
                'phone_number' => '1-800-930-9066',
            ],
        ];
        return $portfolios;
    }

    public function down()
    {
        Schema::dropIfExists('portfolios');
    }
}
