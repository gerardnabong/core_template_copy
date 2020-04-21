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
            $table->integer('lead_portfolio_id');
        });
        $this->setupPortfolioLeadId();
    }

    private function updatePortfolio(array $portfolio): void
    {
        Portfolio::where('display_name', $portfolio['display_name'])
            ->update(['lead_portfolio_id' => $portfolio['lead_portfolio_id']]);
    }

    private function setupPortfolioLeadId(): void
    {
        $portfolios = [
            [
                'display_name' => 'Inbox Credit',
                'lead_portfolio_id' => '19004',
            ], [
                'display_name' => 'Better Day Loan',
                'lead_portfolio_id' => '19007',
            ], [
                'display_name' => 'First Loan',
                'lead_portfolio_id' => '19006',
            ], [
                'display_name' => 'Comet Loans',
                'lead_portfolio_id' => '19003',
            ], [
                'display_name' => 'Inbox Loan',
                'lead_portfolio_id' => '19000',
            ]
        ];
        foreach ($portfolios as $portfolio) {
            $this->updatePortfolio($portfolio);
        }
    }
}
