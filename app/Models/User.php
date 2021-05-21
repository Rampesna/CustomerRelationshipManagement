<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function id()
    {
        return $this->id;
    }

    public function name()
    {
        return $this->name;
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function authority($permission): bool
    {
        return $this->role->permissions()->where('permission_id', $permission)->exists() ? true : false;
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }

    public function opportunities()
    {
        return $this->hasMany(Opportunity::class)->select('name');
    }
}
