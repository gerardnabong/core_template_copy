<?php

declare(strict_types=1);

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Portfolio extends Model
{
    const PORTFOLIO_CACHE_KEY = 'portfolio';
    const PORTFOLIO_CACHE_TIME_MIN = 20;

    public static function getPortfolio(): Portfolio
    {
        $url_part = explode('.', $_SERVER["HTTP_HOST"]);
        return cache()->remember(
            self::PORTFOLIO_CACHE_KEY . $url_part[0],
            Carbon::now()->addMinute(self::PORTFOLIO_CACHE_TIME_MIN),
            function () use ($url_part) {
                return Portfolio::where('url', $url_part[0])->firstOrFail();
            }
        );
    }

    public function login(): HasMany
    {
        return $this->hasMany(Login::class);
    }
}
