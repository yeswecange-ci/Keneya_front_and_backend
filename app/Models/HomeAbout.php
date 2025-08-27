<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeAbout extends Model
{
    use HasFactory;

    protected $table = 'home_about';

    protected $fillable = [
        'home_about_section_title',
        'home_about_main_title',
        'home_about_description',
        'home_about_button_text',
        'home_about_button_link',
        'home_about_active'
    ];

    protected $casts = [
        'home_about_active' => 'boolean',
    ];

    // Scope pour récupérer l'élément actif
    public function scopeActive($query)
    {
        return $query->where('home_about_active', true);
    }
}
