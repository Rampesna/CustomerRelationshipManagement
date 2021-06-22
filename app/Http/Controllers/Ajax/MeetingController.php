<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Meeting;
use App\Services\MeetingService;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    public function show(Request $request)
    {
        return response()->json(Meeting::with([
            'users'
        ])->find($request->id), 200);
    }

    public function save(Request $request)
    {
        $meetingService = new MeetingService;
        $meetingService->setMeeting($request->id ? Meeting::find($request->id) : new Meeting);
        $meetingService->save($request);
    }

    public function drop(Request $request)
    {

    }
}
