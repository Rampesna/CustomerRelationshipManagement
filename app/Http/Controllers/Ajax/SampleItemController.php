<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Sample;
use App\Models\SampleItem;
use App\Services\CustomerService;
use App\Services\ManagerService;
use App\Services\SampleService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SampleItemController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(SampleItem::where('sample_id', $request->sample_id)->get());
    }

    public function datatable(Request $request)
    {
        setlocale(LC_ALL, 'tr_TR.UTF-8');
        setlocale(LC_TIME, 'Turkish');

        return Datatables::of(SampleItem::with([])->where('sample_id', $request->sample_id))->
        editColumn('id', function ($sample) {
            return '#' . $sample->id;
        })->
        editColumn('stock_id', function ($sample) {
            return $sample->stock_id ? @$sample->stock->name : '';
        })->
        editColumn('unit_id', function ($sample) {
            return $sample->unit_id ? @$sample->unit->name : '';
        })->
        make(true);
    }

    public function show(Request $request)
    {
        return response()->json(Sample::find($request->id), 200);
    }

    public function save(Request $request)
    {
        $sampleService = new SampleService;
        $sampleService->setSample($request->id ? Sample::find($request->id) : new Sample);
        $sampleService->save($request);
    }
}
