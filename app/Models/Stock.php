<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stock extends Model
{
    use HasFactory, SoftDeletes;

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function unitType()
    {
        return $this->belongsTo(Definition::class, 'unit_type_id', 'id');
    }

    public function type()
    {
        return $this->belongsTo(Definition::class, 'type_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo(Definition::class, 'status_id', 'id');
    }
}
