<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title') - MyBlog</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    @stack('meta')

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@100;600;800&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('assets/frontend') }}/lib/animate/animate.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('assets/frontend') }}/css/bootstrap.min.css" rel="stylesheet">

    @stack('css')
    <!-- Template Stylesheet -->
    <link href="{{ asset('assets/frontend') }}/css/style.css" rel="stylesheet">

</head>

<body>

    @include('frontend.layout.partials._navbar')

    @include('frontend.layout.partials._search')

    @yield('content')

    <!-- Footer Start -->
    <div class="container-fluid bg-dark footer py-5">
        <div class="container py-5">
            <div class="pb-4 mb-4" style="border-bottom: 1px solid rgba(255, 255, 255, 0.08);">
                <div class="row g-4">
                    <div class="col-lg-3">
                        <a href="#" class="d-flex flex-column flex-wrap">
                            <p class="text-white mb-0 display-6">Newsers</p>
                            <small class="text-light" style="letter-spacing: 11px; line-height: 0;">Newspaper</small>
                        </a>
                    </div>
                    <div class="col-lg-9">
                        <div class="d-flex position-relative rounded-pill overflow-hidden">
                            <input class="form-control border-0 w-100 py-3 rounded-pill" type="email"
                                placeholder="example@gmail.com">
                            <button type="submit"
                                class="btn btn-primary border-0 py-3 px-5 rounded-pill text-white position-absolute"
                                style="top: 0; right: 0;">Subscribe Now</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-5">
                <div class="col-lg-6 col-xl-3">
                    <div class="footer-item-1">
                        <h4 class="mb-4 text-white">Get In Touch</h4>
                        <p class="text-secondary line-h">Address: <span class="text-white">123 Streat, Jakarta</span>
                        </p>
                        <p class="text-secondary line-h">Email: <span class="text-white">Example@gmail.com</span></p>
                        <p class="text-secondary line-h">Phone: <span class="text-white">+0123 4567 8910</span></p>
                        <div class="d-flex line-h">
                            <a class="btn btn-light me-2 btn-md-square rounded-circle" href=""><i
                                    class="fab fa-twitter text-dark"></i></a>
                            <a class="btn btn-light me-2 btn-md-square rounded-circle" href=""><i
                                    class="fab fa-facebook-f text-dark"></i></a>
                            <a class="btn btn-light me-2 btn-md-square rounded-circle" href=""><i
                                    class="fab fa-youtube text-dark"></i></a>
                            <a class="btn btn-light btn-md-square rounded-circle" href=""><i
                                    class="fab fa-linkedin-in text-dark"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-3">
                    <div class="footer-item-2">
                        <div class="d-flex flex-column mb-4">
                            <h4 class="mb-4 text-white">Recent Posts</h4>
                            @foreach($recent_posts as $post)
                            <a href="{{ route('articles.show', $post->slug) }}">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle border border-2 border-primary overflow-hidden"
                                        style="width: 100px; height: 100px;">
                                        <img src="{{ asset('storage/images/' . $post->image) }}"
                                            class="img-zoomin img-fluid w-100 h-100 object-fit-cover"
                                            alt="{{ $post->title }}">
                                    </div>
                                    <div class="d-flex flex-column ps-4">
                                        <p class="text-uppercase text-white mb-3">{{ $post->category->name }}</p>
                                        <a href="{{ route('articles.show', $post->slug) }}" class="h6 text-white">
                                            {{ Str::limit($post->title, 30) }}
                                        </a>
                                        <small class="text-white d-block"><i class="fas fa-calendar-alt me-1"></i>
                                            {{ date('d M Y', strtotime($post->published_at)) }}</small>
                                    </div>
                                </div>
                            </a>
                            @if(!$loop->last)
                            <hr class="my-4">
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-3">
                    <div class="d-flex flex-column text-start footer-item-3">
                        <h4 class="mb-4 text-white">Categories</h4>
                        @foreach($footer_categories as $category)
                        <a class="btn-link text-white" href="{{ route('category.show', $category->slug) }}">
                            <i class="fas fa-angle-right text-white me-2"></i> {{ $category->name }}
                        </a>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-6 col-xl-3">
                    <div class="footer-item-4">
                        <h4 class="mb-4 text-white">Our Gallery</h4>
                        <div class="row g-2">
                            @foreach($footer_gallery as $article)
                            <div class="col-4">
                                <div class="rounded overflow-hidden ratio ratio-1x1">
                                    <img src="{{ asset('storage/images/' . $article->image) }}"
                                        class="img-zoomin img-fluid object-fit-cover w-100 h-100"
                                        alt="{{ $article->title }}">
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Copyright Start -->
    <div class="container-fluid copyright bg-dark py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <span class="text-light"><a href="#"><i class="fas fa-copyright text-light me-2"></i>Beritaku</a>
                        All right reserved.</span>
                </div>
                <div class="col-md-6 my-auto text-center text-md-end text-white">
                    <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                    <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                    <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                    Designed By <a href="#">Fei Fei</a> Distributed By <a
                        href="#">ThemeWagon</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-2 border-white rounded-circle back-to-top"><i
            class="fa fa-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/frontend') }}/lib/easing/easing.min.js"></script>
    <script src="{{ asset('assets/frontend') }}/lib/waypoints/waypoints.min.js"></script>

    @stack('js')
    <!-- Template Javascript -->
    <script src="{{ asset('assets/frontend') }}/js/main.js"></script>

</body>

</html>
