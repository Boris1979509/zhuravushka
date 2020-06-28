<?php

namespace App\Console\Commands;

use App\Models\Shop\ProductCategory;
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
            DB::table('product_categories')->insert($this->arrayDefaultKey($data));
        }

        $this->info('Successfully parsed.');
        return true;
    }

    /**
     * @return string
     */
    private function getFileName(): string
    {
        $file = $this->argument('file');
        return storage_path('app/Catalog/' . $file);
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
