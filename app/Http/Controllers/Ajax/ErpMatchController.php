<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Api\Crm;
use App\Http\Controllers\Controller;
use App\Models\ErpMatch;
use App\Services\ErpMatchService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ErpMatchController extends Controller
{
    private function searchArray($array, $key, $value)
    {
        foreach ($array ?? [] as $index => $data) {
            if ($data[$key] == $value) {
                return $index;
            }
        }
        return -1;
    }

    public function datatable(Request $request)
    {
        if ($request->relation_type == 'App\\Models\\Country') {
            $guids = (new Crm)->getUlkeListesi()['Response'];
        }

        if ($request->relation_type == 'App\\Models\\Province') {
            $guids = (new Crm)->getSehirListesi()['Response'];
        }

        if ($request->relation_type == 'App\\Models\\District') {
            $guids = (new Crm)->getIlceListesi()['Response'];
        }

        $model = ErpMatch::with([
            'relation'
        ]);

        $model = $model->where('relation_type', $request->relation_type);

        return Datatables::of($model)->
        editColumn('relation_id', function ($match) {
            return $match->relation ? $match->relation->name : '';
        })->
        editColumn('guid', function ($match) use ($guids) {
            $index = $this->searchArray($guids, 'iller_Guid', $match->guid);
            return $index != -1 ? $guids[$index]['iller_iladi'] : '';
        })->
        addColumn('r_id', function ($match) {
            return $match->relation_id;
        })->
        addColumn('r_guid', function ($match) {
            return $match->guid;
        })->
        make(true);
    }

    public function save(Request $request)
    {
        $erpMatchService = new ErpMatchService;

        $match = ErpMatch::where('relation_type', $request->relation_type)->where(function ($erpMatch) use ($request) {
            $erpMatch->where('relation_id', $request->relation_id)->orWhere('guid', $request->guid);
        })->first();

        if ($match) {
            return response()->json([
                'status' => 400,
                'message' => 'Bu Veri Zaten Eşleştirilmiş!',
                'response' => null
            ], 200);
        }

        $erpMatchService->setErpMatch(new ErpMatch);
        return response()->json([
            'status' => 200,
            'message' => 'Başarıyla Eşleştirildi!',
            'response' => $erpMatchService->save(
                $request->relation_type,
                $request->relation_id,
                $request->guid
            )
        ], 200);
    }

    public function drop(Request $request)
    {
        $erpMatch = ErpMatch::where('relation_type', $request->relation_type)->where('relation_id', $request->relation_id)->where('guid', $request->guid)->first();
        if (!$erpMatch) {
            return response()->json([
                'status' => 404,
                'message' => 'Eşleşme Bulunamadı'
            ]);
        }

        ErpMatch::where('relation_type', $request->relation_type)->where('relation_id', $request->relation_id)->where('guid', $request->guid)->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Eşleşme Başarıyla Silindi!'
        ]);
    }
}
