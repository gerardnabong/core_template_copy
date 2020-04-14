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
