<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Definition;
use App\Models\Offer;
use App\Models\Opportunity;
use App\Models\Sample;
use App\Models\User;
use App\Services\OpportunityService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class OpportunityController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(Opportunity::where('company_id', $request->company_id)->get());
    }

    public function datatable(Request $request)
    {
        return Datatables::of(Opportunity::with([])->where('company_id', $request->company_id))->
        filterColumn('customer_id', function ($opportunities, $keyword) {
            return $opportunities->whereIn('customer_id', Customer::where('title', 'like', '%' . $keyword . '%')->pluck('id'));
        })->
        filterColumn('company_id', function ($opportunities, $keyword) {
            return $opportunities->whereIn('company_id', Company::where('name', 'like', '%' . $keyword . '%')->pluck('id'));
        })->
        filterColumn('priority_id', function ($opportunities, $keyword) use ($request) {
            return $opportunities->whereIn('priority_id', Definition::where('company_id', $request->company_id)->where('name', 'Fırsat Öncelik Durumları')->first()->definitions()->where('name', 'like', '%' . $keyword . '%')->pluck('id'));
        })->
        filterColumn('user_id', function ($opportunities, $keyword) {
            return $opportunities->whereIn('user_id', User::where('name', 'like', '%' . $keyword . '%')->pluck('id'));
        })->
        editColumn('id', function ($opportunity) {
            return '#' . $opportunity->id;
        })->
        editColumn('customer_id', function ($opportunity) {
            return $opportunity->customer_id ? @$opportunity->customer->title : '';
        })->
        editColumn('company_id', function ($opportunity) {
            return $opportunity->company_id ? @$opportunity->company->name : '';
        })->
        editColumn('date', function ($opportunity) {
            return $opportunity->date ? date('d.m.Y', strtotime($opportunity->date)) : '';
        })->
        editColumn('priority_id', function ($opportunity) {
            return $opportunity->priority_id ? @$opportunity->priority->name : '';
        })->
        editColumn('user_id', function ($opportunity) {
            return $opportunity->user_id ? @$opportunity->user->name : '';
        })->
        rawColumns(['customer_id', 'status_id'])->
        make(true);
    }

    public function offersDatatable(Request $request)
    {
        return Datatables::of(Offer::with([])->where('relation_type', 'App\\Models\\Opportunity')->where('relation_id', $request->opportunity_id))->
        editColumn('id', function ($offer) {
            return '#' . $offer->id;
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
        editColumn('expiry_date', function ($offer) {
            return $offer->expiry_date ? @date('d.m.Y', strtotime($offer->expiry_date)) : '';
        })->
        editColumn('pay_type_id', function ($offer) {
            return $offer->pay_type_id ? @$offer->payType->name : '';
        })->
        editColumn('delivery_type_id', function ($offer) {
            return $offer->delivery_type_id ? @$offer->deliveryType->name : '';
        })->
        editColumn('status_id', function ($offer) {
            return $offer->status_id ? @$offer->status->name : '';
        })->
        editColumn('user_id', function ($offer) {
            return $offer->user_id ? @$offer->user->name : '';
        })->
        editColumn('company_id', function ($offer) {
            return $offer->company_id ? @$offer->company->name : '';
        })->
        make(true);
    }

    public function activitiesDatatable(Request $request)
    {
        return Datatables::of(Activity::with([])->where('relation_type', 'App\\Models\\Opportunity')->where('relation_id', $request->opportunity_id))->
        editColumn('id', function ($activity) {
            return '#' . $activity->id;
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

    public function samplesDatatable(Request $request)
    {
        return Datatables::of(Sample::with([])->where('relation_type', 'App\\Models\\Opportunity')->where('relation_id', $request->opportunity_id))->
        editColumn('id', function ($sample) {
            return '#' . $sample->id;
        })->
        editColumn('date', function ($sample) {
            return $sample->date ? @date('d.m.Y', strtotime($sample->date)) : '';
        })->
        editColumn('cargo_company_id', function ($sample) {
            return $sample->cargo_company_id ? @$sample->cargoCompany->name : '';
        })->
        editColumn('status_id', function ($sample) {
            return $sample->status_id ? @$sample->status->name : '';
        })->
        editColumn('company_id', function ($sample) {
            return $sample->company_id ? @$sample->company->name : '';
        })->
        editColumn('user_id', function ($sample) {
            return $sample->user_id ? @$sample->user->name : '';
        })->
        make(true);
    }

    public function show(Request $request)
    {
        return response()->json(Opportunity::find($request->id), 200);
    }

    public function showDetail(Request $request)
    {
        return response()->json(Opportunity::with([
            'company',
            'user',
            'priority',
            'accessType',
            'country',
            'province',
            'district',
            'estimatedResultType',
            'capacityType',
            'status',
            'createdBy',
            'lastUpdatedBy',
        ])->find($request->id), 200);
    }

    public function save(Request $request)
    {
        $opportunityService = new OpportunityService;
        $opportunityService->setOpportunity($request->id ? Opportunity::find($request->id) : new Opportunity);
        $opportunityService->save($request);
    }

    public function drop(Request $request)
    {
        $opportunity = Opportunity::find($request->id);
        if ($opportunity->created_by == $request->auth_user_id) {
            $opportunity->delete();
            return response()->json([
                'type' => 'success',
                'message' => 'Fırsat Başarıyla Silindi'
            ], 200);
        } else {
            if (User::find($request->auth_user_id)->authority(64)) {
                $opportunity->delete();
                return response()->json([
                    'type' => 'success',
                    'message' => 'Fırsat Başarıyla Silindi'
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
