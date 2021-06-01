<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('pages.report.index');
    }

    public function show(Request $request)
    {
        try {
            return view('pages.report.reports.' . $request->report . '.index');
        } catch (\Exception $exception) {
            return abort(404);
        }
    }
}
