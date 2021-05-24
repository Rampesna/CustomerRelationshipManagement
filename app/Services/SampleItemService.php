<?php

namespace App\Services;

use App\Models\SampleItem;
use Illuminate\Http\Request;

class SampleItemService
{
    private $sampleItem;

    /**
     * @return SampleItem
     */
    public function getSampleItem(): SampleItem
    {
        return $this->sampleItem;
    }

    /**
     * @param SampleItem $sampleItem
     */
    public function setSampleItem(SampleItem $sampleItem): void
    {
        $this->sampleItem = $sampleItem;
    }

    public function save(Request $request)
    {
        $this->sampleItem->sample_id = $request->sample_id;
        $this->sampleItem->stock_id = $request->stock_id;
        $this->sampleItem->amount = $request->amount;
        $this->sampleItem->unit_id = $request->unit_id;
        $this->sampleItem->save();

        return $this->sampleItem;
    }
}
