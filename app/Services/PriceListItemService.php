<?php

namespace App\Services;

use App\Models\PriceListItem;
use App\Models\SampleItem;
use Illuminate\Http\Request;

class PriceListItemService
{
    private $priceListItem;

    /**
     * @return PriceListItem
     */
    public function getPriceListItem(): PriceListItem
    {
        return $this->priceListItem;
    }

    /**
     * @param PriceListItem $priceListItem
     */
    public function setPriceListItem(PriceListItem $priceListItem): void
    {
        $this->priceListItem = $priceListItem;
    }

    public function save(Request $request)
    {
        $this->priceListItem->price_list_id = $request->price_list_id;
        $this->priceListItem->stock_id = $request->stock_id;
        $this->priceListItem->unit_price = $request->unit_price;
        $this->priceListItem->vat_rate = $request->vat_rate;
        $this->priceListItem->currency_type = $request->currency_type;
        $this->priceListItem->currency = $request->currency;
        $this->priceListItem->save();

        return $this->priceListItem;
    }
}
