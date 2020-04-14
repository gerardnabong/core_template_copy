<?php

declare(strict_types=1);

use App\Model\Portfolio;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NewPortfolioUrl extends Migration
{
    public function up()
    {
        Schema::drop('portfolios');
        Schema::create('portfolios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url')->index();
            $table->string('display_name');
            $table->string('primary_color');
            $table->string('secondary_color');
            $table->string('primary_color_hover');
            $table->string('phone_number');
            $table->string('asset_directory');
            $table->timestamps();
        });
        Portfolio::insert($this->getPortfolios());
        Schema::table('clients', function (Blueprint $table) {
            $table->foreign('portfolio_id')->references('id')->on('portfolios');
        });
    }

    private function getPortfolios(): array
    {
        return [
            [
                'url' => 'dev.portal.inboxcredit.com',
                'display_name' => 'Inbox Credit',
                'asset_directory' => 'InboxCreditDev',
                'primary_color' => '#004F95',
                'secondary_color' => '#004F95',
                'primary_color_hover' => '#014A8D',
                'phone_number' => '1-855-573-4504',
            ], [
                'url' => 'dev.portal.betterdayloan.com',
                'display_name' => 'Better Day Loan',
                'asset_directory' => 'BetterDayLoansDev',
                'primary_color' => '#2CA6CF',
                'secondary_color' => '#FAC401',
                'primary_color_hover' => '#24A2CC',
                'phone_number' => '1-866-258-0165',
            ], [
                'url' => 'dev.portal.firstloan.com',
                'display_name' => 'First Loan',
                'asset_directory' => 'FirstLoanDev',
                'primary_color' => '#0D64A5',
                'secondary_color' => '#0D64A5',
                'primary_color_hover' => '#0B5E9D',
                'phone_number' => '1-888-340-2911',
            ], [
                'url' => 'dev.portal.cometloan.com',
                'display_name' => 'Comet Loans',
                'asset_directory' => 'CometLoansDev',
                'primary_color' => '#FD6A00',
                'secondary_color' => '#FD6A00',
                'primary_color_hover' => '#F36804',
                'phone_number' => '1-888-552-6638',
            ], [
                'url' => 'dev.portal.inboxloan.com',
                'display_name' => 'Inbox Loan',
                'asset_directory' => 'InboxLoanDev',
                'primary_color' => '#004F95',
                'secondary_color' => '#004F95',
                'primary_color_hover' => '#014A8D',
                'phone_number' => '1-800-930-9066',
            ], [
                'url' => 'portal.inboxcredit.com',
                'display_name' => 'Inbox Credit',
                'asset_directory' => 'InboxCredit',
                'primary_color' => '#004F95',
                'secondary_color' => '#004F95',
                'primary_color_hover' => '#014A8D',
                'phone_number' => '1-855-573-4504',
            ], [
                'url' => 'portal.betterdayloan.com',
                'display_name' => 'Better Day Loan',
                'asset_directory' => 'BetterDayLoans',
                'primary_color' => '#2CA6CF',
                'secondary_color' => '#FAC401',
                'primary_color_hover' => '#24A2CC',
                'phone_number' => '1-866-258-0165',
            ], [
                'url' => 'portal.firstloan.com',
                'display_name' => 'First Loan',
                'asset_directory' => 'FirstLoan',
                'primary_color' => '#0D64A5',
                'secondary_color' => '#0D64A5',
                'primary_color_hover' => '#0B5E9D',
                'phone_number' => '1-888-340-2911',
            ], [
                'url' => 'portal.cometloans.com',
                'display_name' => 'Comet Loans',
                'asset_directory' => 'CometLoans',
                'primary_color' => '#FD6A00',
                'secondary_color' => '#FD6A00',
                'primary_color_hover' => '#F36804',
                'phone_number' => '1-888-552-6638',
            ], [
                'url' => 'portal.inboxloan.com',
                'display_name' => 'Inbox Loan',
                'asset_directory' => 'InboxLoan',
                'primary_color' => '#004F95',
                'secondary_color' => '#004F95',
                'primary_color_hover' => '#014A8D',
                'phone_number' => '1-800-930-9066',
            ],

        ];
    }
}
