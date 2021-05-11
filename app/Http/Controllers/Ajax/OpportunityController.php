<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Definition;
use App\Models\Opportunity;
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
        setlocale(LC_ALL, 'tr_TR.UTF-8');
        setlocale(LC_TIME, 'Turkish');

        return Datatables::of(Opportunity::with([])->where('company_id', $request->company_id))->
        filterColumn('customer_id', function ($opportunities, $keyword) {
            return $opportunities->whereIn('customer_id', Customer::where('title', 'like', '%' . $keyword . '%')->pluck('id'));
        })->
        filterColumn('company_id', function ($opportunities, $keyword) {
            return $opportunities->whereIn('company_id', Company::where('name', 'like', '%' . $keyword . '%')->pluck('id'));
        })->
        filterColumn('user_id', function ($opportunities, $keyword) {
            return $opportunities->whereIn('user_id', User::where('name', 'like', '%' . $keyword . '%')->pluck('id'));
        })->
        editColumn('id', function ($reservation) {
            return '#' . $reservation->id;
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

    public function show(Request $request)
    {
        return response()->json(Opportunity::find($request->id), 200);
    }

    public function save(Request $request)
    {
        $opportunityService = new OpportunityService;
        $opportunityService->setOpportunity($request->id ? Opportunity::find($request->id) : new Opportunity);
        $opportunityService->save($request);
    }
}
