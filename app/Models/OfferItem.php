<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OfferItem extends Model
{
    use HasFactory, SoftDeletes;

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }

    public function unit()
    {
        return $this->belongsTo(Definition::class, 'unit_id', 'id');
    }
}
