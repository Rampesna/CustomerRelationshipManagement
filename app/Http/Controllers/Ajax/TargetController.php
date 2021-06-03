<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Target;
use App\Services\TargetService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TargetController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(Target::where('company_id', $request->company_id)->get());
    }

    public function datatable(Request $request)
    {
        setlocale(LC_TIME, "turkish");
        setlocale(LC_ALL, 'turkish');

        return Datatables::of(Target::with([])->where('company_id', $request->company_id))->
        filterColumn('type', function ($targets, $type) {
            return $type == 'all' ? $targets : $targets->where('type', $type);
        })->
        filterColumn('date', function ($targets, $date) {
            return $targets->where('year', date('Y', strtotime($date)))->where('month', date('m', strtotime($date)));
        })->
        editColumn('id', function ($target) {
            return '#' . $target->id;
        })->
        editColumn('company_id', function ($target) {
            return $target->company_id ? $target->company->name : '';
        })->
        editColumn('type', function ($target) {
            return $target->type == 'opportunity' ? 'Fırsat' : '';
        })->
        editColumn('date', function ($target) {
            iconv('latin5', 'utf-8', strftime('%B %Y', strtotime($target->year . '-' . $target->month)));
            return iconv('latin5', 'utf-8', strftime('%B %Y', strtotime($target->year . '-' . $target->month)));
        })->
        make(true);
    }

    public function show(Request $request)
    {
        return response()->json(Target::find($request->id), 200);
    }

    public function save(Request $request)
    {
        $targetControl = Target::where('type', $request->type)->
        where('company_id', $request->company_id)->
        where('year', date('Y', strtotime($request->date)))->
        where('month', date('m', strtotime($request->date)));

        $targetControl = $request->id ? $targetControl->where('id', '<>', $request->id) : $targetControl;

        if ($targetControl->first()) {
            return response()->json([
                'type' => 'error',
                'message' => 'Hedef Zaten Mevcut! Düzenlemeyi Deneyin.'
            ], 200);
        } else {
            $targetService = new TargetService;
            $targetService->setTarget($request->id ? Target::find($request->id) : new Target);
            $targetService->save($request);

            return response()->json([
                'type' => 'success',
                'message' => 'Başarıyla Kaydedildi'
            ], 200);
        }
    }

    public function drop(Request $request)
    {
        Target::find($request->id)->delete();
    }
}
