<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Opportunity;
use App\Services\ActivityService;
use App\Services\OpportunityService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ActivityController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(Activity::where('company_id', $request->company_id)->get());
    }

    public function datatable(Request $request)
    {
        setlocale(LC_ALL, 'tr_TR.UTF-8');
        setlocale(LC_TIME, 'Turkish');

        return Datatables::of(Activity::with([])->where('company_id', $request->company_id))->
        editColumn('id', function ($activity) {
            return '#' . $activity->id;
        })->
        editColumn('relation_type', function ($activity) {
            return @$activity->relation_type == 'App\\Models\\Opportunity' ? 'Fırsat' : (
            @$activity->relation_type == 'App\\Models\\Customer' ? 'Müşteri' : (
            @$activity->relation_type == 'App\\Models\\Manager' ? 'Yetkili' : @$activity->relation_type
            )
            );
        })->
        editColumn('relation_id', function ($activity) {
            return @$activity->relation_type == 'App\\Models\\Opportunity' ? $activity->relation->name : (
            @$activity->relation_type == 'App\\Models\\Customer' ? $activity->relation->title : (
            @$activity->relation_type == 'App\\Models\\Manager' ? $activity->relation->name : @$activity->relation_id
            )
            );
        })->
        editColumn('company_id', function ($activity) {
            return $activity->company_id ? @$activity->company->name : '';
        })->
        editColumn('user_id', function ($activity) {
            return $activity->user_id ? @$activity->user->name : '';
        })->
        editColumn('start_date', function ($activity) {
            return $activity->start_date ? date('d.m.Y', strtotime($activity->start_date)) : '';
        })->
        editColumn('end_date', function ($activity) {
            return $activity->end_date ? date('d.m.Y', strtotime($activity->end_date)) : '';
        })->
        editColumn('priority_id', function ($activity) {
            return $activity->priority_id ? @$activity->priority->name : '';
        })->
        editColumn('meet_reason_id', function ($activity) {
            return $activity->meet_reason_id ? @$activity->meetReason->name : '';
        })->
        rawColumns(['customer_id', 'status_id'])->
        make(true);
    }

    public function show(Request $request)
    {
        return response()->json(Activity::find($request->id), 200);
    }

    public function save(Request $request)
    {
        $activityService = new ActivityService;
        $activityService->setActivity($request->id ? Activity::find($request->id) : new Activity);
        $activityService->save($request);
    }

    public function drop(Request $request)
    {
        Activity::find($request->id)->delete();
    }
}
