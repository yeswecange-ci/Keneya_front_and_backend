<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivitiesTheme extends Model
{
    use HasFactory;

    protected $table = 'activities_themes';

    protected $fillable = [
        'activities_theme_title',
        'activities_theme_description',
        'activities_theme_icon',
        'activities_theme_order',
        'activities_theme_is_active',
    ];

    protected $casts = [
        'activities_theme_is_active' => 'boolean',
        'activities_theme_order' => 'integer',
    ];

    /**
     * Scope pour récupérer seulement les thèmes actifs
     */
    public function scopeActive($query)
    {
        return $query->where('activities_theme_is_active', true);
    }

    /**
     * Scope pour ordonner par ordre croissant
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('activities_theme_order');
    }
}
