<?php

namespace App\Models;

use App\Http\Resources\Admin\AttributeResource;
use App\Http\Resources\Admin\StaticPageResource;
use Astrotomic\Translatable\Contracts\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable as Trans;
use App\Traits\ModelTrait;

class StaticPage extends Model implements Translatable
{
    use HasFactory, Trans, ModelTrait;
    public $resource = StaticPageResource::class;
    public $translatedAttributes = ['title', 'content'];
    public $translatedForeignKey = 'static_page_id';
    public $translatedLocales = ['en', 'ar'];
    protected $fillable = [
        'slug', 
        'status', 
    ];
}
