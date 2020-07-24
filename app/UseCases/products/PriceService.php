<?php

namespace App\UseCases\products;

use App\Models\Shop\Product;
use Illuminate\Database\Eloquent\Collection;

class PriceService
{
    /**
     * Percent
     */
    public const PERCENT = 5; // 5 %

    /**
     * @param $price
     * @return mixed
     */
    public function subtractPercent($price)
    {
        if ($price instanceof Collection) {
            $percent = self::PERCENT;
            $price->each(function ($item) {
                $item->old_price = $this->math($item->price);
            });
            return $price;
        }
        return $this->math($price);
    }

    /**
     * @param int $price
     * @return float|null
     */
    private function math($price)
    {
        if ($price) {
            return round($price - ($price * (self::PERCENT / 100)));
        }
        return null;
    }
}
