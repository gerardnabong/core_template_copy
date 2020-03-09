<?php

declare(strict_types=1);

namespace App\Http\Controllers;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use App\Model\Portfolio;

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
