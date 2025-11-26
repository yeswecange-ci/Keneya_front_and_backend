<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivitiesService extends Model
{
    use HasFactory;

    protected $table = 'activities_services';

    protected $fillable = [
        'activities_service_number',
        'activities_service_title',
        'activities_service_features',
        'activities_service_description',
        'activities_service_pdf_path',
        'activities_service_image',
        'activities_service_order',
        'activities_service_is_active',
    ];

    protected $casts = [
        'activities_service_features' => 'array', // Cast JSON en array
        'activities_service_is_active' => 'boolean',
        'activities_service_order' => 'integer',
    ];

    /**
     * Scope pour récupérer seulement les services actifs
     */
    public function scopeActive($query)
    {
        return $query->where('activities_service_is_active', true);
    }

    /**
     * Scope pour ordonner par ordre croissant
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('activities_service_order');
    }
}
