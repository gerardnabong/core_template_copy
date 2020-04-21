<?php

declare(strict_types=1);

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Portfolio extends Model
{
    const PORTFOLIO_CACHE_KEY = 'portfolio_details';
    const PORTFOLIO_CACHE_TIME_MIN = 20;
    const PORTFOLIO_LEAD_ID = [
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

    public static function getPortfolio(): Portfolio
    {
        $url = str_replace(array('http://', 'https://'), '', url(''));
        return cache()->remember(
            self::PORTFOLIO_CACHE_KEY . $url,
            Carbon::now()->addMinute(self::PORTFOLIO_CACHE_TIME_MIN),
            function () use ($url) {
                return Portfolio::where('url', $url)->firstOrFail();
            }
        );
    }

    public function client(): HasMany
    {
        return $this->hasMany(Client::class);
    }
}
