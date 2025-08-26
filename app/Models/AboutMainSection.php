<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutMainSection extends Model
{
    use HasFactory;

    protected $table = 'about_main_sections';

    protected $fillable = [
        'about_title',
        'about_description_1',
        'about_description_2',
        'about_description_3',
        'about_description_4',
        'about_image_path',
        'about_button_text',
        'about_button_link',
        'about_is_active'
    ];

    protected $casts = [
        'about_is_active' => 'boolean'
    ];

    // Récupérer la section active
    public static function getActiveSection()
    {
        return self::where('about_is_active', true)->first();
    }
}
