<?php

namespace App\Http\Controllers;

use App\Models\Opportunity;
use App\Models\User;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function index()
    {
        return view('pages.manager.index');
    }

    public function show(Request $request)
    {
        return 1;
    }
}
