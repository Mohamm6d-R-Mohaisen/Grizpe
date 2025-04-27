<?php

namespace App\Models;

use App\Http\Resources\Admin\FeatureResource;
use App\Http\Resources\Admin\PlaneResource;
use App\Traits\ModelTrait;
use Astrotomic\Translatable\Translatable as Trans;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory, Trans, ModelTrait;
    public $resource = FeatureResource::class;
    public $translatedAttributes = ['title'];
    public $translationForeignKey = 'feature_id';
    public $translatedLocales = ['en', 'ar'];
    public $guarded = [];
    public function scopeSearch($query, $request)
    {
        // التحقق من وجود قيمة للبحث
        if (!empty($request->search['value'])) {
            $search = '%' . $request->search['value'] . '%'; // إضافة النسبة المئوية للبحث الجزئي

            // استخدام الـ Scope الجاهز whereTranslationLike للبحث في الترجمة
            return $query->whereTranslationLike('title', $search);
        }

        // إذا لم يكن هناك قيمة للبحث، يتم إرجاع الاستعلام كما هو
        return $query;
    }
    public function plan()
    {
        return $this->belongsTo(Plane::class);
    }
    //
}
