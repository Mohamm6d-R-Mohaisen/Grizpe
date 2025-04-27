<?php

namespace App\Models;

use App\Http\Resources\Admin\AddResource;
use App\Http\Resources\Admin\SliderResource;
use App\Traits\ModelTrait;
use Astrotomic\Translatable\Translatable as Trans;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory, Trans, ModelTrait;
    public $resource = SliderResource::class;
    public $translatedAttributes = ['title','description','type'];
    public $translationForeignKey = 'slider_id';
    public $translatedLocales = ['en', 'ar'];
    public $table = 'sliders';
    public $fillable = [
        'image',
        'status',

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
    //
}
