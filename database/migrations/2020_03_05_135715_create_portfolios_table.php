<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Schema;
use App\Model\Portfolio;

class CreatePortfoliosTable extends Migration
{
    public function up()
    {
        // TODO will remove all assets to a static json file by next commit
        Schema::create('portfolios', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('url')->index();
            $table->string('portfolio_name');
            $table->string('logo_url');
            $table->string('primary_color');
            $table->string('secondary_color');
            $table->string('primary_color_hover');
            $table->string('header_image_mobile_url');
            $table->string('header_image_url');
            $table->string('footer_image_url');
            $table->string('footer_image_mobile_url');
            $table->string('phone_number');
            $table->timestamps();
        });

        Portfolio::insert($this->getPortfolios());
    }

    private function getPortfolios()
    {
        $portfolios = [
            [
                'url' => 'inboxcredit',
                'logo_url' => 'inbox_credit_white_logo.svg',
                'portfolio_name' => 'Inbox Credit',
                'primary_color' => '#004F95',
                'secondary_color' => '#004F95',
                'primary_color_hover' => '#014A8D',
                'header_image_mobile_url' => 'blue_arc_bg_header.svg',
                'header_image_url' => 'blue_arc_bg.svg',
                'footer_image_url' => 'wave_footer.svg',
                'footer_image_mobile_url' => 'footer_wave_bg.svg',
                'phone_number' => '1-855-573-4504',
            ],
            [
                'url' => 'betterdaysloan',
                'logo_url' => 'better_day_logo_desktop.svg',
                'portfolio_name' => 'Better Day Loans',
                'primary_color' => '#2CA6CF',
                'secondary_color' => '#FAC401',
                'primary_color_hover' => '#24A2CC',
                'header_image_mobile_url' => 'better_day_header_mobile.svg',
                'header_image_url' => 'better_day_header_desktop.svg',
                'footer_image_url' => 'better_day_footer_desktop.svg',
                'footer_image_mobile_url' => 'better_day_footer_mobile.svg',
                'phone_number' => '1-866-258-0165',
            ],
            [
                'url' => 'firstloan',
                'logo_url' => 'first_loan_logo.svg',
                'portfolio_name' => 'First Loan',
                'primary_color' => '#0D64A5',
                'secondary_color' => '#0D64A5',
                'primary_color_hover' => '#0B5E9D',
                'header_image_mobile_url' => 'first_loan_header_mobile.svg',
                'header_image_url' => 'first_loan_header_desktop.svg',
                'footer_image_url' => 'first_loan_footer_desktop.svg',
                'footer_image_mobile_url' => 'first_loan_footer_mobile.svg',
                'phone_number' => '1-888-340-2911',
            ],
            [
                'url' => 'comet',
                'logo_url' => 'comet_loan_logo.svg',
                'portfolio_name' => 'Comet Loans',
                'primary_color' => '#FD6A00',
                'secondary_color' => '#FD6A00',
                'primary_color_hover' => '#F36804',
                'header_image_mobile_url' => 'comet_loan_header_mobile.svg',
                'header_image_url' => 'comet_loan_header_desktop.svg',
                'footer_image_url' => 'comet_loan_footer_desktop.svg',
                'footer_image_mobile_url' => 'comet_loan_footer_mobile.svg',
                'phone_number' => '1-888-552-6638',
            ],
            [
                'url' => 'inboxloan',
                'logo_url' => 'inbox_loan_logo.svg',
                'portfolio_name' => 'Inbox Loan',
                'primary_color' => '#004F95',
                'secondary_color' => '#004F95',
                'primary_color_hover' => '#014A8D',
                'header_image_mobile_url' => 'blue_arc_bg_header.svg',
                'header_image_url' => 'blue_arc_bg.svg',
                'footer_image_url' => 'wave_footer.svg',
                'footer_image_mobile_url' => 'footer_wave_bg.svg',
                'phone_number' => '1-800-930-9066',
            ],
        ];
        return $portfolios;
    }

    public function down()
    {
        Schema::dropIfExists('portfolios');
    }
}
