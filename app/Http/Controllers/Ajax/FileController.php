<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Customer;
use App\Models\File;
use App\Models\Manager;
use App\Models\Offer;
use App\Models\Sample;
use App\Services\CustomerService;
use App\Services\FileService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class FileController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(File::where('relation_type', $request->relation_type)->where('relation_id', $request->relation_id)->get());
    }

    public function show(Request $request)
    {
        return response()->json(File::find($request->id), 200);
    }

    public function save(Request $request)
    {
        $fileService = new FileService();
        $fileService->setFile($request->id ? File::find($request->id) : new File);
        return response()->json($fileService->save($request), 200);
    }

    public function drop(Request $request)
    {
        File::find($request->id)->delete();
    }
}
