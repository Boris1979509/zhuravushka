<?php


namespace App\Repositories;

use App\Models\Shop\Page as Model;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Collection;


class PageRepository extends CoreRepository
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
     * @param string $slug
     * @return mixed
     */
    public function getSinglePage(string $slug)
    {
        $columns = [
            'slug',
            'title',
        ];
        $result = $this->startConditions()->select($columns)->where('slug', $slug)->firstOrFail();
        return $result;
    }

    /**
     * @return Application[]|Collection|\Illuminate\Database\Eloquent\Model[]|mixed[]
     */
    public function getAllPages()
    {
        $result = $this->startConditions()->where('parent_id', 0)->get();
        return $result;
    }
}
