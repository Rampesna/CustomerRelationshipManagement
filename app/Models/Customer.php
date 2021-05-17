<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function class()
    {
        return $this->belongsTo(Definition::class, 'class_id', 'id');
    }

    public function type()
    {
        return $this->belongsTo(Definition::class, 'type_id', 'id');
    }

    public function reference()
    {
        return $this->belongsTo(Definition::class, 'reference_id', 'id');
    }

    public function opportunities()
    {
        return $this->hasMany(Opportunity::class);
    }
}
