<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ProductPropertyValue
 * @package App\Models\Shop
 * @property string $title
 * @property string $slug
 * @property integer $property_id
 * @property integer $category_id
 */
class ProductPropertyValue extends Model
{
    use softDeletes;
    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'property_id',
        'category_id',
    ];
}
