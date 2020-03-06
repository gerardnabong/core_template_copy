<?php

use Illuminate\Database\Seeder;

class PortfoliosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('portfolios')->delete();
        
        \DB::table('portfolios')->insert(array (
            0 => 
            array (
                'id' => 1,
                'url' => 'localhost',
                'logo' => 'inbox credit white logo.svg',
                'button_color' => '004F95',
                'button_hover_color' => '014A8D',
                'header_background_mobile' => 'blue arc bg header.svg',
                'header_background' => 'blue arc bg.svg',
                'wave' => 'wave footer.svg',
                'wave_mobile' => 'footer wave bg.svg',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}