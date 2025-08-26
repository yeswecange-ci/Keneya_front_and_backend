<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutTransitionListItem extends Model
{
    use HasFactory;

    protected $table = 'about_transition_list_items';

    protected $fillable = [
        'about_transition_section_id',
        'about_transition_list_content',
        'about_transition_list_order',
        'about_transition_list_is_active'
    ];

    protected $casts = [
        'about_transition_list_is_active' => 'boolean'
    ];

    // Relation avec la section transition
    public function aboutTransitionSection()
    {
        return $this->belongsTo(AboutTransitionSection::class, 'about_transition_section_id');
    }
}
