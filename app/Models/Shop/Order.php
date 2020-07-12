<?php

namespace App\Models\Shop;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
     * @return string
     */
    public function getTotalSum(): string
    {
        $total = 0;
        /** @var Product $item */
        foreach ($this->products as $item) {
            $total += $item->getItemTotalSum();
        }
        return $total;
    }

    /**
     * @return int
     */
    public function cartCount(): int
    {
        return $this->products()->count();
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
