<?php

namespace App\Services;

use App\Models\File;
use App\Models\Ticket;
use App\Models\TicketMessage;
use App\Models\User;
use Illuminate\Http\Request;

class TicketMessageService
{
    private $ticketMessage;

    /**
     * @return TicketMessage
     */
    public function getTicketMessage(): TicketMessage
    {
        return $this->ticketMessage;
    }

    /**
     * @param User $user
     */
    public function setTicketMessage(TicketMessage $ticketMessage): void
    {
        $this->ticketMessage = $ticketMessage;
    }

    public function save(Request $request)
    {
        $this->ticketMessage->user_id = $request->user_id;
        $this->ticketMessage->ticket_id = $request->ticket_id;
        $this->ticketMessage->message = $request->message;
        $this->ticketMessage->save();

        $ticketService = new TicketService;
        $ticketService->setTicket(Ticket::find($this->ticketMessage->ticket_id));
        $ticketService->updateStatus(2);

        foreach ($request->file('images') as $image) {
            $fileService = new FileService;
            $fileService->setFile(new File);
            $file = $fileService->saveRelation(
                'files/TicketMessage/' . $this->ticketMessage->id . '/',
                $image->getClientOriginalName(),
                $image->getClientMimeType(),
                $request->user_id,
                $image
            );

            $this->ticketMessage->files()->save($file);
        }

        return $this->ticketMessage;
    }
}
