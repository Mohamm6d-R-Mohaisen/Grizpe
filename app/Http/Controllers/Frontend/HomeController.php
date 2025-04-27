<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Bloge;
use App\Models\Category;
use App\Models\Galary;
use App\Models\HomeSection;
use App\Models\Order;
use App\Models\Product;
use App\Models\Question;
use App\Models\Review;
use App\Models\Service;
use App\Models\Slider;
use App\Models\Variant;
use App\Models\Work;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
//        $data['categories'] = Category::active()->get();
        $data['sliders_home']= Slider::withTranslation()
            ->whereHas('translations', function ($query) {
                $query->where('type', 'home');
            })
            ->first();
        $data['galarys_home'] = Galary::where('type', 'home')
            ->where('sub_type', 'slider')
            ->get();
       $data['slider_about']=Slider::withTranslation()
            ->whereHas('translations', function ($query) {
                $query->where('type', 'about');
            })
            ->first();
        $data['galarys_about'] = Galary::where('type', 'about')
            ->where('sub_type', 'slider')->limit(2)
            ->get();
        $data['services']=Service::active()->limit(4)->get();
        $data['works']=Work::active()->with('service')->limit(6)->get();
        $data['reviews']=Review::active()->get();
        $data['questions']=Question::where('type','home')->get();
        $data['blogs']=Bloge::active()->with('category')->limit(3)->get();
        $data['galarys_home_footer'] = Galary::where('type', 'home')
            ->where('sub_type', 'footer')->limit(2)
            ->get();

        return view('frontend.home',$data);
    }



    public function show(Category $category)
    {
        $categories = Category::active()->get();

        // $products = Product::active()->whereRelation('categories', 'id', $category->id)->get();

        return view('frontend.category', compact('category', 'categories'));
    }

    // عرض المنتجات الخاصة بتصنيف معين
    public function showProducts($categoryId)
    {
        $products = Product::active()->whereRelation('categories', 'id', $categoryId)->get();
        return response()->json($products);
    }

    // عرض تفاصيل المنتج
    public function showProductDetails($productId)
    {
        $product = Product::with('variants')->find($productId);
        return response()->json($product);
    }

    public function getAllCategories()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

     /**
     * استرجاع المنتجات الخاصة بتصنيف معين
     */
    public function getProductsByCategory($categoryId)
    {
        $products = Product::active()->whereRelation('categories', 'id', $categoryId)->get();
        return response()->json($products);
    }

    /**
     * استرجاع الخصائص (variant attributes) الخاصة بمنتج معين
     */
    public function getProductVariants($productId)
    {
        $product = Product::with('variants')->findOrFail($productId);
        return response()->json($product->variants);
    }

    public function getProductDetails($productId)
    {
        $product = Product::findOrFail($productId);
        // على سبيل المثال، إذا كان لديك علاقات أو أعمدة تخزن السنوات والذاكرة:
        $years = $product->available_years;
        $memories = $product->available_memories;

        return response()->json([
            'years' => $years,
            'memories' => $memories,
        ]);
    }

    public function getMemorySizeByYear($product_id, $year)
    {
        // البحث عن قيمة السمة year المطابقة للسنة المحددة
        $YearAttribute = Attribute::where('slug', 'year')->first();
        $yearValue = AttributeValue::where('attribute_id', $YearAttribute->id)
                                   ->where('slug', $year)
                                   ->first();

        if (!$yearValue) {
            return response()->json(['error' => 'Invalid year selected'], 404);
        }

        // الحصول على الـ Variant الذي يحتوي على هذه السنة للمنتج المحدد
        $variant = Variant::where('product_id', $product_id)
                          ->whereHas('attributeValues', function($query) use ($yearValue) {
                              $query->where('attribute_value_id', $yearValue->id);
                          })
                          ->first();

        if (!$variant) {
            return response()->json(['error' => 'No variant found for this year'], 404);
        }

        // البحث عن قيمة الـ 'memory_size' لنفس الـ Variant
        $memoryAttribute = Attribute::where('slug', 'memory_size')->first();
        $memoryValues = $variant->attributeValues()
                               ->where('attribute_id', $memoryAttribute->id)
                               ->get()->pluck('name');

        if ($memoryValues) {
            return response()->json(['memories' => $memoryValues]);
        } else {
            return response()->json(['error' => 'Memory size not found'], 404);
        }
    }

    public function getConditionByMemorySize($product_id, $memory)
    {
        // البحث عن قيمة السمة memory_size المطابقة لحجم الذاكرة المحدد
        $memoryAttribute = Attribute::where('slug', 'memory_size')->first();
        $memoryValue = AttributeValue::where('attribute_id', $memoryAttribute->id)
                                     ->where('slug', $memory)
                                     ->first();

        if (!$memoryValue) {
            return response()->json(['error' => 'حجم الذاكرة المحدد غير صالح'], 404);
        }

        // الحصول على الـ Variant الذي يحتوي على حجم الذاكرة المحدد للمنتج
        $variant = Variant::where('product_id', $product_id)
                          ->whereHas('attributeValues', function($query) use ($memoryValue) {
                              $query->where('attribute_value_id', $memoryValue->id);
                          })
                          ->first();

        if (!$variant) {
            return response()->json(['error' => 'لا يوجد منتج بحجم الذاكرة المحدد'], 404);
        }

        // البحث عن قيمة السمة condition لنفس الـ Variant
        $conditionAttribute = Attribute::where('slug', 'condition')->first();
        if (!$conditionAttribute) {
            return response()->json(['error' => 'لا يوجد حالات لهذه المواصفات'], 404);
        }

        $memoryValues = $variant->attributeValues()
                               ->where('attribute_id', $conditionAttribute->id)
                               ->get()->map(function ($value) {
                                   return [
                                       'name' => $value->name,
                                       'description' => html_entity_decode(strip_tags($value->description)),
                                   ];
                               });

        if ($memoryValues) {
            return response()->json(['conditions' => $memoryValues]);
        } else {
            return response()->json(['error' => 'لم يتم العثور على الحالة'], 404);
        }
    }

    public function calculatePrice(Request $request)
    {
        $product = Product::find($request->product_id);

        $selectedYear = $request->input('year');
        $selectedStorage = $request->input('memory');
        $selectedCondition = $request->input('condition');

        // $variant = $product->variants()
        // ->whereHas('attributeValues', function ($query) use ($selectedYear, $selectedStorage, $selectedCondition) {
        //     $query->whereIn('slug', [$selectedYear, $selectedStorage, $selectedCondition])
        //         ->whereHas('attribute', function ($q) {
        //             $q->whereIn('slug', ['year', 'memory_size', 'condition']);
        //         });
        // }, '=', 3)
        // ->first();

        $variant = Variant::where('product_id', $request->product_id)->whereHas('attributeValues', function ($query) use ($selectedYear,$selectedStorage,$selectedCondition) {
            $query->whereIn('slug', [$selectedYear, $selectedStorage, $selectedCondition]);
        })
        ->first();

        return response()->json(['price' => $variant->price]);
    }

    public function getCitiesByState($state)
    {
        $cities = $this->getCitiesForState($state);

        return response()->json(['cities' => $cities]);
    }

    private function getCitiesForState($state)
    {
        $statesCities = [
            'Alabama' => ['Birmingham', 'Montgomery', 'Mobile'],
            'Alaska' => ['Anchorage', 'Fairbanks', 'Juneau'],
            'Arizona' => ['Phoenix', 'Tucson', 'Mesa'],
            'Arkansas' => ['Little Rock', 'Fort Smith', 'Fayetteville'],
            'California' => ['Los Angeles', 'San Francisco', 'San Diego'],
            'Colorado' => ['Denver', 'Colorado Springs', 'Aurora'],

        ];

        return $statesCities[$state] ?? [];
    }

    public function search(Request $request)
    {
        $query = Product::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereTranslationLike('name', "%{$search}%")
                ->orWhereTranslationLike('short_description', "%{$search}%");
            });
        }

        return $query->with('images')->paginate(10);
    }
}
