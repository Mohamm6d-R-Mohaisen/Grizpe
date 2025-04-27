<?php

namespace App\Models;

use App\Http\Resources\Admin\AddResource;
use App\Http\Resources\Admin\BlogResource;
use App\Traits\ModelTrait;
use Astrotomic\Translatable\Translatable as Trans;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bloge extends Model
{
    use HasFactory, Trans, ModelTrait;
    //
    public $resource = BlogResource::class;

    public $translatedAttributes = ['title','author_name','content','lessons','quotation','short_description'];
    public $translationForeignKey = 'bloge_id';
    public $translatedLocales = ['en', 'ar'];
    public $table = 'bloges';
    //
    public $guarded=[];
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
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments(){
    return $this->hasMany(Comment::class);
        }
}
