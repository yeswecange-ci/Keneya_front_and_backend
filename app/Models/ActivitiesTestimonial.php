<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivitiesTestimonial extends Model
{
    use HasFactory;

    protected $table = 'activities_testimonials';

    protected $fillable = [
        'activities_testimonial_title',
        'activities_testimonial_description',
        'activities_testimonial_image',
        'activities_testimonial_link',
        'activities_testimonial_order',
        'activities_testimonial_is_active',
    ];

    protected $casts = [
        'activities_testimonial_is_active' => 'boolean',
        'activities_testimonial_order' => 'integer',
    ];

    /**
     * Scope pour récupérer seulement les témoignages actifs
     */
    public function scopeActive($query)
    {
        return $query->where('activities_testimonial_is_active', true);
    }

    /**
     * Scope pour ordonner par ordre croissant
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('activities_testimonial_order');
    }
}
