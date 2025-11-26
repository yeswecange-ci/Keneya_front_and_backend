<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutTeamMember extends Model
{
    use HasFactory;

    protected $table = 'about_team_members';

    protected $fillable = [
        'about_team_name',
        'about_team_position',
        'about_team_description',
        'about_team_image_path',
        'about_team_facebook',
        'about_team_twitter',
        'about_team_linkedin',
        'about_team_instagram',
        'about_team_github',
        'about_team_order',
        'about_team_is_active'
    ];

    protected $casts = [
        'about_team_is_active' => 'boolean'
    ];

    // Récupérer les membres actifs ordonnés
    public static function getActiveMembers()
    {
        return self::where('about_team_is_active', true)
                   ->orderBy('about_team_order')
                   ->get();
    }
}
