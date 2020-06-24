<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Order
 * @package App\Models\Shop
 * @property  integer $id
 * @property integer $order_status
 * @property string $name
 * @property string $phone
 * @property string $user_data
 * @property string $comment
 * @property integer $user_id
 * @property BelongsToMany $products
 */
class Order extends Model
{

    /**
     * @return belongsToMany
     */
    public function products(): belongsToMany
    {
        return $this->belongsToMany(Product::class)
            ->withPivot('count')->withTimestamps();
    }

    /**
     * @return int| float
     */
    public function getTotalSum()
    {
        $total = 0;
        /** @var Product $item */
        foreach ($this->products as $item) {
            $total += $item->getItemTotalSum();
        }
        return number_format(round($total), 0, '', ' ');
    }
    /**
     * @return int
     */
    public function cartCount(): int
    {
        return $this->products()->count();
    }
}
