<?php

namespace App\Services;

use App\Models\Opportunity;
use App\Models\OpportunityActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityService
{
    private $activity;

    /**
     * @return mixed
     */
    public function getActivity()
    {
        return $this->activity;
    }

    /**
     * @param mixed $activity
     */
    public function setActivity($activity): void
    {
        $this->activity = $activity;
    }

    public function save(Request $request)
    {
        $this->activity->user_id = $request->user_id;
        $this->activity->company_id = $request->company_id;
        $this->activity->relation_id = $request->relation_id;
        $this->activity->relation_type = $request->relation_type;
        $this->activity->subject = $request->subject;
        $this->activity->notes = $request->notes;
        $this->activity->start_date = $request->start_date;
        $this->activity->end_date = $request->end_date;
        $this->activity->meet_reason_id = $request->meet_reason_id;
        $this->activity->priority_id = $request->priority_id;
        $this->activity->save();

        return $this->activity;
    }
}
