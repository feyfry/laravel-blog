<!-- Most Populer News Start -->
<div class="container-fluid populer-news">
    <div class="container">
        <div class="tab-class mb-4">
            <div class="row g-4">
                <div class="col-lg-8 col-xl-9">
                    <div class="border-bottom mb-4">
                        <h2 class="my-4">Most Popular</h2>
                    </div>
                    <div class="whats-carousel owl-carousel">
                        @foreach($popularArticles as $article)
                        <div class="latest-news-item">
                            <div class="bg-light rounded">
                                <div class="rounded-top overflow-hidden">
                                    <img src="{{ asset('storage/images/' . $article->image) }}"
                                        class="img-zoomin img-fluid rounded-top w-100" alt="{{ $article->title }}">
                                </div>
                                <div class="d-flex flex-column p-4">
                                    <a href="{{ route('articles.show', $article->slug) }}"
                                        class="h4">{{ Str::limit($article->title, 60) }}</a>
                                    <div class="d-flex justify-content-between">
                                        <a href="#" class="small text-body link-hover">by {{ $article->user->name }}</a>
                                        <small class="text-body d-block"><i class="fas fa-calendar-alt me-1"></i>
                                            {{ date('M d, Y', strtotime($article->published_at)) }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="mt-5 lifestyle">
                        <div class="border-bottom mb-4">
                            <h1 class="mb-4">Laravel</h1>
                        </div>
                        <div class="row g-4">
                            @foreach($laravelArticles as $article)
                            <div class="col-lg-6">
                                <div class="lifestyle-item rounded">
                                    <img src="{{ asset('storage/images/' . $article->image) }}"
                                        class="img-fluid w-100 rounded" alt="{{ $article->title }}">
                                    <div class="lifestyle-content">
                                        <div class="mt-auto">
                                            <a href="{{ route('articles.show', $article->slug) }}"
                                                class="h4 text-white link-hover">{{ Str::limit($article->title, 60) }}</a>
                                            <div class="d-flex justify-content-between mt-4">
                                                <a href="#" class="small text-white link-hover">By
                                                    {{ $article->user->name }}</a>
                                                <small class="text-white d-block"><i
                                                        class="fas fa-calendar-alt me-1"></i>
                                                    {{ date('M d, Y', strtotime($article->published_at)) }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-xl-3">
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="p-3 rounded border">
                                <h4 class="mb-4">Stay Connected</h4>
                                <div class="row g-4">
                                    <div class="col-12">
                                        <a href="#"
                                            class="w-100 rounded btn btn-primary d-flex align-items-center p-3 mb-2">
                                            <i
                                                class="fab fa-facebook-f btn btn-light btn-square rounded-circle me-3"></i>
                                            <span class="text-white">13,977 Fans</span>
                                        </a>
                                        <a href="#"
                                            class="w-100 rounded btn btn-warning d-flex align-items-center p-3 mb-2">
                                            <i class="fab fa-youtube btn btn-light btn-square rounded-circle me-3"></i>
                                            <span class="text-white">7,999 Subscriber</span>
                                        </a>
                                        <a href="#"
                                            class="w-100 rounded btn btn-dark d-flex align-items-center p-3 mb-2">
                                            <i
                                                class="fab fa-instagram btn btn-light btn-square rounded-circle me-3"></i>
                                            <span class="text-white">19,764 Follower</span>
                                        </a>
                                    </div>
                                </div>
                                <h4 class="my-4">Artikel Per Kategori</h4>
                                <div class="row g-4">
                                    @foreach($categoryArticles as $category)
                                    <div class="col-12">
                                        <div class="row g-4 align-items-center features-item">
                                            <div class="col-4">
                                                <div class="rounded-circle position-relative">
                                                    <div class="overflow-hidden rounded-circle">
                                                        <img src="{{ asset('storage/images/' . $category->articles->first()->image) }}"
                                                            class="img-zoomin img-fluid rounded-circle w-100"
                                                            alt="{{ $category->articles->first()->title }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-8">
                                                <div class="features-content d-flex flex-column">
                                                    <p class="text-uppercase mb-2">{{ $category->name }}</p>
                                                    <a href="{{ route('articles.show', $category->articles->first()->slug) }}"
                                                        class="h6">
                                                        {{ Str::limit($category->articles->first()->title, 40) }}
                                                    </a>
                                                    <small class="text-body d-block">
                                                        <i class="fas fa-calendar-alt me-1"></i>
                                                        {{ date('d M Y', strtotime($category->articles->first()->published_at)) }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="row g-4 mt-3">
                                    <div class="col-lg-12">
                                        <div class="position-relative banner-2">
                                            <img src="{{ asset('assets/frontend') }}/img/banner-2.jpg"
                                                class="img-fluid w-100 rounded" alt="">
                                            <div class="text-center banner-content-2">
                                                <h6 class="mb-2">The Most Populer</h6>
                                                <p class="text-white mb-2">News & Magazine WP Theme</p>
                                                <a href="#" class="btn btn-primary text-white px-4">Shop Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Most Populer News End -->
