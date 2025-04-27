<?php

namespace App\Models;

use App\Http\Resources\Admin\CategoryResource;
use App\Traits\Model\ScopeTrait;
use Astrotomic\Translatable\Contracts\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable as Trans;
use App\Traits\ModelTrait;

class Category extends Model implements Translatable
{
    use HasFactory, Trans, ModelTrait;
    public $resource = CategoryResource::class;
    public $translatedAttributes = ['name', 'description'];
    public $translatedForeignKey = 'category_id';
    public $translatedLocales = ['en', 'ar'];
    protected $fillable = [
        'parent_id',
        'slug',
        'image',
        'status',
    ];

    public function scopeSearch($query, $request)
    {
        if (!empty($request->search['value'])) {
            $search = '%' . $request->search['value'] . '%';
            return $query->whereTranslationLike('name', '%' . $search . '%');
        }
        return $query;
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id', 'id')->orderBy('id', 'DESC');
    }

    public function offers()
    {
        return $this->belongsToMany(Offer::class, 'product_offers');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_categories');
    }
    public function bloges()
    {
        return $this->hasMany(Bloge::class);
    }
}
