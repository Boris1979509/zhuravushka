<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Core;
use App\Http\Requests\ProductsFilterRequest;
use App\Models\Shop\Product;
use App\Models\Shop\ProductAttribute;
use App\Models\Shop\ProductProperty;
use App\UseCases\Cart\CartService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
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

        $attributes = $this->productAttributeRepository->getAttributes($category->id);
        $categoryIds = $this->getAllCategoryIds($category);

        $this->data['products'] = $this->productRepository
            ->whereIn($categoryIds ?: $category, self::PAGE_LIMIT);

        // Stocks
        $this->sortStock($request, $categoryIds ?: $category);

        // Sort
        $this->sort($request, $categoryIds ?: $category);

        // Sort by price from && to
        $this->sortByPrice($request, $categoryIds ?: $category->id);

        // Sort by Attributes
        $this->sortAttributes($request, $categoryIds ?: $category);

        $this->data['category'] = $category;

        if (is_null($this->data['category'])) {
            return redirect()->route('catalog');
        }
        // if empty sort products
        if (!$this->data['products']->total()) {
            return redirect()->route('category', $slug)->with('info', __('NotFound'));
        }
        //dd($this->data['products']);
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
     * Sort price inputs
     * @param $request
     * @param $id
     */
    private function sortByPrice($request, $id): void
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

    /**
     * Sort brands
     * @param $request
     * @param $category
     */
    private function sortAttributes($request, $category): void
    {
        $query = ProductAttribute::query();
        $properties = ProductProperty::all();

        $values = [];
        $query->select('product_id')->where('category_id', $category->id);
        foreach ($request->input() as $key => $name) {
            if ($result = $properties->where('slug', $key)->first()) {
                $values[] = $name;
            }
        }
        if (!empty($values)) {
            $values = array_merge(...$values);
            $query->where(static function ($query) use ($values) {
                $query->whereIn('product_property_value_id', $values);
            });


            //

//            SELECT `product_id`
//FROM `product_attributes`
//WHERE `category_id` = 101
//            AND `product_property_value_id` IN (63, 52)
//GROUP BY `product_id`
//having count(distinct `product_property_value_id`) = 2
            $query->groupBy('product_id')
                ->havingRaw('count(*) = ' . count($values));
            $data = $query->get();

            $productIds = $data->map(static function ($item) {
                return $item->product_id;
            });
            $this->data['products'] = Product::whereIn('id', $productIds)
                ->paginate(15)
                ->withPath('?' . $request->getQueryString());
        }
    }

}
