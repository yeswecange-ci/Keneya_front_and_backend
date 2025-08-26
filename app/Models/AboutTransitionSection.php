<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutTransitionSection extends Model
{
    use HasFactory;

    protected $table = 'about_transition_sections';

    protected $fillable = [
        'about_transition_title',
        'about_transition_description_1',
        'about_transition_description_2',
        'about_transition_image_path',
        'about_transition_is_active'
    ];

    protected $casts = [
        'about_transition_is_active' => 'boolean'
    ];

    // Relation avec les items de liste
    public function aboutTransitionListItems()
    {
        return $this->hasMany(AboutTransitionListItem::class, 'about_transition_section_id')
                   ->where('about_transition_list_is_active', true)
                   ->orderBy('about_transition_list_order');
    }

    // Récupérer la section active
    public static function getActiveSection()
    {
        return self::where('about_transition_is_active', true)->first();
    }
}
