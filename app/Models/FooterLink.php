<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'footer_column_id',
        'link_text',
        'link_url',
        'link_order',
        'is_active'
    ];

    public function column()
    {
        return $this->belongsTo(FooterColumn::class);
    }
}
