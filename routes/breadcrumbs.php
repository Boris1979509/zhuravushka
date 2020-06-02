<?php

use App\Models\Shop\Page;
use DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator as Generator;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

// Home
Breadcrumbs::for('home', static function (Generator $trail) {
    $trail->push(__('Home'), route('home'));
});
Breadcrumbs::for('page', static function (Generator $trail, $pageSlug) {
    $trail->parent('home');
    $page = Page::where('slug', $pageSlug)->firstOrFail();
    $trail->push($page->title, route('page', $page->slug));
});
