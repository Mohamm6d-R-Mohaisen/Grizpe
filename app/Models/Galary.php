<?php

namespace App\Models;

use App\Http\Resources\Admin\AddResource;
use App\Http\Resources\Admin\GalaryResource;
use App\Traits\ModelTrait;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galary extends Model
{
    //
    use HasFactory, ModelTrait;
    public $resource = GalaryResource::class;
    protected $table = 'galaries';
    protected $guarded=[];
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
