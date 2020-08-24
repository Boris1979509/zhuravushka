<?php

namespace App\Observers;

use App\Models\Blog\BlogCategory;

class BlogCategoryObserver
{

    public function created(BlogCategory $blogCategory)
    {
        //
    }


    public function updated(BlogCategory $blogCategory)
    {
        //
    }


    public function deleting(BlogCategory $blogCategory): void
    {

    }


    public function restored(BlogCategory $blogCategory)
    {
        //
    }


    public function forceDeleted(BlogCategory $blogCategory)
    {
        //
    }
}
