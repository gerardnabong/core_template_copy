<?php

declare(strict_types=1);

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    public static function getPortfolio(): Portfolio
    {
        return Portfolio::where('url', $_SERVER['SERVER_NAME'])->first();
    }
}
