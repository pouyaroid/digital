<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CafeHeader extends Model
{
    protected $fillable = [
        'cafe_name',
        'cafe_tagline',
        'coffee_emoji'
    ];
}
