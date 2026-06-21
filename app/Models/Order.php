<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['customer_id','address_id','total_price','status','payment_method','note'];

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function address() {
        return $this->belongsTo(Address::class);
    }

    public function items() {
        return $this->hasMany(OrderItem::class);
    }
    public function payments()
    {
        return $this->hasOne(Payment::class)->latestOfMany();
    }
}