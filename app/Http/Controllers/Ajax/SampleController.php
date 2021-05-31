<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Definition;
use App\Models\Sample;
use App\Models\User;
use App\Services\SampleService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SampleController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(Sample::get());
    }

    public function datatable(Request $request)
    {
        return Datatables::of(Sample::with([])->where('company_id', $request->company_id))->
        filterColumn('relation_type', function ($samples, $data) {
            return $data == "All" ? $samples : $samples->where('relation_type', $data);
        })->
        filterColumn('company_id', function ($samples, $keyword) {
            return $samples->whereIn('company_id', Company::where('name', 'like', '%' . $keyword . '%')->pluck('id'));
        })->
        filterColumn('user_id', function ($samples, $keyword) {
            return $samples->whereIn('user_id', User::where('name', 'like', '%' . $keyword . '%')->pluck('id'));
        })->
        filterColumn('status_id', function ($samples, $keyword) use ($request) {
            return $samples->whereIn('status_id', Definition::where('company_id', $request->company_id)->where('name', 'Numune Aşama Durumları')->first()->definitions()->where('name', 'like', '%' . $keyword . '%')->pluck('id'));
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
        editColumn('date', function ($sample) {
            return $sample->date ? @date('d.m.Y', strtotime($sample->date)) : '';
        })->
        editColumn('cargo_company_id', function ($sample) {
            return $sample->cargo_company_id ? @$sample->cargoCompany->name : '';
        })->
        editColumn('status_id', function ($sample) {
            return $sample->status_id ? @$sample->status->name : '';
        })->
        editColumn('company_id', function ($sample) {
            return $sample->company_id ? @$sample->company->name : '';
        })->
        editColumn('user_id', function ($sample) {
            return $sample->user_id ? @$sample->user->name : '';
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

    public function drop(Request $request)
    {
        Sample::find($request->id)->delete();
    }
}
