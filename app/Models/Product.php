<?php

namespace App\Models;

use App\Http\Resources\Admin\ProductResource;
use App\Traits\HasImages;
use App\Traits\HasVideos;
use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable as Trans;
use Astrotomic\Translatable\Contracts\Translatable;
use NumberFormatter;

class Product extends Model implements Translatable
{
    use HasFactory, Trans, ModelTrait, HasImages; //HasVideos
    public $resource = ProductResource::class;
    public $translatedAttributes = ['name','short_description','long_description'];
    public $translationForeignKey = 'product_id';
    public $translatedLocales = ['en', 'ar'];
    protected $fillable = [
        'sku',
        'slug',
        'price',
        'type',
        'offer_price',
        'meta_title',
        'meta_description',
        'status',
    ];

    public const PRODUCT_TYPES = [
        '0' => 'normal',
        '1' => 'variant',
    ];

    public function scopeSearch($query, $request)
    {
        // التحقق من وجود قيمة للبحث
        if (!empty($request->search['value'])) {
            $search = '%' . $request->search['value'] . '%'; // إضافة النسبة المئوية للبحث الجزئي

            // استخدام الـ Scope الجاهز whereTranslationLike للبحث في الترجمة
            return $query->whereTranslationLike('name', $search);
        }

        // إذا لم يكن هناك قيمة للبحث، يتم إرجاع الاستعلام كما هو
        return $query;
    }
//

    public function scopeFilterCategory($query, $category_id)
    {
        if($category_id !== null){
            return $query->whereHas('categories', function($q) use ($category_id){
                $q->where('categories.id', $category_id);
            });
        }
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'product_attributes')->withPivot('attribute_value_id');
    }

    public function attributeValues()
    {
        return $this->belongsToMany(AttributeValue::class, 'product_attributes', 'product_id', 'attribute_value_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class)->orderBy('pos', 'ASC');
    }

    public function offers()
    {
        return $this->belongsToMany(Offer::class, 'product_offers');
    }

    public function inventory()
    {
        return $this->morphOne(Inventory::class, 'inventoryable');
    }

    // التحقق ان المنتج من ضمن العروض
    public function isInOffers(): bool
    {
        return $this->offers()
                    ->where('start_date', '<=', now())
                    ->where('end_date', '>=', now())
                    ->where('status', 'active') // تحقق من العروض النشطة
                    ->exists();
    }

    // يحسب الخصم الناتج من العرض، لا تستخدم هذه الدالة الا
    // عند ارجاع منتج واحد فقط لانها تبطئ السيرفر عند اكتر من منتج
    public function getOfferDiscount(): ?float
    {
        $active_offers = $this->offers()
                            ->where('start_date', '<=', now())
                            ->where('end_date', '>=', now())
                            ->where('status', 'active') // تحقق من العروض النشطة
                            ->get();

        foreach ($active_offers as $offer) {
            $productOffer = $offer->products()->where('product_id', $this->id)->first(); // التحقق إذا كان المنتج مشمولًا في العرض الحالي

            if ($productOffer) {
                return $offer->discount;
            }
        }

        return null; // لا يوجد خصم للمنتج
    }

    // Accessor لتنسيق السعر
    public function getFormattedPriceAttribute()
    {
        $locale = app()->getLocale();
        $currency = 'SAR';

        $formatter = new NumberFormatter($locale, NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($this->price, $currency);
    }

    // دالة لتنسيق السعر الخاص
    public function getFormattedOfferPriceAttribute()
    {
        $locale = app()->getLocale();
        $currency = 'SAR';

        $formatter = new \NumberFormatter($locale, \NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($this->price - $this->offer_price, $currency);
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'user_favorites', 'product_id', 'user_id')->withTimestamps();
    }

    public function averageRating()
    {
        return $this->hasMany(Review::class)->where('status', 1)->avg('rating');
    }

    public function totalRatings()
    {
        return $this->hasMany(Review::class)->where('status', 1)->sum();
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id');
    }

    public function variants()
    {
        return $this->hasMany(Variant::class);
    }

    public function getAvailableYearsAttribute()
    {
        return $this->variants()
            ->with('attributeValues.attribute')
            ->get()
            ->pluck('attributeValues')
            ->flatten() // تحويل المصفوفات المتداخلة إلى مصفوفة واحدة
            ->where('attribute.slug', 'year') // تصفية القيم بناءً على اسم السمة
            ->pluck('name')
            ->unique()
            ->values();
    }

    public function getAvailableMemoriesAttribute()
    {
        return $this->variants()
            ->with('attributeValues.attribute')
            ->get()
            ->pluck('attributeValues')
            ->flatten() // تحويل المصفوفات المتداخلة إلى مصفوفة واحدة
            ->where('attribute.slug', 'memory_size') // تصفية القيم بناءً على اسم السمة
            ->pluck('name')
            ->unique()
            ->values();
    }
}
