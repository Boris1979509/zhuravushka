<?php

use App\Repositories\PageRepository as Page;
use App\Repositories\BlogCategoryRepository as BlogCategory;
use App\Repositories\ProductRepository as Product;
use App\Repositories\ProductCategoryRepository as CategoryProduct;
use App\Repositories\BlogPostRepository as Post;
use DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator as Generator;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

// Home
Breadcrumbs::for('home', static function (Generator $trail) {
    $trail->push('Главная', route('home'));
});
// Page Service
Breadcrumbs::for('page.service', static function (Generator $trail) {
    $trail->parent('home');
    $trail->push('Услуги', route('page.service'));
});
// Page Blog
Breadcrumbs::for('blog', static function (Generator $trail) {
    $trail->parent('home');
    $trail->push('Советы', route('blog'));
});
// Category Blog
Breadcrumbs::for('blog.category', static function (Generator $trail, $categorySlug) {
    $trail->parent('blog');
    $category = (new BlogCategory)->getCategoryBySlug($categorySlug);
    $trail->push($category->title, route('blog.category', $category->slug));
});
// Blog Post
Breadcrumbs::for('blog.post', static function (Generator $trail, $postSlug) {
    $trail->parent('blog');
    $post = (new Post)->getPostBySlug($postSlug);
    $trail->push($post->title, route('blog.category', $post->slug));
});
// Any Page
Breadcrumbs::for('page', static function (Generator $trail, $pageSlug) {
    $trail->parent('home');
    $page = (new Page)->getPageFirstBySlug($pageSlug);
    $trail->push($page->title, route('page', $page->slug));
});
// User Cart
Breadcrumbs::for('cart', static function (Generator $trail) {
    $trail->parent('home');
    $trail->push('Корзина товаров', route('cart'));
});
// Order Cart
Breadcrumbs::for('cart.place', static function (Generator $trail) {
    $trail->parent('cart');
    $trail->push(__('Order Place'), route('cart.place'));
});
// Catalog main
Breadcrumbs::for('catalog', static function (Generator $trail) {
    $trail->parent('home');
    $trail->push('Каталог', route('catalog'));
});
// Product category
Breadcrumbs::for('category', static function (Generator $trail, $categoryProductSlug) {
    $category = (new CategoryProduct)->getBySlug($categoryProductSlug);
    if ($parent = $category->parent) {
        $trail->parent('category', $parent->slug);
    } else {
        $trail->parent('catalog');
    }
    $trail->push($category->title, route('category', $category->slug));
});
// Product
Breadcrumbs::for('product', static function (Generator $trail, $slug) {
    $product = (new Product)->getBySlug($slug);
    if ($category = $product->category) {
        $trail->parent('category', $category->slug);
    }
    $trail->push($product->title, route('product', $product->title));
});
