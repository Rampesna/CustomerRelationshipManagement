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
        $this->target->company_id = $request->company_id;
        $this->target->type = $request->type;
        $this->target->year = date('Y', strtotime($request->date));
        $this->target->month = date('m', strtotime($request->date));
        $this->target->target = $request->target;
        $this->target->save();

        return $this->target;
    }
}
