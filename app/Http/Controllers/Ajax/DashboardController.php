<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Meeting;
use App\Models\Note;
use App\Models\Offer;
use App\Models\Opportunity;
use App\Models\Target;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        setlocale(LC_TIME, 'Turkish');

        return response()->json([
            'opportunity' => [
                'date' => strftime("%B %Y"),
                'created' => Opportunity::where('company_id', $request->company_id)->whereBetween('created_at', [
                    date('Y-m-01 00:00:00'),
                    date('Y-m-t 23:59:59')
                ])->count(),
                'target' => Target::where('company_id', $request->company_id)->where('year', date('Y'))->where('month', date('m'))->where('type', 'opportunity')->first()->target ?? 0
            ],
            'activity' => [
                'date' => strftime("%B %Y"),
                'created' => Activity::where('company_id', $request->company_id)->whereBetween('created_at', [
                    date('Y-m-01 00:00:00'),
                    date('Y-m-t 23:59:59')
                ])->count(),
                'target' => Target::where('company_id', $request->company_id)->where('year', date('Y'))->where('month', date('m'))->where('type', 'activity')->first()->target ?? 0,
                'lastActivities' => Activity::with([
                    'relation'
                ])->where('company_id', $request->company_id)->orderBy('updated_at', 'desc')->limit(10)->get()
            ]
        ]);
    }

    public function calendar(Request $request)
    {
        return response()->json([
            'notes' => Note::where('company_id', $request->company_id)->whereBetween('date', [
                date('Y-m-01 00:00:00', strtotime($request->start_date)),
                date('Y-m-t 23:59:59', strtotime($request->end_date)),
            ])->where(function ($notes) use ($request) {
                $notes->where('user_id', $request->auth_user_id)->orWhere('global', 1);
            })->get(),
            'meetings' => collect(Meeting::where('company_id', $request->company_id)->where('user_id', $request->auth_user_id)->where(function ($dates) use ($request) {
                $dates->where(function ($forStartDate) use ($request) {
                    $forStartDate->where('start_date', '<=', $request->start_date)->where('end_date', '>=', $request->start_date);
                })->
                orWhere(function ($forEndDate) use ($request) {
                    $forEndDate->where('start_date', '<=', $request->end_date)->where('end_date', '>=', $request->end_date);
                })->
                orWhere(function ($between) use ($request) {
                    $between->where('start_date', '>=', $request->start_date)->where('end_date', '<=', $request->end_date);
                });
            })->get())->merge(User::find($request->auth_user_id)->meetings()->where('company_id', $request->company_id)->get())->unique('id')->all(),
            'opportunities' => Opportunity::where('company_id', $request->company_id)->where('calendar', 1)->whereBetween('date', [
                date('Y-m-01 00:00:00', strtotime($request->start_date)),
                date('Y-m-t 23:59:59', strtotime($request->end_date))
            ])->get(),
            'activities' => Activity::where('company_id', $request->company_id)->where('calendar', 1)->where(function ($dates) use ($request) {
                $dates->where(function ($forStartDate) use ($request) {
                    $forStartDate->where('start_date', '<=', $request->start_date)->where('end_date', '>=', $request->start_date);
                })->
                orWhere(function ($forEndDate) use ($request) {
                    $forEndDate->where('start_date', '<=', $request->end_date)->where('end_date', '>=', $request->end_date);
                })->
                orWhere(function ($between) use ($request) {
                    $between->where('start_date', '>=', $request->start_date)->where('end_date', '<=', $request->end_date);
                });
            })->get(),
            'offers' => Offer::where('company_id', $request->company_id)->where('calendar', 1)->whereBetween('created_at', [
                date('Y-m-01 00:00:00', strtotime($request->start_date)),
                date('Y-m-t 23:59:59', strtotime($request->end_date))
            ])->get()
        ], 200);
    }

    public function setSelectedCompany(Request $request)
    {
        $user = User::find($request->auth_user_id);
        $user->last_selected_company = $request->id;
        $user->save();
    }
}
