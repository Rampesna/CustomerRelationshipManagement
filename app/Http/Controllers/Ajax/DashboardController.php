<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Definition;
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
        return response()->json([
            'opportunity' => [
                'date' => date('d.m.Y', strtotime($request->start_date)) . ' - ' . date('d.m.Y', strtotime($request->end_date)),
                'created' => Opportunity::where('company_id', $request->company_id)->whereBetween('created_at', [
                    $request->start_date,
                    $request->end_date
                ])->count(),
                'target' => Target::where('start_date', '>=', $request->start_date)->where('end_date', '<=', date('Y-m-d', strtotime('+1 days', strtotime($request->end_date))))->where('type', 'opportunity')->sum('target') ?? 0
            ],
            'activity' => [
                'date' => date('d.m.Y', strtotime($request->start_date)) . ' - ' . date('d.m.Y', strtotime($request->end_date)),
                'created' => Activity::where('company_id', $request->company_id)->whereBetween('created_at', [
                    $request->start_date,
                    $request->end_date
                ])->count(),
                'target' => Target::where('start_date', '>=', $request->start_date)->where('end_date', '<=', date('Y-m-d', strtotime('+1 days', strtotime($request->end_date))))->where('type', 'activity')->sum('target') ?? 0,
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

    public function report(Request $request)
    {
        return response()->json([
            'opportunityStatuses' => collect(
                !empty($request->opportunity_statuses) && count($request->opportunity_statuses) > 0 ?
                    Definition::where('company_id', $request->company_id)->where('name', 'Fırsat Durumları')->first()->definitions()->whereIn('id', $request->opportunity_statuses)->get() :
                    Definition::where('company_id', $request->company_id)->where('name', 'Fırsat Durumları')->first()->definitions
            )->map(function ($opportunityStatus) use ($request) {
                $opportunityStatus->opportunities = Opportunity::where('status_id', $opportunityStatus->id)->whereBetween('created_at', [
                    $request->start_date . ' 00:00:00',
                    $request->end_date . ' 23:59:59'
                ])->get();
                return $opportunityStatus;
            }),
            'activityMeetingReasons' => collect(
                !empty($request->activity_meeting_reasons) && count($request->activity_meeting_reasons) > 0 ?
                    Definition::where('company_id', $request->company_id)->where('name', 'Aktivite Görüşme Nedenleri')->first()->definitions()->whereIn('id', $request->activity_meeting_reasons)->get() :
                    Definition::where('company_id', $request->company_id)->where('name', 'Aktivite Görüşme Nedenleri')->first()->definitions
            )->map(function ($activityMeetingReason) use ($request) {
                $activityMeetingReason->activities = Activity::where('meet_reason_id', $activityMeetingReason->id)->whereBetween('created_at', [
                    $request->start_date . ' 00:00:00',
                    $request->end_date . ' 23:59:59'
                ])->get();
                return $activityMeetingReason;
            }),
            'dates' => collect(
                new \DatePeriod(new \DateTime($request->start_date), new \DateInterval('P1D'), (new \DateTime($request->end_date))->modify('+1 day'))
            )->map(function ($date) use ($request) {
                return [
                    'date' => $date->format('Y-m-d'),
                    'opportunities_count' => Opportunity::where('company_id', $request->company_id)->whereBetween('created_at', [
                        $date->format('Y-m-d') . ' 00:00:00',
                        $date->format('Y-m-d') . ' 23:59:59'
                    ])->count(),
                    'activities_count' => Activity::where('company_id', $request->company_id)->whereBetween('created_at', [
                        $date->format('Y-m-d') . ' 00:00:00',
                        $date->format('Y-m-d') . ' 23:59:59'
                    ])->count()
                ];
            })
        ]);
    }

    public function setSelectedCompany(Request $request)
    {
        $user = User::find($request->auth_user_id);
        $user->last_selected_company = $request->id;
        $user->save();
    }
}
