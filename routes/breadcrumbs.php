<?php

use App\Repositories\PageRepository as Page;
use App\Repositories\BlogCategoryRepository as BlogCategory;
use App\Repositories\BlogPostRepository as Post;
use DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator as Generator;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

// Home
Breadcrumbs::for('home', static function (Generator $trail) {
    $trail->push(__('Главная'), route('home'));
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
    $category = app(BlogCategory::class)->getCategoryBySlug($categorySlug);
    $trail->push($category->title, route('blog.category', $category->slug));
});
// Blog Post
Breadcrumbs::for('blog.post', static function (Generator $trail, $postSlug) {
    $trail->parent('blog');
    $post = app(Post::class)->getPostBySlug($postSlug);
    $trail->push($post->title, route('blog.category', $post->slug));
});
// Any Page
Breadcrumbs::for('page', static function (Generator $trail, $pageSlug) {
    $trail->parent('home');
    $page = app(Page::class)->getPageFirstBySlug($pageSlug);
    $trail->push($page->title, route('page', $page->slug));
});
