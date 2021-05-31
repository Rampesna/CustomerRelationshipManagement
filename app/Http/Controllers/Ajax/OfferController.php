<?php

namespace App\Http\Controllers\Ajax;

use App\Helper\General;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Definition;
use App\Models\Offer;
use App\Models\Opportunity;
use App\Models\User;
use App\Services\OfferService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Barryvdh\DomPDF\Facade as PDF;

class OfferController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(Offer::get());
    }

    public function datatable(Request $request)
    {
        return Datatables::of(Offer::with([])->where('company_id', $request->company_id))->
        filterColumn('relation_type', function ($offers, $data) {
            return $data == "All" ? $offers : $offers->where('relation_type', $data);
        })->
        filterColumn('company_id', function ($offers, $keyword) {
            return $offers->whereIn('company_id', Company::where('name', 'like', '%' . $keyword . '%')->pluck('id'));
        })->
        filterColumn('user_id', function ($offers, $keyword) {
            return $offers->whereIn('user_id', User::where('name', 'like', '%' . $keyword . '%')->pluck('id'));
        })->
        filterColumn('status_id', function ($managers, $keyword) use ($request) {
            return $managers->whereIn('status_id', Definition::where('company_id', $request->company_id)->where('name', 'Teklif Durumları')->first()->definitions()->where('name', 'like', '%' . $keyword . '%')->pluck('id'));
        })->
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

    public function show(Request $request)
    {
        return response()->json(Offer::find($request->id), 200);
    }

    public function save(Request $request)
    {
        $offerService = new OfferService;
        $offerService->setOffer($request->id ? Offer::find($request->id) : new Offer);
        $offerService->save($request);
    }

    public function drop(Request $request)
    {
        Offer::find($request->id)->delete();
    }

    public function downloadPDF(Request $request)
    {
        $offer = Offer::find($request->id);

        $data = [
            'opportunity' => $offer->relation_type == 'App\\Models\\Opportunity' ? Opportunity::find($offer->relation_id) : null,
            'customer' => $offer->relation_type == 'App\\Models\\Customer' ? Customer::find($offer->relation_id) : null,
            'offer' => $offer,
            'items' => $offer->items
        ];

        $pdf = PDF::loadView('emails.offer', $data, [], 'UTF-8');
        $pdf->save(public_path('offers/' . $offer->id . '.pdf'), 'UTF-8');
        return response()->download(public_path('offers/' . $offer->id . '.pdf'));
    }

    public function getCurrency(Request $request)
    {
        return General::getCurrency($request->currency_code);
    }
}
