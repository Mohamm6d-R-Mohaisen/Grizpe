<?php

namespace App\Models;

use App\Http\Resources\Admin\AttributeResource;
use Astrotomic\Translatable\Contracts\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable as Trans;
use App\Traits\ModelTrait;

class Attribute extends Model implements Translatable
{
    use HasFactory, Trans, ModelTrait;
    public $resource = AttributeResource::class;
    public $translatedAttributes = ['name', 'description'];
    public $translatedForeignKey = 'attribute_id';
    public $translatedLocales = ['en', 'ar'];
    protected $fillable = [
        'slug',
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

    // public function attributeValues()
    // {
    //     return $this->belongsToMany(AttributeValue::class, 'variant_attribute_values', 'variant_id', 'attribute_value_id');
    // }

    public function attributeValues()
    {
        return $this->hasMany(AttributeValue::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_attributes');
    }
}
