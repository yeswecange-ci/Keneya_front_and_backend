<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeExpertSpaceSection extends Model
{
    use HasFactory;

    protected $table = 'home_expert_space_section';

    protected $fillable = [
        'title',
        'description',
        'button_text',
        'button_link',
        'image',
        'active'
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }
}
