<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Requests\Product\CreateProductRequest;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view_products|add_products', ['only' => ['index','store']]);
        $this->middleware('permission:add_products', ['only' => ['create','store']]);
        $this->middleware('permission:edit_products', ['only' => ['edit','update']]);
        $this->middleware('permission:delete_products', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['categories'] = Category::get();
        return view('admin.products.index', $data);
    }

    public function datatable(Request $request) 
    {
        $items = Product::query()->orderBy('id', 'DESC')->search($request); 
        return $this->filterDataTable($items, $request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['attributes'] = Attribute::active()->get();
        $data['categories'] = Category::active()->get();
        return view('admin.products.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request)
    {
        try {
            DB::beginTransaction();
    
            // إنشاء المنتج الأساسي
            $product = Product::create([
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
                'slug' => $this->generateSlug($request->name_ar, $request->name_en),
                'type' => !empty($request->variants) ? 'variant' : 'simple',
            ]);
    
            // إضافة الترجمات
            $product->createTranslation([
                'name_ar' => $request->name_ar,
                'name_en' => $request->name_en,
                'short_description_ar' => $request->short_description_ar,
                'short_description_en' => $request->short_description_en,
                'long_description_ar' => $request->long_description_ar,
                'long_description_en' => $request->long_description_en,
            ]);
    
            // إضافة التصنيفات
            $product->categories()->attach($request->categories);
    
             // حفظ الصور
            if (!empty($request->media_repeater)) {
                $product->storeProductImages($product, $request->media_repeater);
            }

            // إدارة المتغيرات
            if ($product->type === 'variant' && !empty($request->variants)) {
                foreach ($request->variants as $variantData) {
                    $variant = $product->variants()->create([
                        'price' => $variantData['price'],
                        'sku' => $variantData['sku'] ?? null,
                    ]);
    
                    // ربط السمات
                    if (!empty($variantData['attribute_values'])) {
                        $attributesToSync = [];
                        foreach ($variantData['attribute_values'] as $attrId => $valueId) {
                            $attributesToSync[] = $valueId;
                        }
                        $variant->attributeValues()->sync($attributesToSync);
                    }
    
                    // إدارة المخزون
                    $variant->inventory()->create([
                        'quantity' => $variantData['quantity'] ?? 0,
                    ]);
                }
            } else {
                // إدارة مخزون المنتج البسيط
                $product->inventory()->create([
                    'quantity' => $request->quantity ?? 0,
                ]);
            }
    
            DB::commit();
            return $this->response_api(200, __('admin.form.added_successfully'), '');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->response_api(500, $this->exMessage($e), '');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['product'] = Product::findOrFail($id);
        $data['attributes'] = Attribute::active()->get();
        $data['categories'] = Category::active()->get();
        return view('admin.products.create', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        try {
            DB::beginTransaction();
    
            // تحديث بيانات المنتج الأساسية
            $product->update([
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
                'slug' => $this->generateSlug($request->name_ar, $request->name_en),
                'type' => !empty($request->variants) ? 'variant' : 'simple',
            ]);
    
            // تحديث الترجمات
            $product->createTranslation([
                'name_ar' => $request->name_ar,
                'name_en' => $request->name_en,
                'short_description_ar' => $request->short_description_ar,
                'short_description_en' => $request->short_description_en,
                'long_description_ar' => $request->long_description_ar,
                'long_description_en' => $request->long_description_en,
            ]);
    
            // تحديث التصنيفات
            $product->categories()->sync($request->categories);
            
            // تعديل الصور
            if (!empty($request->media_repeater)) { 
                $product->updateProductImages($product, $request->media_repeater);
            }

            // إدارة المتغيرات
            if ($product->type === 'variant' && !empty($request->variants)) {
                $existingVariantIds = $product->variants->pluck('id')->toArray();
                $updatedVariantIds = [];
    
                foreach ($request->variants as $variantData) {
                    if (!empty($variantData['id'])) {
                        // تحديث المتغير الموجود
                        $variant = Variant::find($variantData['id']);
                        $variant->update([
                            'price' => $variantData['price'],
                            'sku' => $variantData['sku'] ?? null,
                        ]);
                        $updatedVariantIds[] = $variant->id;
                    } else {
                        // إنشاء متغير جديد
                        $variant = $product->variants()->create([
                            'price' => $variantData['price'],
                            'sku' => $variantData['sku'] ?? null,
                        ]);
                        $updatedVariantIds[] = $variant->id;
                    }
    
                    // ربط السمات
                    if (!empty($variantData['attribute_values'])) {
                        $attributesToSync = [];
                        foreach ($variantData['attribute_values'] as $attrId => $valueId) {
                            $attributesToSync[] = $valueId;
                        }
                        $variant->attributeValues()->sync($attributesToSync);
                    }
    
                    // تحديث المخزون
                    $variant->inventory()->updateOrCreate(
                        ['inventoryable_id' => $variant->id, 'inventoryable_type' => Variant::class],
                        ['quantity' => $variantData['quantity'] ?? 0]
                    );
                }
    
                // حذف المتغيرات غير الموجودة
                $deletedIds = array_diff($existingVariantIds, $updatedVariantIds);
                if (!empty($deletedIds)) {
                    Variant::destroy($deletedIds);
                }
            } else {
                // إدارة مخزون المنتج البسيط
                $product->inventory()->updateOrCreate(
                    ['inventoryable_id' => $product->id, 'inventoryable_type' => Product::class],
                    ['quantity' => $request->quantity ?? 0]
                );
            }
    
            DB::commit();
            return $this->response_api(200, __('admin.form.updated_successfully'), '');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->response_api(400, $this->exMessage($e), '');
        }
    }

    public function activate($id)
    {
        $item = Product::findOrFail($id);
        if (empty($item)) {
            return $this->response_api(400, __('admin.form.not_existed'), '');
        }
        $item->status = 1 - $item->status;
        $item->save();
        return $this->response_api(200,  __('admin.form.status_changed_successfully'), '');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->type === 'normal') {
            // حذف المخزون المرتبط
            $product->inventory()->delete();
        } else {
            // حذف المتغيرات ومخزونها
            foreach ($product->variants as $variant) {
                $variant->inventory()->delete();
                $variant->attributeValues()->detach();
                $variant->delete();
            }
        }
    
        $product->delete();
        return $this->response_api(200, __('admin.form.deleted_successfully'), '');
    }


    public function bluckDestroy(Request $request) 
    {
        $ids = $request->id;
        foreach ($ids as $row) {
            $item = Product::find($row);
            if(!$item) {
                return $this->response_api(404 ,  __('admin.form.not_existed') , '');
            }
            $item->delete();
        }
        return $this->response_api(200 ,  __('admin.form.deleted_successfully') , '');
    }


}
