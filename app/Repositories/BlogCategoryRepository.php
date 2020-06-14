<?php


namespace App\Repositories;

use App\Models\Blog\BlogCategory;
use App\Models\Blog\BlogCategory as Model;


class BlogCategoryRepository extends CoreRepository
{

    /**
     * @return mixed|string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * @param array $columns
     * @return mixed
     */
    public function getAllCategory($columns = ['*'])
    {
        $result = $this->startConditions()
            ->select($columns)
            ->with(['posts' => static function ($query) {
                $query->selectRaw('category_id, count(*) as count')
                    ->where('is_published', true)
                    ->groupBy('category_id');
            }])->get();
        return $result;
    }

    /**
     * @param string $slug
     * @return BlogCategory
     */
    public function getCategoryBySlug(string $slug): BlogCategory
    {
        return $this->startConditions()
            ->where('slug', $slug)
            ->firstOrFail();
    }
}
