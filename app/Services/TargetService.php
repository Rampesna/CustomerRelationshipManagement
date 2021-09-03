<?php

namespace App\Services;

use App\Models\Manager;
use App\Models\Target;
use Illuminate\Http\Request;

class TargetService
{
    private $target;

    /**
     * @return Target
     */
    public function getTarget(): Target
    {
        return $this->target;
    }

    /**
     * @param Target $target
     */
    public function setTarget(Target $target): void
    {
        $this->target = $target;
    }

    public function save(Request $request)
    {
        $this->target->user_id = $request->user_id;
        $this->target->start_date = $request->start_date;
        $this->target->end_date = $request->end_date;
        $this->target->type = $request->type;
        $this->target->target = $request->target;
        $this->target->save();

        return $this->target;
    }
}
