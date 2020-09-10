<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Core;
use App\Http\Requests\ProductsFilterRequest;
use App\Models\Shop\Product;
use App\Models\Shop\ProductAttribute;
use App\Models\Shop\ProductCategory;
use App\Models\Shop\ProductProperty;
use App\Repositories\ProductAttributeRepository;
use App\UseCases\Cart\CartService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ProductCategoryController extends Core
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
     * @param CartService $cartService
     * @return View
     */
    public function index(CartService $cartService): View
    {
        return view('shop.catalog', $this->data, $cartService->getCart());
    }

    /**
     * @param ProductsFilterRequest $request
     * @param $slug
     * @param CartService $cartService
     * @return Factory|RedirectResponse|View
     */
    public function category(ProductsFilterRequest $request, $slug, CartService $cartService)
    {

        $category = $this->productCategoryRepository->getBySlug($slug);

        $attributes = $this->productAttributeRepository->getAttributes($category->parent ? $category->parent->id : $category->id);

        $categoryIds = $this->getAllCategoryIds($category);

        $this->data['products'] = $this->productRepository
            ->whereIn($categoryIds ?: $category, self::PAGE_LIMIT);

        // Stocks
        $this->sortStock($request, $categoryIds ?: $category);

        // Sort
        $this->sort($request, $categoryIds ?: $category);

        // Sort by Attributes
        $this->sortAttributes($request, $category->parent ? $category->parent->id : $category->id);

        $this->data['category'] = $category;

        if (is_null($this->data['category'])) {
            return redirect()->route('catalog');
        }
        // if empty sort products
        if (!$this->data['products']->total()) {
            return redirect()->route('category', $slug)->with('info', __('NotFound'));
        }
        return view('shop.category', $this->data + $cartService->getCart(), compact('attributes'));
    }

    /**
     * @param $category
     * @return mixed
     */
    private function getAllCategoryIds($category)
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
     * @return void
     */
    private function sort($request, $id): void
    {
        if ($sort = $request->input('sort')) {
            $this->data['products'] = $this->productRepository
                ->sortBy($sort, $id, self::PAGE_LIMIT)
                ->withPath('?' . $request->getQueryString());
        }
    }

    /**
     * @param $request
     * @param $id
     */
    private function sortStock($request, $id): void
    {
        /**
         * Stocks
         */
        if ($request->has('sortInStock')) {

            $this->data['products'] = $this->productRepository
                ->sortByStock($id, self::PAGE_LIMIT)
                ->withPath('?' . $request->getQueryString());
        }
    }

    /**
     * @param ProductsFilterRequest $request
     * @param int $categoryId
     */
    private function sortAttributes(ProductsFilterRequest $request, int $categoryId): void
    {
        if(!$request->isMethod('post')) return;
        $query = $this->productAttributeRepository->query(); // Builder
        $query->select('product_id')->where('category_id', $categoryId);

        /* Sort attributes */
        if (!empty($values = $this->getAttributes($request))) {
            $query->where(static function ($query) use ($values) {
                $query->whereIn('product_property_value_id', $values);
                foreach ($values as $key => $value) {
                    if (count($value) > 1) {
                        $query->orWhere(function ($query) use ($value) {
                            $query->whereIn('product_property_value_id', $value);
                        });
                    }
                }
            });
            $query->groupBy('product_id')
                ->havingRaw('count(*) = ' . count($values));
        }
        /* End sort attributes */

        /* Sort price from */
        if ($request->anyFilled('priceFrom')) {
            $this->sortPriceFrom($query, $request);
        }

        /* Sort price to */
        if ($request->anyFilled('priceTo')) {
            $this->sortPriceTo($query, $request);
        }

        /* Price from && Price to */
        if ($request->anyFilled('priceFrom') && $request->anyFilled('priceTo')) {
            $this->sortPriceFromAndTo($query, $request);
        }

        $result = $query->get();
        /* Product id's */
        $productIds = $result->map(static function ($item) {
            return $item->product_id;
        });

        $this->data['products'] = $this->productRepository
            ->getFiltersAttributes($productIds, self::PAGE_LIMIT)
            ->withPath('?' . $request->getQueryString());

    }

    /**
     * @param ProductsFilterRequest $request
     * @return array
     */
    private function getAttributes(ProductsFilterRequest $request){
        $properties = ProductProperty::all();

        $values = [];
        foreach ($request->input() as $key => $name) {
            if ($properties->where('slug', $key)->first()) {
                $values[] = $name;
            }
        }
        return $values;
    }

    /**
     * @param Builder $query
     * @param ProductsFilterRequest $request
     */
    private function sortPriceFrom(Builder $query, ProductsFilterRequest $request)
    {
        $from = $request->input('priceFrom');
        $query->whereHas('product', function ($query) use ($from) {
            $query->where('price', '>=', $from);
        });
    }

    /**
     * @param Builder $query
     * @param ProductsFilterRequest $request
     */
    private function sortPriceTo(Builder $query, ProductsFilterRequest $request)
    {
        $to = $request->input('priceTo');
        $query->whereHas('product', function ($query) use ($to) {
            $query->where('price', '<=', $to);
        });
    }

    /**
     * @param Builder $query
     * @param ProductsFilterRequest $request
     */
    private function sortPriceFromAndTo(Builder $query, ProductsFilterRequest $request)
    {
        $from = $request->input('priceFrom');
        $to = $request->input('priceTo');
        $query->whereHas('product', function ($query) use ($from, $to) {
            $query->whereBetween('price', [$from, $to]);
        });
    }

}
