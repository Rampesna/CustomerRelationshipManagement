<?php

namespace App\Services;

use App\Models\Activity;
use App\Models\ErpMatch;
use Illuminate\Http\Request;

class ErpMatchService
{
    private $erpMatch;

    /**
     * @return ErpMatch
     */
    public function getErpMatch(): ErpMatch
    {
        return $this->erpMatch;
    }

    /**
     * @param ErpMatch $erpMatch
     */
    public function setErpMatch(ErpMatch $erpMatch): void
    {
        $this->erpMatch = $erpMatch;
    }

    public function save(
        $relation_type,
        $relation_id,
        $guid
    )
    {
        $this->erpMatch->relation_type = $relation_type;
        $this->erpMatch->relation_id = $relation_id;
        $this->erpMatch->guid = $guid;
        $this->erpMatch->save();

        return $this->erpMatch;
    }
}
