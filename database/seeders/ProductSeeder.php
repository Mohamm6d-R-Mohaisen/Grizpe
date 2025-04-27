<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Inventory;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    // public function run()
    // {
    //     // جلب الفئات والسمات مرة واحدة لتسريع العملية
    //     $categories = Category::all();
    //     $attributes = Attribute::all();

    //     // مصفوفة لتخزين البيانات التي سيتم إضافتها في كل دفعة
    //     $products = [];

    //     // نحدد عدد السجلات التي سيتم إضافتها
    //     $totalRecords = 10000;

    //     // إضافة المنتجات دفعة واحدة
    //     for ($i = 0; $i < $totalRecords; $i++) {
    //         $product = [
    //             'sku' => fake()->unique()->numerify('SKU-#####'),
    //             'slug' => fake()->slug(),
    //             'price' => fake()->randomFloat(2, 10, 100),
    //             'meta_title' => fake()->sentence(),
    //             'meta_description' => fake()->paragraph(),
    //             'created_at' => now(),
    //             'updated_at' => now(),
    //         ];

    //         // إضافة الترجمات
    //         $translations = [
    //            'en' => [
    //                 'name' => fake()->words(3, true),
    //                 'short_description' => fake()->sentence(),
    //                 'long_description' => fake()->paragraph(),
    //             ],
    //             'ar' => [
    //                 'name' => fake()->words(2, true),
    //                 'short_description' => 'وصف قصير للمنتج',
    //                 'long_description' => 'وصف طويل للمنتج باللغة العربية.',
    //             ],
    //         ];

    //         // حفظ الترجمات
    //         $productData = Product::create($product);
    //         foreach ($translations as $locale => $data) {
    //             $productData->translateOrNew($locale)->fill($data);
    //         }

    //         // ربط المنتج بالفئات بشكل عشوائي
    //         $productData->categories()->attach(
    //             $categories->random(rand(1, 3))->pluck('id')->toArray()
    //         );

    //         // ربط المنتج بالسمات بشكل عشوائي
    //         foreach ($attributes as $attribute) {
    //             $productData->attributes()->attach($attribute->id, ['attribute_value_id' => rand(1, 4)]);
    //         }

    //         // إضافة المخزون للمنتج
    //         Inventory::create([
    //             'product_id' => $productData->id,
    //             'quantity' => 5
    //         ]);

    //         // تخزين المنتج في المصفوفة
    //         $products[] = $productData;

    //         // إذا وصلت المصفوفة إلى 1000 منتج، نقوم بإدخالها دفعة واحدة
    //         if (count($products) >= 1000) {
    //             Product::insert(array_map(function($product) {
    //                 return $product->toArray();
    //             }, $products)); // إدخال دفعة واحدة في قاعدة البيانات
    //             $products = []; // تفريغ المصفوفة
    //         }
    //     }

    //     // التأكد من إضافة أي منتجات متبقية
    //     // if (count($products) > 0) {
    //     //     Product::insert(array_map(function($product) {
    //     //         return $product->toArray();
    //     //     }, $products));
    //     // }
    // }

    public function run()
    {

        $categories = Category::get();
        // $attributes = Attribute::get();
        $conditionAttribute = Attribute::where('slug', 'condition')->firstOrFail();
        $conditionValues = $conditionAttribute->attributeValues()->pluck('id');

        Product::factory(20)->create()->each(function ($product) use ($categories, $conditionAttribute, $conditionValues) {
            $translations = [
                'en' => [
                    'name' => fake()->words(3, true),
                    'short_description' => fake()->sentence(),
                    'long_description' => fake()->paragraph(),
                ],
                'ar' => [
                    'name' => fake()->words(2, true),
                    'short_description' => 'وصف قصير للمنتج',
                    'long_description' => 'وصف طويل للمنتج باللغة العربية.',
                ],
            ];
            
            foreach ($translations as $locale => $data) {
                $product->translateOrNew($locale)->fill($data);
            }
        
            $product->categories()->attach(
                $categories->random(rand(1, 3))->pluck('id')->toArray()
            );
        
            // إنشاء variant لكل قيمة من قيم ال condition
            foreach ($conditionValues as $valueId) {
                $variant = $product->variants()->create([
                    'sku' => 'PRD-' . $product->id . '-CND-' . $valueId,
                    'price' => fake()->randomFloat(2, 10, 200),
                ]);

                // إضافة سمة ال condition مع قيمتها
                $variant->attributeValues()->attach($conditionAttribute->id, [
                    'attribute_value_id' => $valueId
                ]);

                // إضافة سمات أخرى عشوائية
                $otherAttributes = Attribute::where('id', '!=', $conditionAttribute->id)
                    ->inRandomOrder()
                    ->take(rand(1, 2))
                    ->get();

                foreach ($otherAttributes as $attribute) {
                    $randomValue = $attribute->attributeValues()->inRandomOrder()->first()->id;
                    $variant->attributeValues()->attach($attribute->id, [
                        'attribute_value_id' => $randomValue
                    ]);
                }

                // إنشاء مخزون لل variant
                $variant->inventory()->create(['quantity' => rand(5, 25)]);
            }

            // حفظ التعديلات
            $product->save();
        });
    }
}
