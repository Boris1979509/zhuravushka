<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Product
 * @package App\Models\Shop
 * @property integer $id
 * @property string $title
 * @property string $code
 * @property float $price
 * @property string $photo
 * @property string $photo_thumb
 * @property integer $category_id
 * @property string $description
 * @property BelongsToMany $pivot
 */
class Product extends Model
{
    use softDeletes;
    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'code',
        'price',
        'photo',
        'photo_thumb',
        'description',
        'category_id',
    ];

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function getItemTotalSum()
    {
        if (!is_null($this->pivot)) {
            return $this->pivot->count * $this->price;
        }
    }
}
