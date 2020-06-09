<?php

namespace App\Repositories;

use App\Models\Blog\BlogPost as Model;
use Illuminate\Pagination\LengthAwarePaginator;

class BlogPostRepository extends CoreRepository
{
    /**
     * Возвращает полное имя класса
     * @return string
     */
    protected function getModelClass(): string
    {
        return Model::class;
    }

    /**
     * @param null $perPage
     * @return LengthAwarePaginator
     */
    public function getAllWithPaginate($perPage = null): LengthAwarePaginator
    {
        $columns = [
            'id',
            'title',
            'slug',
            'excerpt',
            'is_published',
            'published_at',
            'category_id',
        ];
        $result = $this->startConditions()
            ->select($columns)
            ->where('is_published', true)
            ->orderBy('id', 'DESC')
            ->with(['category:title,id']) // LazyLoad
            ->paginate($perPage);
        return $result;
    }
}
