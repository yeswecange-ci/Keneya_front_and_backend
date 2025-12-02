<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomePartner extends Model
{
    use HasFactory;

    protected $fillable = [
        'home_partner_section_title',
        'home_partner_description',
        'home_partner_active'
    ];

    public function activeItems()
    {
        return $this->hasMany(HomePartnerItem::class)
                    ->where('home_partner_item_active', true)
                    ->orderBy('home_partner_item_order');
    }

    public function allItems()
    {
        return $this->hasMany(HomePartnerItem::class)->orderBy('home_partner_item_order');
    }

    public function scopeActive($query)
    {
        return $query->where('home_partner_active', true);
    }
}
