<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use XMLReader;

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

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $file = $this->getFileName(); // get file
        $xml = new XMLReader();
        $xml->open($file);
        while ($xml->read()) {

            if ($this->isStartProduct($xml)) {

                $data = $this->getData($xml);

                dd($data);

            }
        }

//        return 0;

        $this->info('Successfully parsed.');
        return true;
    }

    private function getFileName()
    {
        $file = $this->argument('file');
        return storage_path('app/1C/' . $file);
    }

    private function isStartProduct($xml): bool
    {
        return $xml->name === 'v8:CatalogObject.Номенклатура' && $xml->nodeType === XMLReader::ELEMENT;
    }

    const FIELDS_MAP = [
        'v8:НаименованиеПолное' => 'name',
        'v8:СтавкаНДС' => 'NDS'
    ];

    private function getData($xml): array
    {
        $data = [];

        while ($xml->read()) {

            if ($xml->name === 'v8:CatalogObject.Номенклатура' && $xml->nodeType === XMLReader::END_ELEMENT) {

                return $data;
            }

            if (array_key_exists($xml->name, self::FIELDS_MAP) && $xml->nodeType == XMLReader::ELEMENT) {

                $data[self::FIELDS_MAP[$xml->name]] = $xml->readString();
            }
        }

        return $data;
    }
}
