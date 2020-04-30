<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Model\Portfolio;

class AddColumnUaTagToPortfolios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->string('ua_tag');
        });
        foreach (Portfolio::PORTFOLIO_LEAD_ID as $portfolio) {
            Portfolio::where('display_name', $portfolio['display_name'])
                ->update(['ua_tag' => $portfolio['ua_tag']]);
        }
    }
}
