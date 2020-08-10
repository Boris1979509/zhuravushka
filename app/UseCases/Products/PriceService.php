<?php

namespace App\UseCases\Products;

use Illuminate\Database\Eloquent\Collection;

class PriceService
{
    /**
     * Percent
     */
    public const PERCENT = 15; // %

    /**
     * @param $price
     * @return mixed
     */
    public function subtractPercent($price)
    {
        if ($price instanceof Collection) {
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
    private function math($price): ?float
    {
        if ($price) {
            return round($price + ($price * (self::PERCENT / 100)));
        }
        return null;
    }
}
