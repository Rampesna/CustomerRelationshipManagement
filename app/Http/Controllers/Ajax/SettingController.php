<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Target;
use App\Services\SettingService;
use App\Services\TargetService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SettingController extends Controller
{
    public function show(Request $request)
    {
        return response()->json(Setting::find(1));
    }

    public function updateMailSettings(Request $request)
    {
        (new SettingService)->updateMailSettings($request);
    }
}
