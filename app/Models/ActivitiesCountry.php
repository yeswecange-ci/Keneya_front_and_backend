<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivitiesCountry extends Model
{
    protected $fillable = [
        'country_code',
        'country_name',
        'color',
        'description',
        'activities',
        'image',
        'order',
        'is_active'
    ];

    protected $casts = [
        'activities' => 'array',
        'is_active' => 'boolean',
        'order' => 'integer'
    ];

    // Scope pour obtenir uniquement les pays actifs
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope pour trier par ordre
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }
}
