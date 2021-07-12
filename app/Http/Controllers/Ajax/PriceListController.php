<?php

namespace App\Http\Controllers\Ajax;

use App\Helper\General;
use App\Http\Controllers\Controller;
use App\Mail\PriceListMail;
use App\Models\Company;
use App\Models\Definition;
use App\Models\PriceList;
use App\Models\User;
use App\Services\PriceListService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\DataTables;

class PriceListController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(PriceList::get());
    }

    public function datatable(Request $request)
    {
        return Datatables::of(PriceList::with([])->where('company_id', $request->company_id))->
        filterColumn('start_date', function ($priceLists, $date) {
            return $priceLists->where('start_date', '>=', $date);
        })->
        filterColumn('end_date', function ($priceLists, $date) {
            return $priceLists->where('end_date', '<=', $date);
        })->
        filterColumn('company_id', function ($priceLists, $keyword) {
            return $priceLists->whereIn('company_id', Company::where('name', 'like', '%' . $keyword . '%')->pluck('id'));
        })->
        filterColumn('status_id', function ($stocks, $keyword) use ($request) {
            return $stocks->whereIn('status_id', Definition::where('company_id', $request->company_id)->where('name', 'Fiyat Listesi Durumları')->first()->definitions()->where('name', 'like', '%' . $keyword . '%')->pluck('id'));
        })->
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

    public function drop(Request $request)
    {
        $priceList = PriceList::find($request->id);
        if ($priceList->created_by == $request->auth_user_id) {
            $priceList->delete();
            return response()->json([
                'type' => 'success',
                'message' => 'Fiyat Listesi Başarıyla Silindi'
            ], 200);
        } else {
            if (User::find($request->auth_user_id)->authority(64)) {
                $priceList->delete();
                return response()->json([
                    'type' => 'success',
                    'message' => 'Fiyat Listesi Başarıyla Silindi'
                ], 200);
            } else {
                return response()->json([
                    'type' => 'warning',
                    'message' => 'Başka Kullanıcıya Ait Verileri Silme Yetkiniz Bulunmuyor!'
                ], 200);
            }
        }
    }

    public function copy(Request $request)
    {
        $priceListService = new PriceListService;
        $priceListService->setPriceList(new PriceList);
        $priceListService->copy($request);
    }

    public function downloadPDF(Request $request)
    {
        $priceListService = new PriceListService;
        $priceListService->setPriceList(PriceList::with([
            'items'
        ])->find($request->id));
        $priceListService->createPdfFile();
        return response()->download(public_path('priceLists/' . $priceListService->getPriceList()->id . '.pdf'), '#' . $priceListService->getPriceList()->id . ' Numaralı Fiyat Listesi.pdf');
    }

    public function sendEmail(Request $request)
    {
        try {
            $priceListService = new PriceListService;
            $priceListService->setPriceList(PriceList::with([
                'items'
            ])->find($request->id));
            $priceListService->createPdfFile();

            General::setMailConfig($priceListService->getPriceList()->company_id);
            Mail::to($request->email)->send(new PriceListMail([
                'subject' => 'Fiyat Listesi',
                'priceList' => $priceListService->getPriceList()
            ]));

            return response()->json([
                'status' => 'OK'
            ]);
        } catch (\Exception $exception) {
            return $exception;
        }
    }
}
