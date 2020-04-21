<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Model\Portfolio;

class PortfolioAddPortfolioLeadId extends Migration
{

    public function up()
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->integer('lead_portfolio_id')->unsigned();
        });
        foreach (Portfolio::PORTFOLIO_LEAD_ID as $portfolio) {
            Portfolio::where('display_name', $portfolio['display_name'])
                ->update(['lead_portfolio_id' => $portfolio['lead_portfolio_id']]);
        }
    }
}
