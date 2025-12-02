<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactSection extends Model
{
    protected $fillable = [
        'address',
        'phone',
        'working_hours',
        'instagram_url',
        'instagram_label',
        'telegram_url',
        'telegram_label',
    ];
}
