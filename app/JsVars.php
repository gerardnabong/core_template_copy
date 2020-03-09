<?php
declare(strict_types=1);

namespace App;

use App\Model\Portfolio;

class JSVars
{
    public static function getPortfolio(){
        return Portfolio::getPortfolio();
    }
}
