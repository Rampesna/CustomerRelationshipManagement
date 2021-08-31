<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        return view('pages.ticket.index.index');
    }

    public function show(Request $request)
    {
        return view('pages.ticket.show.index', [
            'ticket' => Ticket::find($request->id)
        ]);
    }
}
