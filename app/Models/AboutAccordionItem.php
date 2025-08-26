<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutAccordionItem extends Model
{
    use HasFactory;

    protected $table = 'about_accordion_items';

    protected $fillable = [
        'about_accordion_title',
        'about_accordion_content',
        'about_accordion_order',
        'about_accordion_is_active'
    ];

    protected $casts = [
        'about_accordion_is_active' => 'boolean'
    ];

    // Récupérer les items actifs ordonnés
    public static function getActiveItems()
    {
        return self::where('about_accordion_is_active', true)
                   ->orderBy('about_accordion_order')
                   ->get();
    }
}
