<?php

namespace App\Models;

use App\Http\Resources\Admin\HomeSectionResource;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable;
use Astrotomic\Translatable\Translatable as Trans;
use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HomeSection extends Model implements Translatable
{
    use HasFactory, Trans, ModelTrait;
    public $resource = HomeSectionResource::class;
    public $translatedAttributes = ['name', 'description'];
    public $translatedForeignKey = 'home_section_id';
    public $translatedLocales = ['en', 'ar'];

    protected $fillable = [
        'type',
        'order',
        'status',
    ];

    public function items()
    {
        return $this->hasMany(HomeSectionItem::class);
    }
}
