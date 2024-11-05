<!-- Latest News Start -->
<div class="container-fluid latest-news py-5">
    <div class="container py-5">
        <div class="border-bottom mb-4">
            <h2 class="mb-4">Latest News</h2>
        </div>
        <div class="latest-news-carousel owl-carousel">
            @forelse($latest_articles as $article)
            <div class="latest-news-item">
                <div class="bg-light rounded">
                    <div class="rounded-top overflow-hidden">
                        <a href="{{ route('articles.show', $article->slug) }}">
                            <img src="{{ asset('storage/images/' . $article->image) }}"
                                class="img-zoomin img-fluid rounded-top w-100" alt="{{ $article->title }}">
                        </a>
                    </div>
                    <div class="d-flex flex-column p-4">
                        <a href="{{ route('articles.show', $article->slug) }}"
                            class="h4">{{ Str::limit($article->title, 50) }}</a>
                        <div class="d-flex justify-content-between">
                            <a href="#" class="small text-body link-hover">by {{ $article->user->name }}</a>
                            <small class="text-body d-block"><i class="fas fa-calendar-alt me-1"></i>
                                {{ date('M d, Y', strtotime($article->published_at)) }}</small>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="alert alert-info">No latest articles available.</div>
            @endforelse
        </div>
    </div>
</div>
<!-- Latest News End -->
