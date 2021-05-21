<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Customer;
use App\Models\Manager;
use App\Models\Offer;
use App\Models\Sample;
use App\Models\Social;
use App\Services\CustomerService;
use App\Services\SocialService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SocialController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(Social::with([])->where('relation_type', $request->relation_type)->where('relation_id', $request->relation_id)->get());
    }

    public function datatable(Request $request)
    {
        return Datatables::of(Social::with([])->where('relation_type', $request->relation_type)->where('relation_id', $request->relation_id))->
        editColumn('id', function ($social) {
            return '#' . $social->id;
        })->
        make(true);
    }

    public function show(Request $request)
    {
        return response()->json(Social::find($request->id), 200);
    }

    public function save(Request $request)
    {
        $socialService = new SocialService;
        $socialService->setSocial($request->id ? Social::find($request->id) : new Social);
        $socialService->save($request);
    }
}
