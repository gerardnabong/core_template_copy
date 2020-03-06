<?php

declare(strict_types=1);

use Illuminate\Database\Seeder;
use App\Model\Portfolio;

class PortfolioTableSeeder extends Seeder
{
    public function run()
    {
        $portfolio = new Portfolio;
        $portfolio->delete();
        $portfolio->insert([
            0 =>
            [
                'id' => 1,
                'url' => 'localhost',
                'logo' => 'inbox_credit_white_logo.svg',
                'button_color' => '004F95',
                'button_hover_color' => '014A8D',
                'header_background_mobile' => 'blue_arc_bg_header.svg',
                'header_background' => 'blue_arc_bg.svg',
                'wave_image' => 'wave_footer.svg',
                'wave_mobile_image' => 'footer_wave_bg.svg',
            ],
        ]);
    }
}
