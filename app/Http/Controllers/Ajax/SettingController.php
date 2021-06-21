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
        return response()->json(Setting::where('company_id', $request->company_id)->first());
    }

    public function updateMailSettings(Request $request)
    {
        $settingService = new SettingService;
        $settingService->setSetting(Setting::where('company_id', $request->company_id)->first());
        $settingService->updateMailSettings($request);
    }

    public function updateSystemSettings(Request $request)
    {
        $settingService = new SettingService;
        $settingService->setSetting(Setting::where('company_id', $request->company_id)->first());
        $settingService->updateSystemSettings($request);
    }
}
