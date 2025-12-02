<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeUniqueApproachSection extends Model
{
    use HasFactory;

    protected $table = 'home_unique_approach_section';

    protected $fillable = [
        'title',
        'description_intro',
        'description_middle',
        'description_outro',
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

    public function items()
    {
        return $this->hasMany(HomeUniqueApproachItem::class)->orderBy('order');
    }

    public function activeItems()
    {
        return $this->hasMany(HomeUniqueApproachItem::class)->where('active', true)->orderBy('order');
    }
}
