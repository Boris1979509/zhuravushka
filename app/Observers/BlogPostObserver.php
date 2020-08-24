<?php

namespace App\Observers;

use App\Models\Blog\BlogPost;
use Carbon\Carbon;
use Illuminate\Support\Str;

class BlogPostObserver
{
    /**
     * @param BlogPost $blogPost
     */
    public function creating(BlogPost $blogPost): void
    {
        $this->setPublishedAt($blogPost);
        $this->setSlug($blogPost);
    }

    /**
     * @param BlogPost $blogPost
     */
    public function updating(BlogPost $blogPost): void
    {
        $this->setPublishedAt($blogPost);
        $this->setSlug($blogPost);
    }

    public function deleted(BlogPost $blogPost): void
    {
        //
    }

    public function restored(BlogPost $blogPost): void
    {
        //
    }

    public function forceDeleted(BlogPost $blogPost): void
    {
        //
    }

    /**
     * @param BlogPost $blogPost
     */
    private function setPublishedAt(BlogPost $blogPost): void
    {
        $blogPost->published_at = ($blogPost->is_published) ? Carbon::now() : null;
    }

    /**
     * @param BlogPost $blogPost
     */
    private function setSlug(BlogPost $blogPost): void
    {
        // If field title was changed or title is empty
        if (empty($blogPost->slug) || $blogPost->isDirty('title')) {
            $blogPost->slug = Str::slug($blogPost->title, '-');
        }
    }
}
