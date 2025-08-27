<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeKeyNumberStat extends Model
{
    use HasFactory;

    protected $table = 'home_key_number_stats';

    protected $fillable = [
        'home_key_number_id',
        'home_stat_icon',
        'home_stat_number',
        'home_stat_description',
        'home_stat_order',
        'home_stat_active'
    ];

    protected $casts = [
        'home_stat_active' => 'boolean',
        'home_stat_number' => 'integer',
    ];

    // Relation avec HomeKeyNumber
    public function homeKeyNumber()
    {
        return $this->belongsTo(HomeKeyNumber::class, 'home_key_number_id');
    }

    // Scope pour récupérer les stats actives
    public function scopeActive($query)
    {
        return $query->where('home_stat_active', true);
    }

    // Scope pour ordonner par ordre
    public function scopeOrdered($query)
    {
        return $query->orderBy('home_stat_order');
    }
}
