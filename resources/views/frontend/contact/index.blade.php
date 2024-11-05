@extends('frontend.layout.main')

@section('title', 'Live Chat')

@push('meta')
<meta name="robots" content="index, follow">
<meta name="author" content="Muhammad Faiz | github.com/feyfry">
<meta name="keyword" content="MyBlog, Blog Technology">
<meta name="description"
    content="MyBlog is a blog that shares knowledge about technology, programming, and web development.">
<meta property="og:title" content="MyBlog">
<meta property="og:image" content="contoh.jpg">
<meta name="image" content="contoh.jpg">
@endpush

@push('css')
<style>
    .shdw {
        box-shadow: 10px 10px 5px 0px rgba(0, 0, 0, 0.75);
        -webkit-box-shadow: 10px 10px 5px 0px rgba(0, 0, 0, 0.75);
        -moz-box-shadow: 10px 10px 5px 0px rgba(0, 0, 0, 0.75);
    }

</style>
@endpush

@section('content')

<div class="container">
    <div class="row justify-content-center align-items-center text-center my-5">
        <div class="col-lg-8">
            <div class="card rounded shdw border border-primary p-2">
                <iframe src="https://www5.cbox.ws/box/?boxid=953869&boxtag=ywvdGF" width="100%" height="450"
                    allow="autoplay" title="Live Chat"></iframe>
            </div>
        </div>
    </div>
</div>

@endsection
