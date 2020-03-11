<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Model\Portfolio;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class WebsiteController extends Controller
{
    public function index(): View
    {
        return view('index');
    }

    public function getPortfolio(): JsonResponse
    {
        $portfolio = Portfolio::getPortfolio();
        return response()->json($portfolio);
    }
}
