<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterSocial extends Model
{
    use HasFactory;

    protected $fillable = [
        'social_platform',
        'social_url',
        'social_icon',
        'social_order',
        'is_active'
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('social_order');
    }
}
