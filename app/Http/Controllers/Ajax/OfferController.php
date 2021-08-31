<?php

namespace App\Http\Controllers\Ajax;

use App\Helper\General;
use App\Http\Controllers\Controller;
use App\Mail\OfferMail;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Definition;
use App\Models\Offer;
use App\Models\Opportunity;
use App\Models\Setting;
use App\Models\User;
use App\Services\OfferService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\DataTables;
use Barryvdh\DomPDF\Facade as PDF;

class OfferController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(Offer::get());
    }

    public function datatable(Request $request)
    {
        return Datatables::of(Offer::with([])->where('company_id', $request->company_id))->
        filterColumn('relation_type', function ($offers, $data) {
            return $data == "All" ? $offers : $offers->where('relation_type', $data);
        })->
        filterColumn('company_id', function ($offers, $keyword) {
            return $offers->whereIn('company_id', Company::where('name', 'like', '%' . $keyword . '%')->pluck('id'));
        })->
        filterColumn('user_id', function ($offers, $keyword) {
            return $offers->whereIn('user_id', User::where('name', 'like', '%' . $keyword . '%')->pluck('id'));
        })->
        filterColumn('status_id', function ($managers, $keyword) use ($request) {
            return $managers->whereIn('status_id', Definition::where('company_id', $request->company_id)->where('name', 'Teklif Durumları')->first()->definitions()->where('name', 'like', '%' . $keyword . '%')->pluck('id'));
        })->
        editColumn('id', function ($offer) {
            return '#' . $offer->id;
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
        editColumn('expiry_date', function ($offer) {
            return $offer->expiry_date ? @date('d.m.Y', strtotime($offer->expiry_date)) : '';
        })->
        editColumn('pay_type_id', function ($offer) {
            return $offer->pay_type_id ? @$offer->payType->name : '';
        })->
        editColumn('delivery_type_id', function ($offer) {
            return $offer->delivery_type_id ? @$offer->deliveryType->name : '';
        })->
        editColumn('status_id', function ($offer) {
            return $offer->status_id ? @$offer->status->name : '';
        })->
        editColumn('user_id', function ($offer) {
            return $offer->user_id ? @$offer->user->name : '';
        })->
        editColumn('company_id', function ($offer) {
            return $offer->company_id ? @$offer->company->name : '';
        })->
        make(true);
    }

    public function reportDatatable(Request $request)
    {
        $offers = Offer::with([])->where('company_id', $request->company_id);

        if ($request->start_date) {
            $offers->where('created_at', '>=', $request->start_date);
        }

        if ($request->end_date) {
            $offers->where('created_at', '<=', $request->end_date);
        }

        if ($request->subject) {
            $offers->where('subject', 'like', '%' . $request->subject . '%');
        }

        if ($request->pay_types && count($request->pay_types) > 0) {
            $offers->whereIn('pay_type_id', $request->pay_types);
        }

        if ($request->delivery_types && count($request->delivery_types) > 0) {
            $offers->whereIn('delivery_type_id', $request->delivery_types);
        }

        if ($request->statuses && count($request->statuses) > 0) {
            $offers->whereIn('status_id', $request->statuses);
        }

        return Datatables::of($offers)->
        filterColumn('relation_type', function ($offers, $data) {
            return $data == "All" ? $offers : $offers->where('relation_type', $data);
        })->
        filterColumn('company_id', function ($offers, $keyword) {
            return $offers->whereIn('company_id', Company::where('name', 'like', '%' . $keyword . '%')->pluck('id'));
        })->
        filterColumn('user_id', function ($offers, $keyword) {
            return $offers->whereIn('user_id', User::where('name', 'like', '%' . $keyword . '%')->pluck('id'));
        })->
        filterColumn('status_id', function ($managers, $keyword) use ($request) {
            return $managers->whereIn('status_id', Definition::where('company_id', $request->company_id)->where('name', 'Teklif Durumları')->first()->definitions()->where('name', 'like', '%' . $keyword . '%')->pluck('id'));
        })->
        editColumn('id', function ($offer) {
            return '#' . $offer->id;
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
        editColumn('expiry_date', function ($offer) {
            return $offer->expiry_date ? @date('d.m.Y', strtotime($offer->expiry_date)) : '';
        })->
        editColumn('pay_type_id', function ($offer) {
            return $offer->pay_type_id ? @$offer->payType->name : '';
        })->
        editColumn('delivery_type_id', function ($offer) {
            return $offer->delivery_type_id ? @$offer->deliveryType->name : '';
        })->
        editColumn('status_id', function ($offer) {
            return $offer->status_id ? @$offer->status->name : '';
        })->
        editColumn('user_id', function ($offer) {
            return $offer->user_id ? @$offer->user->name : '';
        })->
        editColumn('company_id', function ($offer) {
            return $offer->company_id ? @$offer->company->name : '';
        })->
        make(true);
    }

    public function show(Request $request)
    {
        return response()->json(Offer::with([
            'relation',
            'payType',
            'deliveryType',
            'status',
        ])->find($request->id), 200);
    }

    public function save(Request $request)
    {
        $offerService = new OfferService;
        $offerService->setOffer($request->id ? Offer::find($request->id) : new Offer);
        $offerService->save($request);
    }

    public function drop(Request $request)
    {
        $offer = Offer::find($request->id);
        if ($offer->created_by == $request->auth_user_id) {
            $offer->delete();
            return response()->json([
                'type' => 'success',
                'message' => 'Teklif Başarıyla Silindi'
            ], 200);
        } else {
            if (User::find($request->auth_user_id)->authority(64)) {
                $offer->delete();
                return response()->json([
                    'type' => 'success',
                    'message' => 'Teklif Başarıyla Silindi'
                ], 200);
            } else {
                return response()->json([
                    'type' => 'warning',
                    'message' => 'Başka Kullanıcıya Ait Verileri Silme Yetkiniz Bulunmuyor!'
                ], 200);
            }
        }
    }

    public function downloadPDF(Request $request)
    {
        $offerService = new OfferService;
        $offerService->setOffer(Offer::with([
            'relation',
            'items'
        ])->find($request->id));
        $offerService->createPdfFile();
        return response()->download(public_path('offers/' . $offerService->getOffer()->id . '.pdf'), $offerService->getOffer()->subject . '.pdf');
    }

    public function sendEmail(Request $request)
    {
        $offerService = new OfferService;
        $offerService->setOffer(Offer::with([
            'relation',
            'items'
        ])->find($request->id));
        $offerService->createPdfFile();

        General::setMailConfig($offerService->getOffer()->company_id);
        Mail::to($request->email)->send(new OfferMail([
            'subject' => 'Teklif Detayları',
            'offer' => $offerService->getOffer()
        ]));
    }

    public function getCurrency(Request $request)
    {
        return General::getCurrency($request->currency_code);
    }
}
