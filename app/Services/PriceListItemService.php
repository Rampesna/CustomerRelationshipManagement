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
        $this->priceListItem->created_by = $request->id ? $this->priceListItem->created_by : $request->auth_user_id;
        $this->priceListItem->last_updated_by = $request->auth_user_id;
        $this->priceListItem->save();

        return $this->priceListItem;
    }

    public function saveWithData(
        $priceListId,
        $stockId,
        $unitPrice,
        $vatRate,
        $currencyType,
        $currency = null
    )
    {
        $this->priceListItem->price_list_id = $priceListId;
        $this->priceListItem->stock_id = $stockId;
        $this->priceListItem->unit_price = $unitPrice;
        $this->priceListItem->vat_rate = $vatRate;
        $this->priceListItem->currency_type = $currencyType;
        $this->priceListItem->currency = $currency;
        $this->priceListItem->save();

        return $this->priceListItem;
    }
}
