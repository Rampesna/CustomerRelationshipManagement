<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Services\VideoService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class VideoController extends Controller
{
    public function index(Request $request)
    {
        return Video::all();
    }

    public function datatable(Request $request)
    {
        return Datatables::of(Video::with([]))->
        editColumn('id', function ($user) {
            return '#' . $user->id;
        })->
        make(true);
    }

    public function show(Request $request)
    {
        return response()->json(Video::find($request->id));
    }

    public function save(Request $request)
    {
        $videoService = new VideoService;
        $videoService->setVideo($request->id ? Video::find($request->id) : new Video);
        return response()->json($videoService->save(
            $request->name,
            $request->url
        ));
    }

    public function drop(Request $request)
    {
        Video::find($request->id)->delete();
    }
}
