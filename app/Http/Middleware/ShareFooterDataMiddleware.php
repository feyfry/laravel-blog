<?php

namespace App\Http\Middleware;

use App\Http\Services\Frontend\ArticleService;
use App\Http\Services\Frontend\CategoryService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ShareFooterDataMiddleware
{

    public function __construct(private CategoryService $categoryService, private ArticleService $articleService)
    {
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        view()->share('footer_categories', $this->categoryService->getFooterCategories());
        view()->share('recent_posts', $this->articleService->recentPosts());

        $latestArticles = $this->articleService->latestArticles(5);
        view()->share('footer_gallery', $latestArticles);

        return $next($request);
    }
}
