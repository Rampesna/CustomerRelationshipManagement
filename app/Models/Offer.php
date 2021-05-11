<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Offer extends Model
{
    use HasFactory, SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function relation()
    {
        return $this->morphTo();
    }

    public function items()
    {
        return $this->hasMany(OfferItem::class);
    }

    public function payType()
    {
        return $this->belongsTo(Definition::class, 'pay_type_id', 'id');
    }

    public function deliveryType()
    {
        return $this->belongsTo(Definition::class, 'delivery_type_id', 'id');
    }
}
