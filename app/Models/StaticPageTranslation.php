<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaticPageTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'static_page_id',
        'name',
        'description',
        'locale',
    ];
}
