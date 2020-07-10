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
    public function getSinglePage($slug)
    {
        $columns = [
            'slug',
            'title',
        ];
        $result = $this->startConditions()
            ->select($columns)
            ->where('slug', $slug)
            ->firstOrFail();
        return $result;
    }

    /**
     * @param array $columns
     * @return Application[]|Collection|\Illuminate\Database\Eloquent\Model[]|mixed[]
     */
    public function getAllPagesNav($columns = ['*'])
    {
        return $this->startConditions()
            ->select($columns)
            ->where('page', '<>', 'home')
            ->with(['children', 'parent'])
            ->get();
    }

    /**
     * @param string $slug
     * @return mixed
     */
    public function getPageFirstBySlug(string $slug)
    {
        return $this->startConditions()
            ->where('slug', $slug)->first();
    }

    /**
     * Load Home page
     * @return mixed
     */
    public function homePage()
    {
        return $this->startConditions()
            ->where('page', 'home')->firstOrFail();
    }
}
