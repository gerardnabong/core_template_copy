<?php

declare(strict_types=1);

namespace App;

use App\Model\Portfolio;

class JSVars
{
    public static function getPortfolio(): Portfolio
    {
        return Portfolio::getPortfolio();
    }
}
