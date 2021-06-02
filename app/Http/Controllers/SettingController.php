<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return view('pages.setting.index');
    }

    public function show(Request $request)
    {
        try {
            return view('pages.setting.settings.' . $request->setting . '.index');
        } catch (\Exception $exception) {
            return abort(404);
        }
    }
}
