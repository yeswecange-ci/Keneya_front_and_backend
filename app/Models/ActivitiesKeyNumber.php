<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivitiesKeyNumber extends Model
{
    use HasFactory;

    protected $table = 'activities_key_numbers';

    protected $fillable = [
        'activities_keynumber_title',
        'activities_keynumber_value',
        'activities_keynumber_icon',
        'activities_keynumber_description',
        'activities_keynumber_order',
        'activities_keynumber_is_active'
    ];

    protected $casts = [
        'activities_keynumber_is_active' => 'boolean'
    ];

    public function scopeActive($query)
    {
        return $query->where('activities_keynumber_is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('activities_keynumber_order');
    }
}