<?php

namespace App\Services;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class TicketService
{
    private $ticket;

    /**
     * @return Ticket
     */
    public function getTicket(): Ticket
    {
        return $this->ticket;
    }

    /**
     * @param User $user
     */
    public function setTicket(Ticket $ticket): void
    {
        $this->ticket = $ticket;
    }

    public function save(Request $request)
    {
        $this->ticket->user_id = $request->user_id;
        $this->ticket->subject = $request->subject;
        $this->ticket->description = $request->description;
        $this->ticket->save();

        return $this->ticket;
    }
}
