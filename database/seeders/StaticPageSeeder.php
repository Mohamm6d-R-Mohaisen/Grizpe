<?php

namespace Database\Seeders;

use App\Models\StaticPage;
use App\Models\StaticPageTranslation;
use Illuminate\Database\Seeder;

class StaticPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $static_pages = [
            [
                'id' => 1,
                'static_page_id' => 1,
                'status' => 1,
                'slug' => 'privacy-policy',
                'title_ar' => 'سياسة الخصوصية',
                'title_en' => 'Privacy Policy',
                'content_ar' => 'لوريم اسبازوم',
                'content_en' => 'Loream ispazom',
            ],
            [
                'id' => 2,
                'static_page_id' => 2,
                'status' => 1,
                'slug' => 'terms-service',
                'title_ar' => 'شروط الخدمة',
                'title_en' => 'Terms Service',
                'content_ar' => 'لوريم اسبازوم',
                'content_en' => 'Loream ispazom',
            ],
            [
                'id' => 3,
                'static_page_id' => 3,
                'status' => 1,
                'slug' => 'return-plicy',
                'title_ar' => 'سياسية الاسترجاع',
                'title_en' => 'Return plicy',
                'content_ar' => 'لوريم اسبازوم',
                'content_en' => 'Loream ispazom',
            ],
            [
                'id' => 4,
                'static_page_id' => 4,
                'status' => 1,
                'slug' => 'delivery',
                'title_ar' => 'معلومات التوصيل',
                'title_en' => 'Delivery',
                'content_ar' => 'لوريم اسبازوم',
                'content_en' => 'Loream ispazom',
            ],
        ];

        foreach ($static_pages as $static_page) {
            $this->seedStaticPage($static_page);
        }
    }

    public static function seedStaticPage($static_page) 
    {
        foreach (['ar','en'] as $key) {
            $new_static_page = StaticPage::firstOrCreate([
                'id' => $static_page['id'],
                'slug' => $static_page['slug'],
                'status' => $static_page['status']
            ]);
            StaticPageTranslation::firstOrCreate([
                'static_page_id' => $new_static_page->id,
                'title' => $static_page['title_' . $key],
                'content' => $static_page['content_' . $key],
                'locale' => $key,
            ]);
        }
        return true;
    }
}
