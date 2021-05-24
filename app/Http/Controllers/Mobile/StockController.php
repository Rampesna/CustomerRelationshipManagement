<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        return view('mobile.stock.index');
    }

    public function show(Request $request)
    {
        return 1;
    }
}
