<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ErpMatch extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function relation()
    {
        return $this->morphTo();
    }
}
