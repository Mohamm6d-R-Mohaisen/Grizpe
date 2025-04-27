<?php

namespace App\Models;

use App\Http\Resources\Admin\AddResource;
use App\Http\Resources\Admin\CommentResource;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    public $resource = CommentResource::class;
    protected $table = 'comments';
    protected $guarded = [];
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
    public function blog()
    {
        return $this->belongsTo(Bloge::class, 'blog_id');
    }
}
