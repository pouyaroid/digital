<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Factories\HasFactory;


class Customer extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
    ];
    public function orders()
{
    return $this->hasMany(Order::class);
}

public function addresses()
{
    return $this->hasMany(Address::class);
}
}
