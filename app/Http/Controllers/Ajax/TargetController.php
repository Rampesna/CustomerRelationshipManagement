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
        $targets = Target::with([]);

        if ($request->start_date) {
            $targets->where('start_date', '>=', $request->start_date);
        }

        if ($request->start_date) {
            $targets->where('end_date', '<=', date('Y-m-d', strtotime('+1 days', strtotime($request->end_date))));
        }

        return response()->json($targets->get());
    }

    public function datatable(Request $request)
    {
        setlocale(LC_TIME, "turkish");
        setlocale(LC_ALL, 'turkish');

        return Datatables::of(Target::with([]))->
        filterColumn('type', function ($targets, $type) {
            return $type == 'all' ? $targets : $targets->where('type', $type);
        })->
        filterColumn('start_date', function ($targets, $date) {
            return $targets->where('start_date', '>=', $date);
        })->
        filterColumn('end_date', function ($targets, $date) {
            return $targets->where('end_date', '<=', date('Y-m-d', strtotime('+1 days', strtotime($date))));
        })->
        editColumn('id', function ($target) {
            return '#' . $target->id;
        })->
        editColumn('user_id', function ($target) {
            return $target->user ? $target->user->name : '';
        })->
        editColumn('type', function ($target) {
            return $target->type == 'opportunity' ? 'Fırsat' : ($target->type == 'activity' ? 'Aktivite' : '');
        })->
        editColumn('start_date', function ($target) {
            iconv('latin5', 'utf-8', strftime('%d %B %Y', strtotime($target->start_date)));
            return iconv('latin5', 'utf-8', strftime('%d %B %Y', strtotime($target->start_date)));
        })->
        editColumn('end_date', function ($target) {
            iconv('latin5', 'utf-8', strftime('%d %B %Y', strtotime($target->end_date)));
            return iconv('latin5', 'utf-8', strftime('%d %B %Y', strtotime($target->end_date)));
        })->
        make(true);
    }

    public function show(Request $request)
    {
        return response()->json(Target::find($request->id), 200);
    }

    public function save(Request $request)
    {
        $targetService = new TargetService;
        $targetService->setTarget($request->id ? Target::find($request->id) : new Target);
        $targetService->save($request);

        return response()->json([
            'type' => 'success',
            'message' => 'Başarıyla Kaydedildi'
        ], 200);
    }

    public function drop(Request $request)
    {
        Target::find($request->id)->delete();
    }
}
