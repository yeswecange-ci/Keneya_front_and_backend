<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomePartnerItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'home_partner_id',
        'home_partner_item_image',
        'home_partner_item_alt',
        'home_partner_item_order',
        'home_partner_item_active'
    ];

    public function partner()
    {
        return $this->belongsTo(HomePartner::class);
    }

    public function scopeActive($query)
    {
        return $query->where('home_partner_item_active', true);
    }
}
