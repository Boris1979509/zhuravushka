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
 * @property string $user_data
 * @property string $comment
 * @property integer $user_id
 * @property BelongsToMany $products
 */
class Order extends Model
{

    /**
     * @param array $data
     * @param int $id
     * @return bool
     */
    public static function updateOrder(array $data, int $id): bool
    {
        return static::where('id', $id)
            ->where('order_status', 0)
            ->update($data);
    }

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

    /**
     * Create number order
     * @return string
     */
    public function getOrderNumber()
    {
        return '№' . str_pad($this->id, 8, "0", STR_PAD_LEFT);
    }
}
