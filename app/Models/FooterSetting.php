<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'footer_logo1',
        'footer_logo2',
        'footer_copyright',
        'footer_legal_link',
        'footer_legal_text'
    ];
}
