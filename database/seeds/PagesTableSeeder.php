<?php

use Illuminate\Database\Seeder;
use App\Models\Shop\Page;
use Illuminate\Support\Str;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $pages = [
            ['title' => 'О компании'],
            ['title' => 'Советы'],
            ['title' => 'Услуги'],
            ['title' => 'Контакты'],
            ['title' => 'Поставщики'],
            ['title' => 'Реквизиты'],
        ];
        $data = [];
        foreach ($pages as $key => $value) {
            $data[$key]['title'] = $value['title'];
            $data[$key]['slug'] = Str::slug($value['title']);
        }
        app(Page::class)->insert($data);
    }
}
