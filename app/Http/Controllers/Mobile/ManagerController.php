<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function index()
    {
        return view('mobile.manager.index');
    }

    public function show(Request $request)
    {
        return 1;
    }
}
