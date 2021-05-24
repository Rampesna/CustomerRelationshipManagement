<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index()
    {
        return view('mobile.activity.index');
    }

    public function show(Request $request)
    {
        return 1;
    }
}
