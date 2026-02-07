<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = ['order_id','cafe_item_id','price','quantity'];

    public function order() {
        return $this->belongsTo(Order::class);
    }

    public function cafeItem() {
        return $this->belongsTo(CafeItem::class,'cafe_item_id');
    }
}