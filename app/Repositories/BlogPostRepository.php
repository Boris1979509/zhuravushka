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
     * @param array $columns
     * @param null $id
     * @return LengthAwarePaginator
     */
    public function getAllWithPaginate($perPage = null, $id = null, $columns = ['*']): LengthAwarePaginator
    {
        $result = $this->startConditions()
            ->select($columns)
            ->where(static function ($query) use ($id) {
                if (!is_null($id)) {
                    $query->where('category_id', $id);
                }
                return $query->where('is_published', true);
            })
            ->orderBy('id', 'DESC')
            ->with(['category:title,id']) // LazyLoad
            ->paginate($perPage);
        return $result;
    }

    /**
     * @param string $slug
     * @return mixed
     */
    public function getPostBySlug(string $slug)
    {
        return $this->startConditions()
            ->where('slug', $slug)
            ->firstOrFail();
    }
}
