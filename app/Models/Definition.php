<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Definition extends Model
{
    use HasFactory, SoftDeletes;

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function definitions()
    {
        return $this->hasMany(Definition::class);
    }
}
