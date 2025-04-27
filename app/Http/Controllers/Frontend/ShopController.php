<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->has('category')) {
            $query->whereRelation('categories', 'id', $request->category);
        }

        $data['products'] = $query->active()->paginate(12);
        // $data['categories'] = Category::active()->get();
        // $data['allProductsCount'] = Product::count();

        $data['categories'] = Cache::remember('categories', now()->addHours(24), function () {
            return Category::active()->get();
        });

        $data['allProductsCount'] = Cache::remember('allProductsCount', now()->addHours(24), function () {
            return Product::count();
        });

        $data['priceRanges'] = Cache::remember('priceRanges', now()->addHours(24), function () { 
            return $this->generatePriceRanges() ;
        });

        return view('frontend.shop', $data);
    }

    public function filter(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string',
            'category' => 'nullable|exists:categories,id',
            'price' => 'nullable|string|regex:/^\d+(-\d+)?$/',  // التحقق من أن السعر هو نطاق صحيح
            'ratings' => 'nullable|numeric|min:0|max:5',  // التحقق من أن التقييم هو رقم بين 0 و 5
            'sort_by' => 'nullable|in:price_asc,price_desc,newest,oldest',
        ]);

        $query = Product::query();
    
        // فلترة حسب البحث
        $query->when($request->has('search') && $request->search != 'all' && $request->search != '', function ($query) use ($request) {
            $query->whereTranslationLike('name', '%' . $request->search . '%');
        });
    
        // فلترة حسب الفئة
        $query->when($request->has('category') && $request->category != 'all' && $request->category != '', function ($query) use ($request) {
            $query->whereRelation('categories', 'id', $request->category);
        });
    
        // فلترة حسب السعر
        $query->when($request->has('price') && $request->price != '', function ($query) use ($request) {
            $priceRange = explode('-', $request->price);
            if (count($priceRange) == 2) {
                $query->whereBetween('price', [$priceRange[0], $priceRange[1]]);
            }
        });
    
        // فلترة حسب التقييمات
        $query->when($request->has('ratings') && $request->ratings != '', function ($query) use ($request) {
            $ratings = (float) $request->ratings;
            $query->withAvg('reviews', 'rating')
                  ->having('reviews_avg_rating', '>=', $ratings)
                  ->orderBy('reviews_avg_rating', 'desc');
        });
    
        // تحديد معيار الترتيب
        $this->applySort($request, $query);
    
        // الحصول على المنتجات مع التصفح
        $products = $query->paginate(12);
    
        // إرجاع النتيجة
        return response()->json([
            'render' => view('frontend.partials.products_filter', compact('products'))->render(),
            'pagination' => $products->links('pagination::bootstrap-4')->render() // توليد الترقيم
        ]);
    }
    
    /**
     * تطبيق الترتيب على الاستعلام
     */
    protected function applySort(Request $request, $query)
    {
        // التحقق من القيمة المحددة للترتيب
        $sortBy = $request->get('sort_by', 'price_asc'); // القيمة الافتراضية
    
        switch ($sortBy) {
            case 'price_asc':
                $query->orderBy('price', 'asc');  // ترتيب حسب السعر من الأقل إلى الأعلى
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');  // ترتيب حسب السعر من الأعلى إلى الأدنى
                break;
            case 'newest':
                $query->orderBy('created_at', 'desc');  // ترتيب حسب الأحدث أولاً
                break;
            case 'oldest':
                $query->orderBy('created_at', 'asc');  // ترتيب حسب الأقدم أولاً
                break;
            default:
                $query->orderBy('price', 'asc');  // ترتيب افتراضي حسب السعر التصاعدي
                break;
        }
    }
    

    public function getProduct(Product $product)
    {
        $data['product'] = $product;
        $data['similar_products'] = Product::whereHas('categories', function ($query) use ($product) {
                                        $query->whereIn('categories.id', $product->categories->pluck('id'));
                                    })->where('id', '!=', $product->id)
                                    ->limit(4)
                                    ->get();
                                    
        return view('frontend.product_details', $data);
    }

    protected function generatePriceRanges()
    {
        // تحديد قيمة الـ step الذي سيحدد الفرق بين النطاقات
        $rangeStep = 100;

        // الحصول على أقل وأعلى الأسعار
        $minPrice = Product::min('price');
        $maxPrice = Product::max('price');

        // تقريبات لأقرب قيم مضاعفة لـ rangeStep
        $minRange = floor($minPrice / $rangeStep) * $rangeStep;
        $maxRange = ceil($maxPrice / $rangeStep) * $rangeStep;

        // إنشاء النطاقات السعرية بناءً على النطاقات الثابتة
        $priceRanges = [];
        for ($i = $minRange; $i < $maxRange; $i += $rangeStep) {
            $priceRanges[] = [
                'min' => $i,
                'max' => $i + $rangeStep,
            ];
        }

        return $priceRanges;
    }

    // protected function generatePriceRanges()
    // {
    //    Cache::remember('price_ranges', now()->addHours(24), function () {
    //         // حساب الحد الأدنى والحد الأقصى للسعر في استعلام واحد
    //         $priceData = Product::selectRaw('min(price) as min_price, max(price) as max_price')
    //                             ->first();

    //         $minPrice = $priceData->min_price;
    //         $maxPrice = $priceData->max_price;
    //         $rangeStep = 100;

    //         $minRange = floor($minPrice / $rangeStep) * $rangeStep;
    //         $maxRange = ceil($maxPrice / $rangeStep) * $rangeStep;

    //         // إنشاء النطاقات السعرية بناءً على النطاقات الثابتة
    //         $priceRanges = [];
    //         for ($i = $minRange; $i < $maxRange; $i += $rangeStep) {
    //             $priceRanges[] = [
    //                 'min' => $i,
    //                 'max' => $i + $rangeStep,
    //             ];
    //         }

    //         return $priceRanges;
    //     });
    // }
}
