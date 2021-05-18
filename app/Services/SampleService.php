<?php

namespace App\Services;

use App\Models\Sample;
use Illuminate\Http\Request;

class SampleService
{
    private $sample;

    /**
     * @return Sample
     */
    public function getSample(): Sample
    {
        return $this->sample;
    }

    /**
     * @param Sample $sample
     */
    public function setSample(Sample $sample): void
    {
        $this->sample = $sample;
    }

    public function save(Request $request)
    {
        $this->sample->user_id = $request->user_id;
        $this->sample->company_id = $request->company_id;
        $this->sample->relation_id = $request->relation_id;
        $this->sample->relation_type = $request->relation_type;
        $this->sample->date = $request->date;
        $this->sample->status_id = $request->status_id;
        $this->sample->subject = $request->subject;
        $this->sample->cargo_company_id = $request->cargo_company_id;
        $this->sample->cargo_tracking_number = $request->cargo_tracking_number;
        $this->sample->bus_company = $request->bus_company;
        $this->sample->car_plate = $request->car_plate;
        $this->sample->save();

        return $this->sample;
    }
}
