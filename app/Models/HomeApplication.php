<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeApplication extends Model
{
    use HasFactory;

    protected $table = 'home_applications';

    protected $fillable = [
        'home_application_first_name',
        'home_application_last_name',
        'home_application_email',
        'home_application_phone',
        'home_application_desired_position',
        'home_application_availability_date',
        'home_application_cv_path',
        'home_application_status'
    ];

    protected $casts = [
        'home_application_availability_date' => 'date',
    ];

    // Accessor pour le nom complet
    public function getHomeApplicationFullNameAttribute()
    {
        return $this->home_application_first_name . ' ' . $this->home_application_last_name;
    }

    // Scopes pour filtrer par statut
    public function scopePending($query)
    {
        return $query->where('home_application_status', 'pending');
    }

    public function scopeReviewed($query)
    {
        return $query->where('home_application_status', 'reviewed');
    }

    public function scopeAccepted($query)
    {
        return $query->where('home_application_status', 'accepted');
    }

    public function scopeRejected($query)
    {
        return $query->where('home_application_status', 'rejected');
    }

    // Scope pour ordonner par date de création (plus récent en premier)
    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}
