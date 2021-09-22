<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Definition;
use App\Models\Opportunity;
use App\Models\Province;
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
        filterColumn('relation_id', function ($activities, $keyword) {
            return $activities->whereIn('relation_id',
                array_merge(
                    Opportunity::where('name', 'like', '%' . $keyword . '%')->pluck('id')->toArray(),
                    Customer::where('title', 'like', '%' . $keyword . '%')->pluck('id')->toArray()
                ));
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
        filterColumn('province_id', function ($activities, $keyword) {
            return $activities->whereIn('relation_id',
                array_merge(
                    Opportunity::whereIn('province_id', Province::where('name', 'like', '%' . $keyword . '%')->pluck('id')->toArray())->pluck('id')->toArray(),
                    Customer::whereIn('province_id', Province::where('name', 'like', '%' . $keyword . '%')->pluck('id')->toArray())->pluck('id')->toArray()
                )
            );
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
            return @$activity->relation_type == 'App\\Models\\Opportunity' && $activity->relation ? $activity->relation->name : (
            @$activity->relation_type == 'App\\Models\\Customer' && $activity->relation ? $activity->relation->title : (
            @$activity->relation_type == 'App\\Models\\Manager' && $activity->relation ? $activity->relation->name : @$activity->relation_id
            )
            );
        })->
        editColumn('company_id', function ($activity) {
            return $activity->company ? @$activity->company->name : '';
        })->
        editColumn('user_id', function ($activity) {
            return $activity->user ? @$activity->user->name : '';
        })->
        editColumn('start_date', function ($activity) {
            return $activity->start_date ? date('d.m.Y', strtotime($activity->start_date)) : '';
        })->
        editColumn('province_id', function ($activity) {
            return $activity->relation ? ($activity->relation->province ? $activity->relation->province->name : '') : '';
        })->
        editColumn('priority_id', function ($activity) {
            return $activity->priority ? @$activity->priority->name : '';
        })->
        editColumn('meet_reason_id', function ($activity) {
            return $activity->meet_reason ? @$activity->meetReason->name : '';
        })->
        rawColumns(['customer_id', 'status_id'])->
        make(true);
    }

    public function reportDatatable(Request $request)
    {
        $activities = Activity::with([]);

        if ($request->all_companies == 0) {
            $activities->where('company_id', $request->company_id);
        }

        if ($request->start_date) {
            $activities->where('start_date', '>=', $request->start_date);
        }

        if ($request->end_date) {
            $activities->where('start_date', '<=', $request->end_date);
        }

        if ($request->subject) {
            $activities->where('subject', 'like', '%' . $request->subject . '%');
        }

        if ($request->meet_reasons && count($request->meet_reasons) > 0) {
            $activities->whereIn('meet_reason_id', $request->meet_reasons);
        }

        if ($request->priorities && count($request->priorities) > 0) {
            $activities->whereIn('priority_id', $request->priorities);
        }

        return Datatables::of($activities)->
        filterColumn('relation_type', function ($activities, $data) {
            return $data == "All" ? $activities : $activities->where('relation_type', $data);
        })->
        filterColumn('company_id', function ($activities, $keyword) {
            return $activities->whereIn('company_id', Company::where('name', 'like', '%' . $keyword . '%')->pluck('id'));
        })->
        filterColumn('user_id', function ($activities, $keyword) {
            return $activities->whereIn('user_id', User::where('name', 'like', '%' . $keyword . '%')->pluck('id'));
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
        return response()->json(Activity::with([
            'relation',
            'meetReason',
            'priority'
        ])->find($request->id), 200);
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
