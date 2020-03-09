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
                'logo_url' => 'inbox_credit_white_logo.svg',
                'button_color' => '004F95',
                'button_hover_color' => '014A8D',
                'header_background_image_mobile_url' => 'blue_arc_bg_header.svg',
                'header_background_image_url' => 'blue_arc_bg.svg',
                'footer_image_url' => 'wave_footer.svg',
                'footer_image_mobile_url' => 'footer_wave_bg.svg',
            ],
        ]);
    }
}
