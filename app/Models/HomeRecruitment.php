<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeRecruitment extends Model
{
    use HasFactory;

    protected $table = 'home_recruitment';

    protected $fillable = [
        'home_recruitment_section_title',
        'home_recruitment_description',
        'home_recruitment_active'
    ];

    protected $casts = [
        'home_recruitment_active' => 'boolean',
    ];

    // Scope pour récupérer l'élément actif
    public function scopeActive($query)
    {
        return $query->where('home_recruitment_active', true);
    }
}
