<?php

namespace App\Http\Controllers\Shop;

use App\Http\Requests\ProductsFilterRequest;
use App\Models\Shop\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class ProductCategoryController extends BaseController
{
    /**
     * @var array $data
     */
    protected $data = [];
    /**
     * Paginate limit
     */
    public const PAGE_LIMIT = 18;

    public function __construct()
    {
        parent::__construct();
        $this->data['pages'] = $this->pageRepository->getAllPagesNav();
        $this->data['productCategories'] = $this->productCategoryRepository->getAllProductCategories();
    }

    /**
     * Show all catalog
     * @return View
     */
    public function index(): View
    {
        $this->getCart();
        return view('shop.catalog', $this->data);
    }

    /**
     * @param Request $request
     * @param $slug
     * @return void
     */
    public function category(Request $request, $slug)
    {
        $category = $this->productCategoryRepository->getBySlug($slug);
        $categoryIds = $this->getAllProductsIds($category);

        $this->data['products'] = $this->productRepository
            ->whereIn($categoryIds ?: $category, self::PAGE_LIMIT)
            ->withPath('?' . $request->getQueryString());

        // Sort
        $this->sort($request, $categoryIds ?: $category);

        // Sort by price from && to
        $this->sortByPrice($request, $categoryIds ?: $category);

        /**
         * Stocks
         */
        if ($request->has('sortInStock')) {
            $this->data['products'] = $this->productRepository
                ->sortByStock($categoryIds ?: $category, self::PAGE_LIMIT)
                ->withPath('?' . $request->getQueryString());
        }

        $this->data['category'] = $category;

        if (is_null($this->data['category'])) {
            return redirect()->route('catalog');
        }
        $this->getCart();
        return view('shop.category', $this->data);
    }

    private function getCart(): void
    {
        $this->data['order'] = $this->orderRepository->findByOrderId(session('orderId'));
        $this->data['cartCount'] = ($this->data['order']) ? $this->data['order']->cartCount() : null;
    }

    /**
     * @param $category
     * @return mixed
     */
    private function getAllProductsIds($category)
    {

        if (($category->children)->count()) {
            // if is children
            return $category->children->map(static function ($categoryItem) {
                return $categoryItem->id;
            });
        }
    }

    /**
     * Sort
     * @param $request
     * @param $id
     * @return null
     */
    public function sort($request, $id)
    {
        if ($sort = $request->input('sort')) {
            $this->data['products'] = $this->productRepository
                ->sortBy($sort, $id, self::PAGE_LIMIT)
                ->withPath('?' . $request->getQueryString());
        }
    }

    /**
     * Sort price inputs
     * @param $request
     * @param $id
     */
    public function sortByPrice($request, $id)
    {
        /**
         * Price from
         */
        if ($request->anyFilled('priceFrom')) {
            $num = $request->input('priceFrom');
            $this->data['products'] = $this->productRepository
                ->getPriceSort($id, $num, $opr = '>=', self::PAGE_LIMIT)
                ->withPath('?' . $request->getQueryString());
        }
        /**
         * Price to
         */
        if ($request->anyFilled('priceTo')) {
            $num = $request->input('priceTo');
            $this->data['products'] = $this->productRepository
                ->getPriceSort($id, $num, $opr = '<=', self::PAGE_LIMIT)
                ->withPath('?' . $request->getQueryString());
        }
        /**
         * Price to && Price From
         */
        if ($request->anyFilled('priceTo') && $request->anyFilled('priceFrom')) {
            $priceFrom = $request->input('priceFrom');
            $priceTo = $request->input('priceTo');
            $this->data['products'] = $this->productRepository
                ->getPriceSort($id, [$priceFrom, $priceTo], null, self::PAGE_LIMIT)
                ->withPath('?' . $request->getQueryString());
        }
    }
}
