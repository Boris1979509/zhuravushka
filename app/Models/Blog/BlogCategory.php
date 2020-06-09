<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class BlogCategory
 * @property integer $id
 * @property string $slug
 * @property string $title
 * @property integer $parent_id
 * @property string $description
 *
 * @property-read BelongsTo $parent
 * @property-read mixed|null $parentTitle
 */
class BlogCategory extends Model
{

    use SoftDeletes;

    protected $fillable = [
        'slug',
        'title',
        'parent_id',
        'description',
    ];

    /**
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(static::class, 'parent_id', 'id');
    }

    /**
     * Accessor
     * @return mixed|null
     */
    public function getParentTitleAttribute()
    {
        //return $this->parent->title ?? null;
    }
}
