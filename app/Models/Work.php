<?php

namespace App\Models;

use App\Http\Resources\Admin\SliderResource;
use App\Http\Resources\Admin\WorkResource;
use App\Traits\HasImages;
use App\Traits\ModelTrait;
use Astrotomic\Translatable\Translatable as Trans;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    //
    use HasFactory, Trans, ModelTrait,HasImages;
    public $resource = WorkResource::class;
    public $translatedAttributes = ['title','description','location','overview','client_name'];
    public $translationForeignKey = 'work_id';
    public $translatedLocales = ['en', 'ar'];
    public $table = 'works';
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
    public function service()
    {
        return $this->belongsTo(Service::class); // علاقة تابعة
    }
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
