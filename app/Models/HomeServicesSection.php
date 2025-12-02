<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeServicesSection extends Model
{
    use HasFactory;

    protected $table = 'home_services_section';

    protected $fillable = [
        'title',
        'description',
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
