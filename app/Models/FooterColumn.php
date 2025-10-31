<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterColumn extends Model
{
    use HasFactory;

    protected $fillable = [
        'column_title',
        'column_order',
        'is_active'
    ];

    public function activeLinks()
    {
        return $this->hasMany(FooterLink::class)->where('is_active', true)->orderBy('link_order');
    }

    public function allLinks()
    {
        return $this->hasMany(FooterLink::class)->orderBy('link_order');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
