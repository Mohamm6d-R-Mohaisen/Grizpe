<?php

namespace Database\Seeders;

use App\Models\AttributeValue;
use App\Models\AttributeValueTranslation;
use Illuminate\Database\Seeder;

class AttributeValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $attribute_values = [
            [
                'attribute_id' => 1,
                // 'attribute_value_id' => 1,
                'slug' => '2022',
                'name_ar' => '2022',
                'name_en' => '2022',
                'description_ar' => '',
                'description_en' => '',
            ],
            [
                'attribute_id' => 1,
                // 'attribute_value_id' => 2,
                'slug' => '2023',
                'name_ar' => '2023',
                'name_en' => '2023',
                'description_ar' => '',
                'description_en' => '',
            ],
            [
                'attribute_id' => 1,
                // 'attribute_value_id' => 3,
                'slug' => '2024',
                'name_ar' => '2024',
                'name_en' => '2024',
                'description_ar' => '',
                'description_en' => '',
            ],
            [
                'attribute_id' => 2,
                // 'attribute_value_id' => 4,
                'slug' => '64',
                'name_ar' => '64',
                'name_en' => '64',
                'description_ar' => '',
                'description_en' => '',
            ],
            [
                'attribute_id' => 2,
                // 'attribute_value_id' => 5,
                'slug' => '128',
                'name_ar' => '128',
                'name_en' => '128',
                'description_ar' => '',
                'description_en' => '',
            ],
            [
                'attribute_id' => 2,
                // 'attribute_value_id' => 2,
                'slug' => '256',
                'name_ar' => '256',
                'name_en' => '256',
                'description_ar' => '',
                'description_en' => '',
            ],
            [
                'attribute_id' => 2,
                // 'attribute_value_id' => 3,
                'slug' => '512',
                'name_ar' => '512',
                'name_en' => '512',
                'description_ar' => '',
                'description_en' => '',
            ],
            [
                'attribute_id' => 3,
                // 'attribute_value_id' => 3,
                'slug' => 'new',
                'name_ar' => 'New',
                'name_en' => 'New',
                'description_ar' => 'Brand New Device Fully sealed in original retail packaging Box still wrapped in original factory plastic wrap Box has NEVER been opened and has NEVER been resealed Packaging is not torn or falling apart and plastic film still on the device',
                'description_en' => 'Brand New Device Fully sealed in original retail packaging Box still wrapped in original factory plastic wrap Box has NEVER been opened and has NEVER been resealed Packaging is not torn or falling apart and plastic film still on the device',
            ],
            [
                'attribute_id' => 3,
                // 'attribute_value_id' => 3,
                'slug' => 'like-new',
                'name_ar' => 'Like New',
                'name_en' => 'Like New',
                'description_ar' => 'Minimal Usage Device Device has been used for less than 30 days No scratches or marks on any surface All original accessories are included and unused Original packaging is in perfect condition',
                'description_en' => 'Minimal Usage Device Device has been used for less than 30 days No scratches or marks on any surface All original accessories are included and unused Original packaging is in perfect condition',
            ],
            [
                'attribute_id' => 3,
                // 'attribute_value_id' => 3,
                'slug' => 'poor',
                'name_ar' => 'Poor',
                'name_en' => 'Poor',
                'description_ar' => 'Visible Wear Device Device shows signs of regular use May have minor scratches or wear marks All functions work properly Original accessories may show signs of use',
                'description_en' => 'Visible Wear Device Device shows signs of regular use May have minor scratches or wear marks All functions work properly Original accessories may show signs of use',
            ],
            [
                'attribute_id' => 3,
                // 'attribute_value_id' => 3,
                'slug' => 'broken',
                'name_ar' => 'Broken',
                'name_en' => 'Broken',
                'description_ar' => 'Non-Functional Device Device has significant physical damage One or more functions are not working properly May require professional repair Sold as-is with no warranty',
                'description_en' => 'Non-Functional Device Device has significant physical damage One or more functions are not working properly May require professional repair Sold as-is with no warranty',
            ],
        ];

        foreach ($attribute_values as $attribute_value) {
            $this->seedAttributeValue($attribute_value);
        }
    }

    public static function seedAttributeValue($attribute_value) 
    {
        $new_attribute_value = AttributeValue::create([
            'slug' => $attribute_value['slug'],
            'attribute_id' => $attribute_value['attribute_id'],
        ]);
        foreach (['ar','en'] as $key) {
            AttributeValueTranslation::create([
                'attribute_value_id' => $new_attribute_value->id,
                'name' => $attribute_value['name_' . $key],
                'description' => $attribute_value['description_' . $key],
                'locale' => $key,
            ]);
        }
        return true;
    }
}

