<!-- Modal Search Start -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex align-items-center">
                <form action="{{ route('frontend.article.search') }}" method="get" class="w-75 mx-auto">
                    <div class="input-group">
                        <input type="search" class="form-control p-3" placeholder="Enter keywords..." name="keyword" aria-label="Search">
                        <button class="input-group-text p-3" type="submit" id="search-icon-1">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Search End -->
