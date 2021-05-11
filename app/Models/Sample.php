<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sample extends Model
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

    public function status()
    {
        return $this->belongsTo(Definition::class, 'status_id', 'id');
    }

    public function cargoCompany()
    {
        return $this->belongsTo(Definition::class, 'cargo_company_id', 'id');
    }

    public function relation()
    {
        return $this->morphTo();
    }
}
