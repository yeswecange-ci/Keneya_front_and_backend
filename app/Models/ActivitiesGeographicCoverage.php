<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivitiesGeographicCoverage extends Model
{
    use HasFactory;

    protected $table = 'activities_geographic_coverage';

    protected $fillable = [
        'activities_geographic_title',
        'activities_geographic_description',
        'activities_geographic_map_svg',
        'activities_geographic_is_active',
    ];

    protected $casts = [
        'activities_geographic_is_active' => 'boolean',
    ];

    /**
     * Scope pour récupérer seulement les entrées actives
     */
    public function scopeActive($query)
    {
        return $query->where('activities_geographic_is_active', true);
    }
}
