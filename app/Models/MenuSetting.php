<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuSetting extends Model
{
    protected $fillable = [
        'ordering_enabled',
        'show_prices',
        'show_calories',
        'theme_color',
    ];
}