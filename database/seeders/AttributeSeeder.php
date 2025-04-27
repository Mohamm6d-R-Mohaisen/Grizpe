<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\AttributeTranslation;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $attributes = [
            [
                'id' => 1,
                'attribute_id' => 1,
                'slug' => 'year',
                'name_ar' => 'السنة',
                'name_en' => 'Year',
            ],
            [
                'id' => 2,
                'attribute_id' => 2,
                'slug' => 'memory_size',
                'name_ar' => 'السعة التخزينية',
                'name_en' => 'Memory Size',
            ],
            [
                'id' => 3,
                'attribute_id' => 3,
                'slug' => 'condition',
                'name_ar' => 'الحالة',
                'name_en' => 'Condition',
            ],
        ];

        foreach ($attributes as $attribute) {
            $this->seedAttribute($attribute);
        }
    }

    public static function seedAttribute($attribute) 
    {
        $new_attribute = Attribute::firstOrCreate([
            'slug' => $attribute['slug'],
            'id' => $attribute['id'],
        ]);
        foreach (['ar','en'] as $key) {
            AttributeTranslation::firstOrCreate([
                'attribute_id' => $new_attribute->id,
                'name' => $attribute['name_' . $key],
                'locale' => $key,
            ]);
        }
        return true;
    }
}

