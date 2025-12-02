<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CafeCategory extends Model
{
    protected $fillable = [
        'name', 'icon', 'order'
    ];

    public function items()
    {
        return $this->hasMany(CafeItem::class, 'category_id')->orderBy('order');
    }
}
