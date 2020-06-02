<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Page
 * @package App\Models\Shop
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property string $content
 * @property string $description
 */
class Page extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'slug',
        'title',
        'content',
        'description',
    ];
}
