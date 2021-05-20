<?php

namespace App\Services;

use App\Models\Stock;
use Illuminate\Http\Request;

class StockService
{
    private $stock;

    /**
     * @return Stock
     */
    public function getStock(): Stock
    {
        return $this->stock;
    }

    /**
     * @param Stock $stock
     */
    public function setStock(Stock $stock): void
    {
        $this->stock = $stock;
    }


    public function save(Request $request)
    {
        $this->stock->company_id = $request->company_id;
        $this->stock->code = $request->code;
        $this->stock->name = $request->name;
        $this->stock->short_name = $request->short_name;
        $this->stock->wholesale_vat = $request->wholesale_vat;
        $this->stock->retail_vat = $request->retail_vat;
        $this->stock->currency_type = $request->currency_type;
        $this->stock->unit_type_id = $request->unit_type_id;
        $this->stock->unit_price = $request->unit_price;
        $this->stock->type_id = $request->type_id;
        $this->stock->status_id = $request->status_id;
        $this->stock->amount = $request->amount;
        $this->stock->save();

        return $this->stock;
    }
}
