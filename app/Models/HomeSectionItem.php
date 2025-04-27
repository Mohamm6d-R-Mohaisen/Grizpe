<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable;
use Astrotomic\Translatable\Translatable as Trans;
use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HomeSectionItem extends Model implements Translatable
{
    use HasFactory, Trans, ModelTrait;
    // public $resource = HomeSectionItemResource::class;
    public $translatedAttributes = ['name', 'description'];
    public $translatedForeignKey = 'home_section_item_id';
    public $translatedLocales = ['en', 'ar'];

    protected $fillable = [
        'home_section_id',
        'image',
        'link',
        'order',
    ];

    public function section()
    {
        return $this->belongsTo(HomeSection::class);
    }
}
