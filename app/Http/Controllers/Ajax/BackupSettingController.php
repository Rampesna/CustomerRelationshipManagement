<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\BackupSetting;
use App\Models\Setting;
use App\Models\Target;
use App\Services\SettingService;
use App\Services\TargetService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class BackupSettingController extends Controller
{
    public function show(Request $request)
    {
        return response()->json(BackupSetting::find(1));
    }

    public function update(Request $request)
    {
        $backupSettings = BackupSetting::find(1);
        $backupSettings->database_backup_path = $request->database_backup_path;
        $backupSettings->save();
    }
}
