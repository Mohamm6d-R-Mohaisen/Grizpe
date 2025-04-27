<?php

namespace App\Models;

use App\Http\Resources\Admin\AttributeValueResource;
use App\Traits\Model\ScopeTrait;
use Astrotomic\Translatable\Contracts\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable as Trans;
use App\Traits\ModelTrait;

class AttributeValue extends Model implements Translatable
{
    use HasFactory, Trans, ModelTrait;
    public $resource = AttributeValueResource::class;
    public $translatedAttributes = ['name', 'description'];
    public $translatedForeignKey = 'attribute_value_id';
    public $translatedLocales = ['en', 'ar'];
    protected $fillable = [
        'slug',
        'status',
        'attribute_id',
    ];
 
    public function scopeSearch($query, $request)
    {
        if (!empty($request->search['value'])) {
            $search = '%' . $request->search['value'] . '%';
            return $query->whereTranslationLike('name', '%' . $search . '%');
        }
        return $query;
    }

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
    
    public function variants()
    {
        return $this->belongsToMany(Variant::class, 'variant_attribute_values', 'attribute_value_id', 'variant_id');
    }
}
