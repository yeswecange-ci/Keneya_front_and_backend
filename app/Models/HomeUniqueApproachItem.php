<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeUniqueApproachItem extends Model
{
    use HasFactory;

    protected $table = 'home_unique_approach_items';

    protected $fillable = [
        'home_unique_approach_section_id',
        'item_text',
        'order',
        'active'
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function section()
    {
        return $this->belongsTo(HomeUniqueApproachSection::class, 'home_unique_approach_section_id');
    }
}
