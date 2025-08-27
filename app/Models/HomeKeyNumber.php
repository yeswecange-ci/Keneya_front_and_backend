<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeKeyNumber extends Model
{
    use HasFactory;

    protected $table = 'home_key_numbers';

    protected $fillable = [
        'home_key_numbers_section_title',
        'home_key_numbers_description',
        'home_key_numbers_image',
        'home_key_numbers_button_text',
        'home_key_numbers_button_link',
        'home_key_numbers_active'
    ];

    protected $casts = [
        'home_key_numbers_active' => 'boolean',
    ];

    // Relation avec les statistiques
    public function homeKeyNumberStats()
    {
        return $this->hasMany(HomeKeyNumberStat::class, 'home_key_number_id');
    }

    // Relation pour récupérer les stats actives et ordonnées
    public function activeStats()
    {
        return $this->homeKeyNumberStats()->active()->ordered();
    }

    // Scope pour récupérer l'élément actif
    public function scopeActive($query)
    {
        return $query->where('home_key_numbers_active', true);
    }
}
