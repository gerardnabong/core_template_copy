<?php

declare(strict_types=1);

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Portfolio extends Model
{
    const PORTFOLIO_CACHE_KEY = 'portfolio';
    const PORTFOLIO_CACHE_TIME_MIN = 20;

    public static function getPortfolio(): Portfolio
    {
        return cache()->remember(
            self::PORTFOLIO_CACHE_KEY . $_SERVER['SERVER_NAME'],
            Carbon::now()->addMinute(self::PORTFOLIO_CACHE_TIME_MIN),
            function () {
                return Portfolio::where('url', $_SERVER['SERVER_NAME'])->firstOrFail();
            }
        );
    }

    public function login()
    {
        return $this->hasMany('App\Model\Login');
    }
}
