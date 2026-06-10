<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'order_id',
        'gateway',
        'transaction_id',
        'ref_id',
        'amount',
        'status',
        'message',
    ];

    /**
     * رابطه با سفارش
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}