<?php

namespace App\Models;

use App\Http\Resources\Admin\QuestionResource;
use App\Http\Resources\Admin\SliderResource;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelTrait;
use Astrotomic\Translatable\Translatable as Trans;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    //
    use HasFactory, Trans, ModelTrait;
    public $resource = QuestionResource::class;
    public $translatedAttributes = ['title','description'];
    public $translationForeignKey = 'question_id';
    public $translatedLocales = ['en', 'ar'];
    public $table = 'questions';
    public $fillable = [
        'type',
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
}
