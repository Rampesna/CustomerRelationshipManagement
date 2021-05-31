<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Definition;
use App\Models\Stock;
use App\Services\StockService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class StockController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(Stock::where('company_id', $request->company_id)->get());
    }

    public function datatable(Request $request)
    {
        return Datatables::of(Stock::with([])->where('company_id', $request->company_id))->
        filterColumn('unit_type_id', function ($stocks, $keyword) use ($request) {
            return $stocks->whereIn('unit_type_id', Definition::where('company_id', $request->company_id)->where('name', 'Birim Türleri')->first()->definitions()->where('name', 'like', '%' . $keyword . '%')->pluck('id'));
        })->
        filterColumn('type_id', function ($stocks, $keyword) use ($request) {
            return $stocks->whereIn('type_id', Definition::where('company_id', $request->company_id)->where('name', 'Stok Türleri')->first()->definitions()->where('name', 'like', '%' . $keyword . '%')->pluck('id'));
        })->
        filterColumn('status_id', function ($stocks, $keyword) use ($request) {
            return $stocks->whereIn('status_id', Definition::where('company_id', $request->company_id)->where('name', 'Stok Durumları')->first()->definitions()->where('name', 'like', '%' . $keyword . '%')->pluck('id'));
        })->
        editColumn('id', function ($stock) {
            return '#' . $stock->id;
        })->
        editColumn('company_id', function ($stock) {
            return $stock->company_id ? @$stock->company->name : '';
        })->
        editColumn('unit_price', function ($stock) {
            return $stock->currency_type ? @$stock->unit_price . ' ' . @$stock->currency_type : @$stock->unit_price;
        })->
        editColumn('type_id', function ($stock) {
            return $stock->type_id ? @$stock->type->name : '';
        })->
        editColumn('status_id', function ($stock) {
            return $stock->status_id ? @$stock->status->name : '';
        })->
        editColumn('unit_type_id', function ($stock) {
            return $stock->unit_type_id ? @$stock->unitType->name : '';
        })->
        make(true);
    }

    public function show(Request $request)
    {
        return response()->json(Stock::find($request->id), 200);
    }

    public function save(Request $request)
    {
        $stockService = new StockService;
        $stockService->setStock($request->id ? Stock::find($request->id) : new Stock);
        $stockService->save($request);
    }

    public function drop(Request $request)
    {
        Stock::find($request->id)->delete();
    }
}
