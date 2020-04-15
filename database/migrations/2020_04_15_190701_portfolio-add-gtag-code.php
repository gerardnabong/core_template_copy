<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Model\Portfolio;


class PortfolioAddGtagCode extends Migration
{
    public function up()
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->string('gtag_code')->nullable();
        });

        $this->updatePortfolios();
    }

    public function updatePortfolios(): void
    {
        (Portfolio::where('display_name', 'Inbox Credit')->first())->update(['gtag_code' => 'G-9PS6ZGV8EL']);
        (Portfolio::where('display_name', 'Comet Loans')->first())->update(['gtag_code' => 'G-W554LZW7MC']);
        (Portfolio::where('display_name', 'First Loan')->first())->update(['gtag_code' => 'G-42BV2XQGG4']);
        (Portfolio::where('display_name', 'Better Day Loan')->first())->update(['gtag_code' => 'G-JRNBTX0MB']);
    }

    public function down()
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->removeColumn('gtag_code');
        });
    }
}
