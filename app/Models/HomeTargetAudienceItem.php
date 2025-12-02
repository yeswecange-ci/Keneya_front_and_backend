<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeTargetAudienceItem extends Model
{
    use HasFactory;

    protected $table = 'home_target_audience_items';

    protected $fillable = [
        'home_target_audience_section_id',
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
        return $this->belongsTo(HomeTargetAudienceSection::class, 'home_target_audience_section_id');
    }
}
