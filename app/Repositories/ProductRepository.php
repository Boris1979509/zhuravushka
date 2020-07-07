<?php


namespace App\Repositories;

use App\Models\Shop\Product as Model;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository extends CoreRepository
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
     * @param array $columns
     * @return mixed
     */
    public function getAllProducts($columns = ['*'])
    {
        return $this->startConditions()
            ->select($columns)
            ->with('category')
            ->take(20)->get();
    }

    /**
     * @param $product
     * @return mixed
     */
    public function getProductFirst($product)
    {
        return $this->startConditions()
            ->find($product);
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function getBySlug($slug)
    {
        $columns = ['*'];
        return $this->startConditions()
            ->select($columns)
            ->with('category')
            ->where('slug', $slug)
            ->first();
    }

    /**
     * @param null $perPage
     * @param $array
     * @param array $columns
     * @return mixed
     */
    public function whereIn($array, $perPage = null, $columns = ['*'])
    {
        return $this->startConditions()
            ->whereIn('category_id', $array)
            ->orderBy('price')
            ->paginate($perPage);
    }

    /**
     * @return Builder
     */
    public function query()
    {
        return $this->startConditions()
            ->newQuery();
    }

    /**
     * @param $sort
     * @param $id
     * @param null $perPage
     * @return LengthAwarePaginator
     */
    public function sortBy($sort, $id, $perPage = null)
    {
        $columns = ['*'];
        switch ($sort) {
            case 'price':
                return $this->query()
                    ->select($columns)
                    ->whereIn('category_id', $id)
                    ->orderBy('price')
                    ->paginate($perPage);
                break;
            case 'popular':
                return $this->query()
                    ->select($columns)
                    ->whereIn('category_id', $id)
                    ->orderBy('id', 'DESC')
                    ->paginate($perPage);
                break;
            case 'name':
                return $this->query()
                    ->select($columns)
                    ->whereIn('category_id', $id)
                    ->orderBy('title')
                    ->paginate($perPage);
                break;
        }
    }

    /**
     * @param integer $id
     * @param null|integer $perPage
     * @return LengthAwarePaginator
     */
    public function sortByStock($id, $perPage = null)
    {
        $columns = ['*'];
        return $this->query()
            ->select($columns)
            ->whereIn('category_id', $id)
            ->where('price', '<>', 0)
            ->orderBy('price')
            ->paginate($perPage);

    }

    /**
     * @param integer $id
     * @param integer|array $num
     * @param string $opr
     * @param null|integer $perPage
     * @return LengthAwarePaginator
     */
    public function getPriceSort($id, $num, $opr = null, $perPage = null)
    {
        $columns = ['*'];

        return $this->query()
            ->select($columns)
            ->where(static function ($query) use ($id) {
                if (is_integer($id)) {
                    return $query->where('category_id', $id);
                }

                $query->whereIn('category_id', $id);
            })
            ->where(static function ($query) use ($num, $opr) {
                if (is_array($num)) {
                    return $query->whereBetween('price', $num);
                }
                $query->where('price', $opr, $num);
            })
            ->orderBy('price')
            ->paginate($perPage);
    }
}
