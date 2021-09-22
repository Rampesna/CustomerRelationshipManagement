<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index($tab = 'index')
    {
        try {
            return view('pages.dashboard.' . $tab . '.index');
        } catch (\Exception $exception) {
            abort(404);
        }
    }
}
