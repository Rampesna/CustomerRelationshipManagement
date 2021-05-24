<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SampleController extends Controller
{
    public function index()
    {
        return view('mobile.sample.index');
    }

    public function show(Request $request)
    {
        return 1;
    }
}
