<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Model\Portfolio;

class WebsiteController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function getPortfolio()
    {
        $portfolio = Portfolio::getPortfolio();
        return response()->json($portfolio);
    }
}
