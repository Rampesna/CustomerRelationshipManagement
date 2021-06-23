<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Opportunity extends Model
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

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function priority()
    {
        return $this->belongsTo(Definition::class, 'priority_id', 'id');
    }

    public function accessType()
    {
        return $this->belongsTo(Definition::class, 'access_type_id', 'id');
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

    public function estimatedResultType()
    {
        return $this->belongsTo(Definition::class, 'estimated_result_type_id', 'id');
    }

    public function capacityType()
    {
        return $this->belongsTo(Definition::class, 'capacity_type_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo(Definition::class, 'status_id', 'id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function lastUpdatedBy()
    {
        return $this->belongsTo(User::class, 'last_updated_by', 'id');
    }

    public function brands()
    {
        return $this->belongsToMany(Definition::class, 'brand_relation', 'relation_id', 'brand_id')->withPivot('relation_type')->where('relation_type', 'App\\Models\\Opportunity');
    }

    public function sectors()
    {
        return $this->belongsToMany(Definition::class, 'sector_relation', 'relation_id', 'sector_id')->withPivot('relation_type')->where('relation_type', 'App\\Models\\Opportunity');
    }
}
