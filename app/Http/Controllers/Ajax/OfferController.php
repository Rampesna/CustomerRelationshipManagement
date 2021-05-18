<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Services\OfferService;
use App\Services\SampleService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class OfferController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(Offer::get());
    }

    public function datatable(Request $request)
    {
        setlocale(LC_ALL, 'tr_TR.UTF-8');
        setlocale(LC_TIME, 'Turkish');

        return Datatables::of(Offer::with([])->where('company_id', $request->company_id))->
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
}
