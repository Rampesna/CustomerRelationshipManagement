<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\PriceListItem;
use App\Services\PriceListItemService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PriceListItemController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(PriceListItem::where('price_list_id', $request->price_list_id)->get());
    }

    public function datatable(Request $request)
    {
        setlocale(LC_ALL, 'tr_TR.UTF-8');
        setlocale(LC_TIME, 'Turkish');

        return Datatables::of(PriceListItem::with([])->where('price_list_id', $request->price_list_id))->
        editColumn('id', function ($priceList) {
            return '#' . $priceList->id;
        })->
        editColumn('stock_id', function ($priceList) {
            return $priceList->stock_id ? @$priceList->stock->name : '';
        })->
        editColumn('unit_id', function ($priceList) {
            return $priceList->unit_id ? @$priceList->unit->name : '';
        })->
        make(true);
    }

    public function show(Request $request)
    {
        return response()->json(PriceListItem::find($request->id), 200);
    }

    public function save(Request $request)
    {
        $priceListService = new PriceListItemService;
        $priceListService->setPriceListItem($request->id ? PriceListItem::find($request->id) : new PriceListItem);
        $priceListService->save($request);
    }

    public function drop(Request $request)
    {
        PriceListItem::find($request->id)->delete();
    }
}
