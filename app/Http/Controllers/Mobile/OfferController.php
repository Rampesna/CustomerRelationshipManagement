<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function index()
    {
        return view('mobile.offer.index');
    }

    public function show(Request $request)
    {
        return 1;
    }
}
