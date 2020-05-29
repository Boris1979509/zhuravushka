<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ShopCategory
 * @package App\Models\Shop
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property null|integer $parent_id
 */
class ShopCategory extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'slug',
        'title',
        'parent_id',
        'description',
    ];
}
