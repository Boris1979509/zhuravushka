<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Shop\ShopCategory;

class ShopCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        $shopCategory = [
            ['title' => 'Отделочные материалы',],
            ['title' => 'Строительные материалы',],
            ['title' => 'Сантехника, отопление и водоснабжение',],
            ['title' => 'Плитка и керамогранит',],
            ['title' => 'Инструмент и оборудование',],
            ['title' => 'Электрика и освещение',],
            ['title' => 'Кровля и фасад',],
            ['title' => 'Крепежи и метизы',],
            ['title' => 'Все для дома и дачи',],
            ['title' => 'Сезонные предложения',],
        ];
        foreach ($shopCategory as $key => $value) {
            $data[$key]['title'] = $value['title'];
            $data[$key]['slug'] = Str::slug($value['title']);
            $data[$key]['parent_id'] = 0;
        }
        //ShopCategory::create($data);
        app(ShopCategory::class)->insert($data);
        //DB::table('shop_categories')->insert($data);
    }
}
