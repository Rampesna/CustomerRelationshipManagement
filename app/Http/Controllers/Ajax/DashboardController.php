<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Opportunity;
use App\Models\Target;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        setlocale(LC_TIME, 'Turkish');

        return response()->json([
            'opportunity' => [
                'date' => strftime("%B %Y"),
                'created' => Opportunity::whereBetween('created_at', [
                    date('Y-m-01 00:00:00'),
                    date('Y-m-01 23:59:59')
                ])->count(),
                'target' => Target::where('year', date('Y'))->where('month', date('m'))->where('type', 'opportunity')->first()->target ?? 0
            ],
            'activity' => [
                'date' => strftime("%B %Y"),
                'created' => Activity::whereBetween('created_at', [
                    date('Y-m-01 00:00:00'),
                    date('Y-m-01 23:59:59')
                ])->count(),
                'target' => Target::where('year', date('Y'))->where('month', date('m'))->where('type', 'activity')->first()->target ?? 0,
                'lastActivities' => Activity::with([
                    'relation'
                ])->orderBy('updated_at', 'desc')->limit(10)->get()
            ]
        ]);
    }
}
