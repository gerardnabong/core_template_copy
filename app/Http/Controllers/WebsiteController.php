<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Portfolio;

class WebsiteController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function getPortfolio()
    {
        return response()->json((new Portfolio)->getByUrl($_SERVER['SERVER_NAME']));
    }
}
