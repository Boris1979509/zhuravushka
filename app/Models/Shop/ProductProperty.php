<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ProductProperties
 * @package App\Models\Shop
 * @property integer $id
 * @property string $title
 * @property string $slug
 */
class ProductProperty extends Model
{
    use softDeletes;
    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
    ];
    /**
     * @return HasMany
     */
    public function properties()
    {
        return $this->hasMany(ProductAttribute::class, 'product_property_id');
    }
}
