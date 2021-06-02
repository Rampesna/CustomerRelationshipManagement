<?php

namespace App\Services;

use App\Models\OfferItem;
use Illuminate\Http\Request;

class OfferItemService
{
    private $offerItem;

    /**
     * @return mixed
     */
    public function getOfferItem()
    {
        return $this->offerItem;
    }

    /**
     * @param mixed $offerItem
     */
    public function setOfferItem($offerItem): void
    {
        $this->offerItem = $offerItem;
    }

    public function save(Request $request)
    {
        $this->offerItem->offer_id = $request->offer_id;
        $this->offerItem->stock_id = $request->stock_id;
        $this->offerItem->unit_id = $request->unit_id;
        $this->offerItem->unit_price = $request->unit_price;
        $this->offerItem->amount = $request->amount;
        $this->offerItem->vat_rate = $request->vat_rate;
        $this->offerItem->vat_total = $request->vat_total;
        $this->offerItem->discount_rate = $request->discount_rate;
        $this->offerItem->discount_total = $request->discount_total;
        $this->offerItem->subtotal = $request->subtotal;
        $this->offerItem->grand_total = $request->grand_total;
        $this->offerItem->description = $request->description;
        $this->offerItem->created_by = $request->id ? $this->offerItem->created_by : $request->auth_user_id;
        $this->offerItem->last_updated_by = $request->auth_user_id;
        $this->offerItem->save();

        return $this->offerItem;
    }

    public function saveWithData(
        $offerId,
        $stockId,
        $unitId,
        $unitPrice,
        $amount,
        $vatRate,
        $vatTotal,
        $discountRate,
        $discountTotal,
        $subtotal,
        $grandTotal,
        $description = null
    )
    {
        $this->offerItem->offer_id = $offerId;
        $this->offerItem->stock_id = $stockId;
        $this->offerItem->unit_id = $unitId;
        $this->offerItem->unit_price = $unitPrice;
        $this->offerItem->amount = $amount;
        $this->offerItem->vat_rate = $vatRate;
        $this->offerItem->vat_total = $vatTotal;
        $this->offerItem->discount_rate = $discountRate;
        $this->offerItem->discount_total = $discountTotal;
        $this->offerItem->subtotal = $subtotal;
        $this->offerItem->grand_total = $grandTotal;
        $this->offerItem->description = $description;
        $this->offerItem->save();

        return $this->offerItem;
    }
}
