<?php

namespace App\Services;

use App\Models\Activity;
use App\Models\Meeting;
use App\Models\Note;
use Illuminate\Http\Request;

class MeetingService
{
    private $meeting;

    /**
     * @return Meeting
     */
    public function getMeeting(): Meeting
    {
        return $this->meeting;
    }

    /**
     * @param Meeting $meeting
     */
    public function setMeeting(Meeting $meeting): void
    {
        $this->meeting = $meeting;
    }

    public function save(Request $request)
    {
        $this->meeting->company_id = $request->company_id;
        $this->meeting->user_id = $request->user_id;
        $this->meeting->title = $request->title;
        $this->meeting->description = $request->description;
        $this->meeting->start_date = $request->start_date;
        $this->meeting->end_date = $request->end_date;
        $this->meeting->type = $request->type;
        $this->meeting->address = $request->address;
        $this->meeting->save();

        $this->meeting->users()->sync($request->users);

        return $this->meeting;
    }
}
