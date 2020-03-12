<?php

declare(strict_types=1);

use Illuminate\Database\Seeder;
use App\Model\Portfolio;

class PortfolioTableSeeder extends Seeder
{
    public function run()
    {
        factory(Portfolio::class)->create([
            'url' => 'localhost',
            'logo_url' => 'inbox_credit_white_logo.svg',
            'button_color' => '004F95',
            'button_hover_color' => '014A8D',
            'header_image_mobile_url' => 'blue_arc_bg_header.svg',
            'header_image_url' => 'blue_arc_bg.svg',
            'footer_image_url' => 'wave_footer.svg',
            'footer_image_mobile_url' => 'footer_wave_bg.svg',
            'phone_number' => '1-855-573-4504',
        ]);
    }
}
