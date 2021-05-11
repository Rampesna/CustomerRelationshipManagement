<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
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

    public function meetReason()
    {
        return $this->belongsTo(Definition::class, 'meet_reason_id', 'id');
    }

    public function priority()
    {
        return $this->belongsTo(Definition::class, 'priority_id', 'id');
    }
}
