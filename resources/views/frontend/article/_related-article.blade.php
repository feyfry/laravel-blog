<div class="bg-light rounded my-4 p-4">
    <h4 class="mb-4">Related Articles</h4>
    <div class="row g-4">
        @forelse ($related_articles as $item)
        <div class="col-lg-6 bg-white rounded p-3">
            <div class="d-flex align-items-center p-3">
                <a href="{{ route('articles.show', $item->slug) }}" class="h5 mb-2">
                    <img src="{{ asset('storage/images/' . $item->image) }}" class="img-fluid rounded" width="80%"
                        alt="{{ $item->title }}">
                </a>
            </div>
            <div class="w-100 ms-4">
                <a href="{{ route('articles.show', $item->slug) }}" class="h5 mb-2">
                    {{ $item->title }}
                </a>
                <p class="text-dark mt-2 mb-0 me-3"><i class="fa fa-clock"></i>
                    {{ date('d M Y', strtotime($item->published_at)) }}</p>
            </div>
        </div>

        @empty
        <p class="text-center">No related article</p>
        @endforelse
    </div>
</div>
