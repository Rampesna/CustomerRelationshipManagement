<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\PriceList;
use App\Services\OfferService;
use App\Services\PriceListService;
use App\Services\SampleService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PriceListController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(PriceList::get());
    }

    public function datatable(Request $request)
    {
        setlocale(LC_ALL, 'tr_TR.UTF-8');
        setlocale(LC_TIME, 'Turkish');

        return Datatables::of(PriceList::with([])->where('company_id', $request->company_id))->
        editColumn('id', function ($priceList) {
            return '#' . $priceList->id;
        })->
        editColumn('start_date', function ($priceList) {
            return $priceList->start_date ? @date('d.m.Y', strtotime($priceList->start_date)) : '';
        })->
        editColumn('end_date', function ($priceList) {
            return $priceList->end_date ? @date('d.m.Y', strtotime($priceList->end_date)) : '';
        })->
        editColumn('status_id', function ($priceList) {
            return $priceList->status_id ? @$priceList->status->name : '';
        })->
        editColumn('user_id', function ($priceList) {
            return $priceList->user_id ? @$priceList->user->name : '';
        })->
        editColumn('company_id', function ($priceList) {
            return $priceList->company_id ? @$priceList->company->name : '';
        })->
        make(true);
    }

    public function show(Request $request)
    {
        return response()->json(PriceList::find($request->id), 200);
    }

    public function save(Request $request)
    {
        $priceListService = new PriceListService;
        $priceListService->setPriceList($request->id ? PriceList::find($request->id) : new PriceList);
        $priceListService->save($request);
    }
}
