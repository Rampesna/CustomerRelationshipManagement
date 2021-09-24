<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Company;
use App\Models\Opportunity;
use App\Models\Target;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function all(Request $request)
    {
        return response()->json(User::all());
    }

    public function allWithTarget(Request $request)
    {
        $users = User::with([]);

        if (!empty($request->users) && count($request->users) > 0) {
            $users->whereIn('id', $request->users);
        }

        return response()->json($users->get()->map(function ($user) use ($request) {
            $targets = Target::where('user_id', $user->id);
            $opportunities = Opportunity::where('created_by', $user->id);
            $activities = Activity::where('created_by', $user->id);

            if ($request->start_date) {
                $targets->where('start_date', '>=', $request->start_date);
                $opportunities->where('created_at', '>=', $request->start_date);
                $activities->where('created_at', '>=', $request->start_date);
            }

            if ($request->end_date) {
                $targets->where('end_date', '<=', $request->end_date);
                $opportunities->where('created_at', '<=', $request->end_date);
                $activities->where('created_at', '<=', $request->end_date);
            }

            $target = $targets->get();
            $opportunity = $opportunities->get();
            $activity = $activities->get();

            $user->opportunity_target = $opportunity->count() . ' / ' . $target->where('type', 'opportunity')->sum('target');
            $user->activity_target = $activity->count() . ' / ' . $target->where('type', 'activity')->sum('target');

            return $user;
        }));
    }

    public function index(Request $request)
    {
        return response()->json(Company::find($request->company_id)->users);
    }

    public function datatable(Request $request)
    {
        $model = User::with([]);

        if ($request->listing == 'all') {
            $model->withTrashed();
        } else if ($request->listing == 'passive') {
            $model->onlyTrashed();
        }

        return Datatables::of($model)->
        editColumn('id', function ($user) {
            return '#' . $user->id;
        })->
        editColumn('role_id', function ($user) {
            return $user->role_id ? $user->role->name : '';
        })->
        make(true);
    }

    public function targetReportDatatable(Request $request)
    {
        $users = User::with([]);

        if ($request->users && count($request->users) > 0) {
            $users->whereIn('id', $request->users);
        }

        return Datatables::of($users)->
        editColumn('opportunity_target', function ($user) use ($request) {
            $targets = Target::where('user_id', $user->id)->where('type', 'opportunity');
            $opportunities = Opportunity::where('created_by', $user->id);

            if ($request->start_date) {
                $targets->where('start_date', '>=', $request->start_date);
                $opportunities->where('created_at', '>=', $request->start_date);
            }

            if ($request->end_date) {
                $targets->where('end_date', '<=', $request->end_date);
                $opportunities->where('created_at', '<=', $request->end_date);
            }

            $target = $targets->get();
            $opportunity = $opportunities->get();

            return $opportunity->count() . ' / ' . $target->sum('target');
        })->
        editColumn('activity_target', function ($user) use ($request) {
            $targets = Target::where('user_id', $user->id)->where('type', 'activity');
            $activities = Activity::where('created_by', $user->id);

            if ($request->start_date) {
                $targets->where('start_date', '>=', $request->start_date);
                $activities->where('created_at', '>=', $request->start_date);
            }

            if ($request->end_date) {
                $targets->where('end_date', '<=', $request->end_date);
                $activities->where('created_at', '<=', $request->end_date);
            }

            $target = $targets->get();
            $activity = $activities->get();

            return $activity->count() . ' / ' . $target->sum('target');
        })->
        rawColumns([
            'opportunity_target',
            'activity_target'
        ])->
        make(true);
    }

    public function show(Request $request)
    {
        return response()->json(User::with(['companies'])->find($request->id));
    }

    public function save(Request $request)
    {
        $userService = new UserService;
        $userService->setUser($request->id ? User::find($request->id) : new User);
        $userService->save($request);
    }

    public function drop(Request $request)
    {
        User::find($request->id)->delete();
    }

    public function emailControl(Request $request)
    {
        return response()->json(is_null($request->except_id ? User::where('email', $request->email)->where('id', '<>', $request->except_id)->first() : User::where('email', $request->email)->first()) ? false : true);
    }
}
