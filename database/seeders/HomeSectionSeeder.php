<?php

namespace Database\Seeders;

use App\Models\HomeSection;
use App\Models\HomeSectionItem;
use App\Models\HomeSectionTranslation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HomeSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();

        try {
            $sections = [
                [
                    'type' => 'slider',
                    'status' => 1,
                    'translations' => [
                        'name_ar' => 'شريط تمرير',
                        'name_en' => 'Slider',
                        'description_ar' => 'هذا قسم الشريط التمرير.',
                        'description_en' => 'This is the slider section.',
                    ],
                    'items' => [
                        [
                            'link' => '#',
                            'order' => 1,
                            'image' => 'frontend_assets/assets/img/1-removebg-preview (1) 1.png',
                            'name_ar' => 'شريحة 1',
                            'name_en' => 'Slide 1',
                            'description_ar' => 'وصف شريحة 1.',
                            'description_en' => 'Description of slide 1.',
                        ],
                        [
                            'link' => '#',
                            'order' => 2,
                            'image' => 'frontend_assets/assets/img/__لقطة_الشاشة__264_-removebg-preview 1.png',
                            'name_ar' => 'شريحة 2',
                            'name_en' => 'Slide 2',
                            'description_ar' => 'وصف شريحة 2.',
                            'description_en' => 'Description of slide 2.',
                        ],

                    ],
                ],
                [
                    'type' => 'static_image',
                    'status' => 1,
                    'translations' => [
                        'name_ar' => 'اجعل مظهرك أكثر جمالا!',
                        'name_en' => 'Static Image',
                        'description_ar' => 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها.',
                        'description_en' => 'This is the static image section.',
                    ],
                    'items' => [
                        [
                            'link' => '/shop',
                            'order' => 1,
                            'image' => 'frontend_assets/assets/images/indextpo.png',
                            'name_ar' => 'عنصر 1',
                            'name_en' => 'Item 1',
                            'description_ar' => 'وصف العنصر 1.',
                            'description_en' => 'Description of item 1.',
                        ],
                    ],
                ],
                [
                    'type' => 'services',
                    'status' => 1,
                    'translations' => [
                        'name_ar' => 'الخدمات',
                        'name_en' => 'Services',
                        'description_ar' => 'هذا قسم الخدمات.',
                        'description_en' => 'This is the services section.',
                    ],
                    'items' => [
                        [
                            'link' => 'https://example.com/service1',
                            'order' => 1,
                            'image' => 'frontend_assets/assets/images/Quality.svg',
                            'name_ar' => 'خدمة 1',
                            'name_en' => 'Service 1',
                            'description_ar' => 'وصف الخدمة 1.',
                            'description_en' => 'Description of service 1.',
                        ],
                        [
                            'link' => 'https://example.com/service2',
                            'order' => 2,
                            'image' => 'frontend_assets/assets/images/Delivery.svg',
                            'name_ar' => 'خدمة 2',
                            'name_en' => 'Service 2',
                            'description_ar' => 'وصف الخدمة 2.',
                            'description_en' => 'Description of service 2.',
                        ],
                        [
                            'link' => 'https://example.com/service2',
                            'order' => 2,
                            'image' => 'frontend_assets/assets/images/3.svg',
                            'name_ar' => 'خدمة 2',
                            'name_en' => 'Service 2',
                            'description_ar' => 'وصف الخدمة 2.',
                            'description_en' => 'Description of service 2.',
                        ],
                        [
                            'link' => 'https://example.com/service2',
                            'order' => 2,
                            'image' => 'frontend_assets/assets/images/4.svg',
                            'name_ar' => 'خدمة 2',
                            'name_en' => 'Service 2',
                            'description_ar' => 'وصف الخدمة 2.',
                            'description_en' => 'Description of service 2.',
                        ],
                    ],
                ],
            ];

            foreach ($sections as $sectionData) {
                // Create main section
                $home_section = HomeSection::create([
                    'type' => $sectionData['type'],
                    'status' => $sectionData['status'],
                ]);

                // Create translations for the main section
                $home_section->createTranslation($sectionData['translations']);

                // Create section items
                foreach ($sectionData['items'] as $key => $item) {
                    $section_item = HomeSectionItem::create([
                        'home_section_id' => $home_section->id,
                        'link' => $item['link'],
                        'order' => $item['order'],
                        'image' => $item['image'],
                    ]);

                    $section_item->createTranslation([
                        'name_ar' => $item['name_ar'],
                        'name_en' => $item['name_en'],
                        'description_ar' => $item['description_ar'],
                        'description_en' => $item['description_en'],
                    ]);
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
