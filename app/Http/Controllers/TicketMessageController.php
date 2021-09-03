<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketMessage;
use App\Services\TicketMessageService;
use Illuminate\Http\Request;

class TicketMessageController extends Controller
{
    public function save(Request $request)
    {
        $ticketMessageService = new TicketMessageService;
        $ticketMessageService->setTicketMessage(new TicketMessage);
        $ticketMessageService->save($request);

        return redirect()->back();
    }
}
