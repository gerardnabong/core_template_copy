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
        $urlPart = explode('.', $_SERVER["HTTP_HOST"]);
        return cache()->remember(
            self::PORTFOLIO_CACHE_KEY . $urlPart[0],
            Carbon::now()->addMinute(self::PORTFOLIO_CACHE_TIME_MIN),
            function () use ($urlPart) {
                return Portfolio::where('url', $urlPart[0])->firstOrFail();
            }
        );
    }

    public function login(): HasMany
    {
        return $this->hasMany(Login::class);
    }
}
