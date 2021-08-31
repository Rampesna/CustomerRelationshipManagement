<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Services\TicketService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        return response()->json($request->status_id != 0 ? Ticket::where('status_id', $request->status_id)->get() : Ticket::all());
    }

    public function datatable(Request $request)
    {
        $model = $request->status_id != 0 ? Ticket::where('status_id', $request->status_id)->get() : Ticket::with([]);

        return Datatables::of($model)->
        make(true);
    }

    public function show(Request $request)
    {
        return response()->json(Ticket::with(['messages'])->find($request->id));
    }

    public function save(Request $request)
    {
        $ticketService = new TicketService;
        $ticketService->setTicket($request->id ? Ticket::find($request->id) : new Ticket);
        $ticketService->save($request);
    }

    public function drop(Request $request)
    {
        Ticket::find($request->id)->delete();
    }
}
