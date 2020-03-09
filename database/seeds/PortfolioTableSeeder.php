<?php

declare(strict_types=1);

use Illuminate\Database\Seeder;

class PortfolioTableSeeder extends Seeder
{
    public function run()
    {
        $portfolio = factory(App\Model\Portfolio::class)->make();
    }
}
