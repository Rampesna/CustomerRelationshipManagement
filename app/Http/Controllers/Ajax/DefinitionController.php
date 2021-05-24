<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Definition;
use App\Services\DefinitionService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DefinitionController extends Controller
{
    public function datatable(Request $request)
    {
        return Datatables::of(Definition::where('company_id', $request->company_id)->where('definition_id', null))->make(true);
    }

    public function subDefinitions(Request $request)
    {
        return Datatables::of(Definition::where('definition_id', $request->definition_id))->make(true);
    }

    public function save(Request $request)
    {
        $definitionService = new DefinitionService;
        $definitionService->setDefinition(new Definition);
        $definitionService->save($request);
    }

    public function drop(Request $request)
    {
        return Definition::find($request->id)->delete();
    }

    public function opportunityPriorities(Request $request)
    {
        return response()->json(Definition::where('company_id', $request->company_id)->where('name', 'Fırsat Öncelik Durumları')->first()->definitions ?? []);
    }

    public function opportunityAccessTypes(Request $request)
    {
        return response()->json(Definition::where('company_id', $request->company_id)->where('name', 'Fırsat Erişim Türleri')->first()->definitions ?? []);
    }

    public function opportunityEstimatedResultTypes(Request $request)
    {
        return response()->json(Definition::where('company_id', $request->company_id)->where('name', 'Fırsat Tahmini Sonuçlanma Türleri')->first()->definitions ?? []);
    }

    public function opportunityCapacityTypes(Request $request)
    {
        return response()->json(Definition::where('company_id', $request->company_id)->where('name', 'Fırsat Kapasite Türleri')->first()->definitions ?? []);
    }

    public function opportunityStatuses(Request $request)
    {
        return response()->json(Definition::where('company_id', $request->company_id)->where('name', 'Fırsat Durumları')->first()->definitions ?? []);
    }

    public function activityMeetingReasons(Request $request)
    {
        return response()->json(Definition::where('company_id', $request->company_id)->where('name', 'Aktivite Görüşme Nedenleri')->first()->definitions ?? []);
    }

    public function activityPriorities(Request $request)
    {
        return response()->json(Definition::where('company_id', $request->company_id)->where('name', 'Aktivite Öncelik Durumları')->first()->definitions ?? []);
    }

    public function customerClasses(Request $request)
    {
        return response()->json(Definition::where('company_id', $request->company_id)->where('name', 'Müşteri Sınıfları')->first()->definitions ?? []);
    }

    public function customerTypes(Request $request)
    {
        return response()->json(Definition::where('company_id', $request->company_id)->where('name', 'Müşteri Türleri')->first()->definitions ?? []);
    }

    public function customerReferences(Request $request)
    {
        return response()->json(Definition::where('company_id', $request->company_id)->where('name', 'Müşteri Referansları')->first()->definitions ?? []);
    }

    public function managerDepartments(Request $request)
    {
        return response()->json(Definition::where('company_id', $request->company_id)->where('name', 'Yetkili Departmanları')->first()->definitions ?? []);
    }

    public function managerTitles(Request $request)
    {
        return response()->json(Definition::where('company_id', $request->company_id)->where('name', 'Yetkili Ünvanları')->first()->definitions ?? []);
    }

    public function cargoCompanies(Request $request)
    {
        return response()->json(Definition::where('company_id', $request->company_id)->where('name', 'Kargo Firmaları')->first()->definitions ?? []);
    }

    public function sampleStatuses(Request $request)
    {
        return response()->json(Definition::where('company_id', $request->company_id)->where('name', 'Numune Aşama Durumları')->first()->definitions ?? []);
    }

    public function offerPayTypes(Request $request)
    {
        return response()->json(Definition::where('company_id', $request->company_id)->where('name', 'Teklif Ödeme Türleri')->first()->definitions ?? []);
    }

    public function offerDeliveryTypes(Request $request)
    {
        return response()->json(Definition::where('company_id', $request->company_id)->where('name', 'Teklif Teslim Türleri')->first()->definitions ?? []);
    }

    public function offerStatuses(Request $request)
    {
        return response()->json(Definition::where('company_id', $request->company_id)->where('name', 'Teklif Durumları')->first()->definitions ?? []);
    }

    public function unitTypes(Request $request)
    {
        return response()->json(Definition::where('company_id', $request->company_id)->where('name', 'Birim Türleri')->first()->definitions ?? []);
    }

    public function stockTypes(Request $request)
    {
        return response()->json(Definition::where('company_id', $request->company_id)->where('name', 'Stok Türleri')->first()->definitions ?? []);
    }

    public function stockStatuses(Request $request)
    {
        return response()->json(Definition::where('company_id', $request->company_id)->where('name', 'Stok Durumları')->first()->definitions ?? []);
    }

    public function priceListStatuses(Request $request)
    {
        return response()->json(Definition::where('company_id', $request->company_id)->where('name', 'Fiyat Listesi Durumları')->first()->definitions ?? []);
    }
}
