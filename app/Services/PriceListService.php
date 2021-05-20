<?php

namespace App\Services;

use App\Models\PriceList;
use Illuminate\Http\Request;

class PriceListService
{
    private $priceList;

    /**
     * @return PriceList
     */
    public function getPriceList(): PriceList
    {
        return $this->priceList;
    }

    /**
     * @param PriceList $priceList
     */
    public function setPriceList(PriceList $priceList): void
    {
        $this->priceList = $priceList;
    }

    public function save(Request $request)
    {
        $this->priceList->user_id = $request->user_id;
        $this->priceList->company_id = $request->company_id;
        $this->priceList->name = $request->name;
        $this->priceList->description = $request->description;
        $this->priceList->start_date = $request->start_date;
        $this->priceList->end_date = $request->end_date;
        $this->priceList->status_id = $request->status_id;
        $this->priceList->save();

        return $this->priceList;
    }
}
