<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeTargetAudienceSection extends Model
{
    use HasFactory;

    protected $table = 'home_target_audience_section';

    protected $fillable = [
        'title',
        'description',
        'outro_description',
        'image',
        'button_text',
        'button_link',
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
        return $this->hasMany(HomeTargetAudienceItem::class)->orderBy('order');
    }

    public function activeItems()
    {
        return $this->hasMany(HomeTargetAudienceItem::class)->where('active', true)->orderBy('order');
    }
}
