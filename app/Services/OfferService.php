<?php

namespace App\Services;

use App\Models\Offer;
use Illuminate\Http\Request;

class OfferService
{
    private $offer;

    /**
     * @return Offer
     */
    public function getOffer(): Offer
    {
        return $this->offer;
    }

    /**
     * @param Offer $offer
     */
    public function setOffer(Offer $offer): void
    {
        $this->offer = $offer;
    }

    public function save(Request $request)
    {
        $this->offer->user_id = $request->user_id;
        $this->offer->company_id = $request->company_id;
        $this->offer->relation_type = $request->relation_type;
        $this->offer->relation_id = $request->relation_id;
        $this->offer->subject = $request->subject;
        $this->offer->description = $request->description;
        $this->offer->expiry_date = $request->expiry_date;
        $this->offer->pay_type_id = $request->pay_type_id;
        $this->offer->delivery_type_id = $request->delivery_type_id;
        $this->offer->currency_type = $request->currency_type;
        $this->offer->currency = $request->currency;
        $this->offer->status_id = $request->status_id;
        $this->offer->save();

        return $this->offer;
    }
}
