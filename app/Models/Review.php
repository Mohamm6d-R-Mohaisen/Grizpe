<?php

namespace App\Models;

use App\Http\Resources\Admin\ReviewResource;
use App\Traits\ModelTrait;
use Astrotomic\Translatable\Translatable as Trans;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory, Trans, ModelTrait;
    public $resource = ReviewResource::class;
    public $translatedAttributes = ['name','comment'];
    public $translationForeignKey = 'review_id';
    public $translatedLocales = ['en', 'ar'];
    public $table = 'reviews';
    protected $guarded=[];

    public function scopeSearch($query, $request)
    {
        if (!empty($request->search['value'])) {
            $search = '%' . $request->search['value'] . '%';
            return $query->whereTranslationLike('name', $search);
        }
        return $query;
    }

//    public function user()
//    {
//        return $this->belongsTo(User::class);
//    }
//
//    public function product()
//    {
//        return $this->belongsTo(Product::class);
//    }

    public function averageRating()
    {
        return $this->reviews()->avg('rating');
    }
}
