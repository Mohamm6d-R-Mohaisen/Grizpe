<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\CategoryTranslation;
use App\Models\PaymentWay;
use App\Models\PaymentWayTranslation;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'id' => 1,
                'category_id' => 1,
                'slug' => 'mac',
                // 'level' => 1,
                'status' => 1,
                'name_ar' => 'Mac',
                'name_en' => 'Mac',
                'description_ar' => 'لوريم اسبازوم',
                'description_en' => 'Loream ispazom',
            ],
            [
                'id' => 2,
                'category_id' => 2,
                'slug' => 'iPhone',
                // 'level' => 1,
                'status' => 1,
                'name_ar' => 'iPhone',
                'name_en' => 'iPhone',
                'description_ar' => 'لوريم اسبازوم',
                'description_en' => 'Loream ispazom',
            ],
            [
                'id' => 3,
                'category_id' => 3,
                'slug' => 'iPad',
                // 'level' => 1,
                'status' => 1,
                'name_ar' => 'iPad',
                'name_en' => 'iPad',
                'description_ar' => 'لوريم اسبازوم',
                'description_en' => 'Loream ispazom',
            ],
        ];

        foreach ($categories as $category) {
            $this->seedCategory($category);
        }
    }

    public static function seedCategory($category) 
    {
        foreach (['ar','en'] as $key) {
            $new_category = Category::firstOrCreate([
                'id' => $category['id'],
                'slug' => $category['slug'],
                // 'level' => $category['level'],
                'status' => $category['status']
            ]);
            CategoryTranslation::firstOrCreate([
                'category_id' => $new_category->id,
                'name' => $category['name_' . $key],
                'description' => $category['description_' . $key],
                'locale' => $key,
            ]);
        }
        return true;
    }
}
