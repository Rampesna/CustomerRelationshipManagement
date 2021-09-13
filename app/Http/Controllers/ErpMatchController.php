<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErpMatchController extends Controller
{
    public function index()
    {
        return view('pages.erpMatch.index.index');
    }

    public function show(Request $request)
    {
        try {
            return view('pages.erpMatch.matches.' . $request->match . '.index');
        } catch (\Exception $exception) {
            return abort(404);
        }
    }
}
