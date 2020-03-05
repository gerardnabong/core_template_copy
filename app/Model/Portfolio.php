<?php

declare(strict_types=1);

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    public function getByUrl(String $url): Portfolio
    {
        return $this->where('url', $url)->first();
    }
}
