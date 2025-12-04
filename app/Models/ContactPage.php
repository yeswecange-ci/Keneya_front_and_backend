<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'text_above_image_en',
        'text_above_image_fr',
        'text_above_image_es',
        'location_url',
        'location_text_en',
        'location_text_fr',
        'location_text_es',
    ];
}
