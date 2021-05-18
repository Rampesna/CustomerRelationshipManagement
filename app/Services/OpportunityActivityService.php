<?php

namespace App\Services;

use App\Models\OpportunityActivity;

class OpportunityActivityService
{
    private $opportunityActivity;

    /**
     * @return OpportunityActivity
     */
    public function getOpportunityActivity(): OpportunityActivity
    {
        return $this->opportunityActivity;
    }

    /**
     * @param OpportunityActivity $opportunityActivity
     */
    public function setOpportunityActivity(OpportunityActivity $opportunityActivity): void
    {
        $this->opportunityActivity = $opportunityActivity;
    }

    public function save(
        $userId,
        $opportunityId,
        $statusId
    )
    {
        $this->opportunityActivity->user_id = $userId;
        $this->opportunityActivity->opportunity_id = $opportunityId;
        $this->opportunityActivity->status_id = $statusId;
        $this->opportunityActivity->save();

        return $this->opportunityActivity;
    }
}
