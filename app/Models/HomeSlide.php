<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSlide extends Model
{
    use HasFactory;

    protected $table = 'home_slides';

    protected $fillable = [
        'home_slide_number',
        'home_slide_title',
        'home_slide_description',
        'home_slide_image',
        'home_slide_order',
        'home_slide_active'
    ];

    protected $casts = [
        'home_slide_active' => 'boolean',
    ];

    // Scope pour récupérer les slides actifs
    public function scopeActive($query)
    {
        return $query->where('home_slide_active', true);
    }

    // Scope pour ordonner par ordre
    public function scopeOrdered($query)
    {
        return $query->orderBy('home_slide_order');
    }
}
