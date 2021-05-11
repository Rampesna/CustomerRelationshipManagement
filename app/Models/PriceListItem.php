<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PriceListItem extends Model
{
    use HasFactory, SoftDeletes;

    public function priceList()
    {
        return $this->belongsTo(PriceList::class);
    }

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }
}
