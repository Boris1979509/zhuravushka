<?php

namespace App\Console\Commands;

use App\Models\Shop\ProductCategory;
use Carbon\Carbon;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ParseCatalog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'catalog:parse {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Catalog parsing.';

    public const FIELDS_MAP = [
        ['name' => 'ГруппаКатегории'],
        ['name' => 'Категория'],
    ];

    public function handle(): bool
    {

        $path = $this->getFileName(); // get file path
        $catalog = json_decode(file_get_contents($path), true);

        $data = [];
        foreach ($catalog as $catalogItem) {
            $data[$catalogItem[self::FIELDS_MAP[0]['name']]] = [
                'title'     => $name = $catalogItem[self::FIELDS_MAP[0]['name']],
                'slug'      => Str::slug($name),
                'parent_id' => 0,
            ];
        }

        $result = DB::table('product_categories')->insert($this->arrayDefaultKey($data));
        if ($result) {
            $data = [];
            $categories = ProductCategory::all();
            foreach ($categories as $categoryItem) {
                foreach ($catalog as $catalogItem) {
                    if ($categoryItem->title === $catalogItem[self::FIELDS_MAP[0]['name']]) {
                        $data[$catalogItem[self::FIELDS_MAP[1]['name']]] = [
                            'title'     => $name = $catalogItem[self::FIELDS_MAP[1]['name']],
                            'slug'      => Str::slug($name),
                            'parent_id' => $categoryItem->id,
                        ];
                    }
                }
            }
            $result = DB::table('product_categories')->insert($this->arrayDefaultKey($data));
            if ($result) {
                $categories = ProductCategory::all();
                foreach ($catalog as $key => $catalogItem) {
                    foreach ($categories as $categoryItem) {
                        if ($categoryItem->title === $catalogItem[self::FIELDS_MAP[1]['name']]) {
                            DB::table('Products')->insert([
                                'title'                     => $name = $catalogItem['Товар'],
                                'slug'                      => Str::slug($name),
                                'code'                      => $code = trim($catalogItem['Код']),
                                'photo'                     => $code,
                                'article'                   => $catalogItem['Артикул'],
                                'quantity'                  => $catalogItem['КоличествоОстаток'],
                                'price'                     => $catalogItem['Цена'],
                                'description'               => $catalogItem['Описание'],
                                'category_id'               => $categoryItem->id,
                                'unit_pricing_base_measure' => $catalogItem['ЕдИзмерения'],
                                'created_at'                => Carbon::now(),
                                'updated_at'                => Carbon::now(),
                            ]);
                        }
                    }
                }

                $this->info('Successfully parsed.');
                return true;
            }
        }
    }

    /**
     * @return string
     */
    private function getFileName(): string
    {
        $file = $this->argument('file');
        return storage_path('app/catalog/' . $file);
    }

    /**
     * @param $array
     * @return array
     */
    private function arrayDefaultKey($array): array
    {
        $arrayTemp = [];
        $i = 0;
        foreach ($array as $key => $val) {
            $arrayTemp[$i] = $val;
            $i++;
        }
        return $arrayTemp;
    }
}
