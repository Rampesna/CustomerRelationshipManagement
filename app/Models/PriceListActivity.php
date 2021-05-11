<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PriceListActivity extends Model
{
    use HasFactory, SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function priceList()
    {
        return $this->belongsTo(PriceList::class);
    }

    public function status()
    {
        return $this->belongsTo(Definition::class, 'status_id', 'id');
    }
}
