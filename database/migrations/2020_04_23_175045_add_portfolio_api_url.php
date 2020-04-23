<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Model\Portfolio;

class AddPortfolioApiUrl extends Migration
{
    public function up()
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->string('portfolio_api_url');
        });
        foreach (Portfolio::PORTFOLIO_LEAD_ID as $portfolio) {
            Portfolio::where('display_name', $portfolio['display_name'])
                ->update(['portfolio_api_url' => $portfolio['portfolio_api_url']]);
        }
    }
}
