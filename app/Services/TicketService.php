<?php

namespace App\Services;

use App\Models\File;
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
        $this->ticket->status_id = $request->status_id;
        $this->ticket->save();

        foreach ($request->file('images') ?? [] as $image) {
            $fileService = new FileService;
            $fileService->setFile(new File);
            $file = $fileService->saveRelation(
                'files/Ticket/' . $this->ticket->id . '/',
                $image->getClientOriginalName(),
                $image->getClientMimeType(),
                $request->user_id,
                $image
            );

            $this->ticket->files()->save($file);
        }

        return $this->ticket;
    }

    public function updateStatus($status)
    {
        $this->ticket->status_id = $status;
        $this->ticket->save();
    }
}
