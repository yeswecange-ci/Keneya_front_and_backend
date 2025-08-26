<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivitiesPageContent extends Model
{
    use HasFactory;

    protected $table = 'activities_page_content';

    protected $fillable = [
        'activities_content_key',
        'activities_content_value',
        'activities_content_type',
        'activities_content_description',
    ];

    /**
     * Méthode helper pour récupérer rapidement une valeur par clé
     */
    public static function getContentByKey($key)
    {
        $content = self::where('activities_content_key', $key)->first();
        return $content ? $content->activities_content_value : null;
    }

    /**
     * Méthode helper pour définir ou mettre à jour un contenu
     */
    public static function setContent($key, $value, $type = 'text', $description = null)
    {
        return self::updateOrCreate(
            ['activities_content_key' => $key],
            [
                'activities_content_value' => $value,
                'activities_content_type' => $type,
                'activities_content_description' => $description
            ]
        );
    }
}
