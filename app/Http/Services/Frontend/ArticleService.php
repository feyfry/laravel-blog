<?php

namespace App\Http\Services\Frontend;

use App\Models\Article;

class ArticleService
{
    public function getFirstBy(string $column, string $value, bool $relation = false)
    {
        if ($relation == true) {
            $article = Article::with('category:id,name,slug', 'user:id,name', 'tags:id,name,slug')
                ->where($column, $value)
                ->first();
        } else {
            $article = Article::where($column, $value)
                ->first();
        }

        return $article;
    }

    public function all()
    {
        $article = Article::with('category:id,name,slug', 'user:id,name')
            ->select(['id', 'title', 'slug', 'category_id', 'user_id', 'published', 'is_confirm', 'views', 'image', 'published_at'])
            ->orderBy('published_at', 'desc')
            ->where('published', true)
            ->where(function ($query) {
                $query->where('is_confirm', true)
                    ->orWhereNull('is_confirm');
            })
            ->SimplePaginate(6);

        return $article;
    }

    public function search(string $keyword)
    {
        $article = Article::with('category:id,name,slug', 'user:id,name')
            ->select(['id', 'title', 'slug', 'category_id', 'user_id', 'published', 'is_confirm', 'views', 'image', 'published_at'])
            ->orderBy('published_at', 'desc')
            ->where('published', true)
            ->where('is_confirm', true)
            ->where('title', 'like', '%' . $keyword . '%')
            ->SimplePaginate(6);

        return $article;
    }

    public function showByCategory(string $category)
    {
        $articles = Article::with('category:id,name,slug', 'user:id,name')
            ->whereHas('category', function ($query) use ($category) {
                $query->where('slug', $category);
            })
            ->where('published', true)
            ->where(function ($query) {
                $query->where('is_confirm', true)
                    ->orWhereNull('is_confirm');
            })
            ->latest()
            ->paginate(6);

        return $articles;
    }

    public function showByTag(string $tag)
    {
        $articles = Article::with('tags:id,name,slug', 'user:id,name')
            ->whereHas('tags', function ($query) use ($tag) {
                $query->where('slug', $tag);
            })
            ->where('published', true)
            ->where(function ($query) {
                $query->where('is_confirm', true)
                    ->orWhereNull('is_confirm');
            })
            ->latest()
            ->paginate(6);

        return $articles;
    }

    public function relatedArticles(string $slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();

        $related_article = Article::where('published', true)
            ->where(function ($query) {
                $query->where('is_confirm', true)
                    ->orWhereNull('is_confirm');
            })
            ->where('id', '!=', $article->id)
            ->where('category_id', $article->category_id)
            ->limit(2)
            ->get(['id', 'title', 'slug', 'image']);

        return $related_article;
    }

    public function popularArticles()
    {
        $articles = Article::with('category:id,name')
            ->select('id', 'category_id', 'title', 'slug', 'published', 'is_confirm', 'views', 'image', 'published_at')
            ->orderBy('views', 'desc')
            ->where('published', true)
            ->where(function ($query) {
                $query->where('is_confirm', true)
                    ->orWhereNull('is_confirm');
            })
            ->limit(4)
            ->get();

        return $articles;
    }

    public function latestArticles($limit = 5)
    {
        return Article::with('category:id,name', 'user:id,name')
            ->select('id', 'user_id', 'category_id', 'title', 'slug', 'image', 'published_at')
            ->latest('published_at')
            ->where('published', true)
            ->where(function ($query) {
                $query->where('is_confirm', true)
                    ->orWhereNull('is_confirm');
            })
            ->limit($limit)
            ->get();
    }

    public function recentPosts($limit = 2)
    {
        return Article::with('category:id,name,slug')
            ->select('id', 'category_id', 'title', 'slug', 'image', 'published_at')
            ->where('published', true)
            ->where(function ($query) {
                $query->where('is_confirm', true)
                    ->orWhereNull('is_confirm');
            })
            ->latest('published_at')
            ->limit($limit)
            ->get();
    }

    public function getPopularArticles($limit = 5)
    {
        return Article::where('published', true)
            ->where(function ($query) {
                $query->where('is_confirm', true)
                    ->orWhereNull('is_confirm');
            })
            ->orderBy('views', 'desc')
            ->limit($limit)
            ->get();
    }

    public function getLaravelArticles($limit = 2)
    {
        return Article::where('published', true)
            ->where(function ($query) {
                $query->where('is_confirm', true)
                    ->orWhereNull('is_confirm');
            })
            ->whereHas('category', function ($query) {
                $query->where('name', 'Laravel');
            })
            ->latest()
            ->limit($limit)
            ->get();
    }
}
