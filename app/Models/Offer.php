<?php

namespace App\Models;

use App\Http\Resources\Admin\AttributeResource;
use App\Http\Resources\Admin\OfferResource;
use Astrotomic\Translatable\Contracts\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable as Trans;
use App\Traits\ModelTrait;

class Offer extends Model implements Translatable
{
    use HasFactory, Trans, ModelTrait;
    public $resource = OfferResource::class;
    public $translatedAttributes = ['name', 'description'];
    public $translatedForeignKey = 'offer_id';
    public $translatedLocales = ['en', 'ar'];
    protected $fillable = [
        'discount_type', 
        'discount_value', 
        'start_date', 
        'end_date', 
        'status'
    ];
 
    public const DISCOUNT_TYPES = [
        '0' => 'fixed',
        '1' => 'percentage',
    ];

    public function scopeSearch($query, $request)
    {
        if (!empty($request->search['value'])) {
            $search = '%' . $request->search['value'] . '%';
            return $query->whereTranslationLike('name', '%' . $search . '%');
        }
        return $query;
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_offers')->withPivot('discount');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_offers');
    }

    // التحقق إذا كان المنتج ضمن العروض النشطة
    public static function isProductInOffers(int $productId): bool
    {
        return self::where('start_date', '<=', now())
                    ->where('end_date', '>=', now())
                    ->where('status', true) // تحقق من العروض النشطة
                    ->whereHas('products', function ($query) use ($productId) {
                        $query->where('product_id', $productId);
                    })
                    ->exists();
    }
}
