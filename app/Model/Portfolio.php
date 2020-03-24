<?php

declare(strict_types=1);

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Portfolio extends Model
{
    const PORTFOLIO = 'portfolio';
    const CURR_PORTFOLIO_CACHE_TIME_MIN = 2;

    public static function getPortfolio(): Portfolio
    {
        return cache()->remember(
            self::PORTFOLIO . $_SERVER['SERVER_NAME'],
            Carbon::now()->addMinute(self::CURR_PORTFOLIO_CACHE_TIME_MIN),
            function () {
                return Portfolio::where('url', $_SERVER['SERVER_NAME'])->firstOrFail();
            }
        );
    }
}
