<?php

namespace App\Models;

use App\Http\Resources\Admin\ServiceResource;
use App\Http\Resources\Admin\SliderResource;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelTrait;
use Astrotomic\Translatable\Translatable as Trans;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Service extends Model
{
    //
    use HasFactory, Trans, ModelTrait;
    public $resource = ServiceResource::class;
    public $translatedAttributes = ['title','description','short_description'];
    public $translationForeignKey = 'service_id';
    public $translatedLocales = ['en', 'ar'];
    public $table = 'services';
    public $fillable = [
        'image',
        'status',
        'icon',

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
    public function works()
    {
        return $this->hasMany(Add::class); // علاقة واحد إلى كثير
    }
}
