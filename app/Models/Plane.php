<?php

namespace App\Models;

use App\Http\Resources\Admin\PlaneResource;
use App\Http\Resources\Admin\QuestionResource;
use App\Traits\ModelTrait;
use Astrotomic\Translatable\Translatable as Trans;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plane extends Model
{
    //
    use HasFactory, Trans, ModelTrait;
    public $resource = PlaneResource::class;
    protected $translationModel = \App\Models\PlaneTranslation::class;
    public $translatedAttributes = ['title','description'];
    public $translationForeignKey = 'plane_id';
    public $translatedLocales = ['en', 'ar'];
    public $table = 'planes';
    public $fillable = [
        'type',
        'status',
        'price',

    ];
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
    public function features()
    {
        return $this->hasMany(Feature::class);
    }

}
