<?php

declare(strict_types=1);

use Illuminate\Database\Seeder;
use App\Model\Portfolio;

class PortfolioTableSeeder extends Seeder
{
    public function run()
    {
        $portfolio = factory(Portfolio::class)->create();
    }
}
