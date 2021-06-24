<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index()
    {
        return view('pages.activity.index');
    }

    public function show(Request $request)
    {
        try {
            return view('pages.activity.show.' . $request->tab . '.index', [
                'activity' => Activity::find($request->id),
                'tab' => $request->tab
            ]);
        } catch (\Exception $exception) {
            return abort(404);
        }
    }
}
