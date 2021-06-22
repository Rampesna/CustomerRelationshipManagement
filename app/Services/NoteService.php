<?php

namespace App\Services;

use App\Models\Activity;
use App\Models\Note;
use Illuminate\Http\Request;

class NoteService
{
    private $note;

    /**
     * @return Note
     */
    public function getNote(): Note
    {
        return $this->note;
    }

    /**
     * @param Note $note
     */
    public function setNote(Note $note): void
    {
        $this->note = $note;
    }

    public function save(Request $request)
    {
        $this->note->company_id = $request->company_id;
        $this->note->user_id = $request->user_id;
        $this->note->title = $request->title;
        $this->note->date = $request->date;
        $this->note->description = $request->description;
        $this->note->global = $request->global;
        $this->note->save();

        return $this->note;
    }
}
