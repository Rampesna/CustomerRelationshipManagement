<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Company;
use App\Models\Definition;
use App\Models\Note;
use App\Models\User;
use App\Services\ActivityService;
use App\Services\NoteService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class NoteController extends Controller
{
    public function show(Request $request)
    {
        return response()->json(Note::find($request->id), 200);
    }

    public function save(Request $request)
    {
        $noteService = new NoteService;
        $noteService->setNote($request->id ? Note::find($request->id) : new Note);
        $noteService->save($request);
    }

    public function drop(Request $request)
    {

    }
}
