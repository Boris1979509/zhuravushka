<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ProductProperties
 * @package App\Models\Shop
 * @property integer $id
 * @property string $title
 * @property string $slug
 */
class ProductProperties extends Model
{
    use softDeletes;
    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
    ];
}
