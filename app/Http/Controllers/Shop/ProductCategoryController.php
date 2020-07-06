<?php

namespace App\Http\Controllers\Shop;

use App\Http\Requests\ProductsFilterRequest;
use App\Models\Shop\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductCategoryController extends BaseController
{
    /**
     * @var array $data
     */
    protected $data = [];

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
     * @param ProductsFilterRequest $request
     * @param $slug
     * @return RedirectResponse|view
     */
    public function category(ProductsFilterRequest $request, $slug)
    {
        //dd($request->all());
//        $productsQuery = Product::query();
//        if ($request->anyFilled('priceFrom')) {
//            $productsQuery->where('price', '>=', $request->priceFrom);
//        }
//        if ($request->anyFilled('priceTo')) {
//            $productsQuery->where('price', '<=', $request->priceTo);
//        }
//        if($request->has('sortInStock')){
//
//        }
//        $products = $productsQuery->paginate(10)->withPath('?' . $request->getQueryString());

        $this->data['category'] = $this->productCategoryRepository->getBySlug($slug);

        if (is_null($this->data['category'])) {
            return redirect()->route('catalog');
        }
        $this->getCart();
        $this->getAllProducts();
        return view('shop.category', $this->data);
    }

    private function getCart(): void
    {
        $this->data['order'] = $this->orderRepository->findByOrderId(session('orderId'));
        $this->data['cartCount'] = ($this->data['order']) ? $this->data['order']->cartCount() : null;
    }

    private function getAllProducts(): void
    {
        $categoriesIds = $this->data['category']->children->each(static function ($category) {
            return $category->id;
        });
        $this->data['products'] = $this->productRepository->whereIn($categoriesIds, 10);
    }
}
