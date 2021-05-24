<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PriceListController extends Controller
{
    public function index()
    {
        return view('mobile.priceList.index');
    }

    public function show(Request $request)
    {
        return 1;
    }
}
