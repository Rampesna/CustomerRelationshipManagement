<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Company;
use App\Models\Definition;
use App\Models\User;
use App\Services\ActivityService;
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
        return Datatables::of(Activity::with([])->where('company_id', $request->company_id))->
        filterColumn('relation_type', function ($activities, $data) {
            return $data == "All" ? $activities : $activities->where('relation_type', $data);
        })->
        filterColumn('company_id', function ($activities, $keyword) {
            return $activities->whereIn('company_id', Company::where('name', 'like', '%' . $keyword . '%')->pluck('id'));
        })->
        filterColumn('user_id', function ($activities, $keyword) {
            return $activities->whereIn('user_id', User::where('name', 'like', '%' . $keyword . '%')->pluck('id'));
        })->
        filterColumn('start_date', function ($activities, $date) {
            return $activities->where('start_date', '>=', $date);
        })->
        filterColumn('end_date', function ($activities, $date) {
            return $activities->where('end_date', '<=', $date);
        })->
        editColumn('id', function ($activity) {
            return '#' . $activity->id;
        })->
        filterColumn('meet_reason_id', function ($activities, $keyword) use ($request) {
            return $activities->whereIn('meet_reason_id', Definition::where('company_id', $request->company_id)->where('name', 'Aktivite Görüşme Nedenleri')->first()->definitions()->where('name', 'like', '%' . $keyword . '%')->pluck('id'));
        })->
        filterColumn('priority_id', function ($activities, $keyword) use ($request) {
            return $activities->whereIn('priority_id', Definition::where('company_id', $request->company_id)->where('name', 'Aktivite Öncelik Durumları')->first()->definitions()->where('name', 'like', '%' . $keyword . '%')->pluck('id'));
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
        $activity = Activity::find($request->id);
        if ($activity->created_by == $request->auth_user_id) {
            $activity->delete();
            return response()->json([
                'type' => 'success',
                'message' => 'Aktivite Başarıyla Silindi'
            ], 200);
        } else {
            if (User::find($request->auth_user_id)->authority(64)) {
                $activity->delete();
                return response()->json([
                    'type' => 'success',
                    'message' => 'Aktivite Başarıyla Silindi'
                ], 200);
            } else {
                return response()->json([
                    'type' => 'warning',
                    'message' => 'Başka Kullanıcıya Ait Verileri Silme Yetkiniz Bulunmuyor!'
                ], 200);
            }
        }
    }
}
