<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsArticle extends Model
{
    use HasFactory;

    protected $fillable = [
        'news_title',
        'news_description',
        'news_image',
        'news_link',
        'news_type',
        'news_is_active',
        'news_order'
    ];

    protected $casts = [
        'news_is_active' => 'boolean',
    ];

    // Scope pour récupérer seulement les articles actifs
    public function scopeActive($query)
    {
        return $query->where('news_is_active', true);
    }

    // Scope pour récupérer les articles par type
    public function scopeByType($query, $type)
    {
        return $query->where('news_type', $type);
    }

    // Scope pour ordonner par ordre d'affichage
    public function scopeOrdered($query)
    {
        return $query->orderBy('news_order', 'asc')->orderBy('created_at', 'desc');
    }

    // Constantes pour les types
    const TYPE_BLOG = 'blog';
    const TYPE_EVENT = 'event';
    const TYPE_PUBLICATION = 'publication';
    const TYPE_PRESS_RELEASE = 'press_release';

    public static function getTypes()
    {
        return [
            self::TYPE_BLOG => 'Blog d\'actualités',
            self::TYPE_EVENT => 'Événements',
            self::TYPE_PUBLICATION => 'Publications',
            self::TYPE_PRESS_RELEASE => 'Communiqués de presse',
        ];
    }
}
