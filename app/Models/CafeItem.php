<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CafeItem extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'discount_price',
        'image',
        'tags',
        'calories',
        'order',
        'is_available'
    ];

    protected $casts = [
        'is_available' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(CafeCategory::class, 'category_id');
    }

    // تبدیل tags از رشته → آرایه
    public function getTagsArrayAttribute()
    {
        return $this->tags ? explode(',', $this->tags) : [];
    }
}
