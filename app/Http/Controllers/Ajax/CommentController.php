<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Social;
use App\Services\CommentService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(Comment::with([])->where('relation_type', $request->relation_type)->where('relation_id', $request->relation_id)->get());
    }

    public function datatable(Request $request)
    {
        return Datatables::of(Comment::with([])->where('relation_type', $request->relation_type)->where('relation_id', $request->relation_id))->
        editColumn('id', function ($comment) {
            return '#' . $comment->id;
        })->
        editColumn('user_id', function ($comment) {
            return $comment->user_id ? @$comment->user->name : '';
        })->
        make(true);
    }

    public function show(Request $request)
    {
        return response()->json(Comment::find($request->id), 200);
    }

    public function save(Request $request)
    {
        $commentService = new CommentService;
        $commentService->setComment($request->id ? Comment::find($request->id) : new Comment);
        $commentService->save($request);
    }

    public function drop(Request $request)
    {
        Comment::find($request->id)->delete();
    }
}
