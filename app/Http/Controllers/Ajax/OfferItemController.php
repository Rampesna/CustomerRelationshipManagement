<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\OfferItem;
use App\Models\Sample;
use App\Services\OfferItemService;
use App\Services\SampleService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class OfferItemController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(OfferItem::with([
            'stock',
            'unit'
        ])->where('offer_id', $request->offer_id)->get());
    }

    public function datatable(Request $request)
    {
        setlocale(LC_ALL, 'tr_TR.UTF-8');
        setlocale(LC_TIME, 'Turkish');

        return Datatables::of(OfferItem::with([])->where('offer_id', $request->offer_id))->
        editColumn('id', function ($offerItem) {
            return '#' . $offerItem->id;
        })->
        editColumn('stock_id', function ($offerItem) {
            return $offerItem->stock_id ? @$offerItem->stock->name : '';
        })->
        editColumn('unit_id', function ($offerItem) {
            return $offerItem->unit_id ? @$offerItem->unit->name : '';
        })->
        make(true);
    }

    public function show(Request $request)
    {
        return response()->json(OfferItem::find($request->id), 200);
    }

    public function save(Request $request)
    {
        $offerItemService = new OfferItemService;
        $offerItemService->setOfferItem($request->id ? OfferItem::find($request->id) : new OfferItem);
        $offerItemService->save($request);
    }

    public function drop(Request $request)
    {
        OfferItem::find($request->id)->delete();
    }
}
