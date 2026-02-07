<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'customer_id',
        'title',
        'address',
        'lat',
        'lng'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
