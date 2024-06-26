<style>
    .posts-entry-title {
        text-transform: uppercase;
        font-size: 20px;
        color: #000;
        letter-spacing: 0.05rem;
    }

    .posts-entry .blog-entry .img-link {
        position: relative;
        overflow: hidden;
        display: inline-block;
        border-radius: 10px;
        margin-bottom: 10px;
    }

    .posts-entry .blog-entry h2,
    .posts-entry .blog-entry .h2 {
        line-height: 1.3;
        font-size: 26px;
    }

    .posts-entry .blog-entry h2 a,
    .posts-entry .blog-entry .h2 a {
        color: #4d4c7d;
    }

    .posts-entry .btn-sm,
    .posts-entry .btn-group-sm>.btn {
        padding-top: 10px;
        padding-bottom: 10px;
        padding-left: 15px;
        padding-right: 15px;
    }

    .posts-entry .blog-entry-sm li {
        margin-bottom: 20px;
    }

    .posts-entry .blog-entry-sm h3,
    .posts-entry .blog-entry-sm .h3 {
        font-size: 20px;
    }

    .posts-entry .blog-entry-sm h3 a,
    .posts-entry .blog-entry-sm .h3 a {
        color: #4d4c7d;
    }

    .posts-entry.posts-entry-sm .blog-entry h2,
    .posts-entry.posts-entry-sm .blog-entry .h2 {
        font-size: 18px;
    }

    .posts-entry .blog-entry-search-item {
        margin-bottom: 30px;
    }

    .posts-entry .blog-entry-search-item .img-link {
        width: 280px;
        border-radius: 0;
    }

    .posts-entry .blog-entry-search-item .img-link img {
        margin-bottom: 0;
        border-radius: 10px;
    }

    .read-more {
        border-bottom: 2px solid #214252;
    }

    .post-entry-alt h2,
    .post-entry-alt .h2 {
        font-size: 18px;
        margin-bottom: 20px;
    }

    .post-entry-alt h2 a,
    .post-entry-alt .h2 a {
        color: #4d4c7d;
    }

    .post-entry-alt .excerpt {
        padding-left: 20px;
        padding-right: 20px;
    }

    .post-entry-alt .img-link {
        position: relative;
        display: inline-block;
        overflow: hidden;
        border-radius: 10px;
        margin-bottom: 10px;
    }

    .post-entry-alt .img-link img {
        margin-bottom: 0;
    }

    .post-meta {
        color: gray;
        font-size: 13px;
        width: 100%;
        display: block;
        margin-bottom: 20px;
    }

    .post-meta a {
        color: #000;
    }

    .post-meta .author-figure img {
        width: 30px;
        border-radius: 50%;
    }

    .blog-entries .blog-entry {
        display: block;
        -webkit-transition: 0.3s all ease;
        -o-transition: 0.3s all ease;
        transition: 0.3s all ease;
        margin-bottom: 30px;
        position: relative;
    }

    .blog-entries .blog-entry:hover,
    .blog-entries .blog-entry:focus {
        opacity: 0.7;
        top: -1px;
        -webkit-box-shadow: 0 3px 50px -2px rgba(0, 0, 0, 0.2) !important;
        box-shadow: 0 3px 50px -2px rgba(0, 0, 0, 0.2) !important;
    }

    .blog-entries .blog-entry .blog-content-body {
        padding: 20px;
        border: 1px solid #efefef;
        border-top: none;
    }

    .blog-entries .blog-entry img {
        max-width: 100%;
    }

    .blog-entries .blog-entry h2,
    .blog-entries .blog-entry .h2 {
        font-size: 18px;
        line-height: 1.5;
    }

    .blog-entries .blog-entry p {
        font-size: 13px;
        color: gray;
    }

    .blog-entries .post-meta {
        font-size: 14px;
        color: #b3b3b3;
    }

    .blog-entries .post-meta .author img {
        width: 30px;
        border-radius: 50%;
        display: inline-block;
    }

    .site-cover {
        background-size: cover;
        background-position: top center;
        position: relative;
    }

    .site-cover>.container {
        position: relative;
        z-index: 2;
    }

    .site-cover.overlay:before {
        background: rgba(0, 0, 0, 0.6);
        position: absolute;
        content: "";
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 1;
    }

    .site-cover .post-meta {
        color: #fff;
    }

    .site-cover,
    .site-cover .same-height {
        padding: 3em 0;
    }

    .site-cover.single-page h1,
    .site-cover.single-page .h1 {
        color: #fff;
        font-size: clamp(2rem, 3vw, 5rem);
    }

    .custom-pagination span,
    .custom-pagination a {
        text-decoration: none;
        text-align: center;
        display: inline-block;
        width: fit-content;
        width: 30px;
        height: 30px;

        line-height: 30px;
        /* border-radius: 50%; */
    }

    .custom-pagination a:last-child {
        padding: 0 10px;
        width: fit-content;
        /* display: block; */
    }

    .custom-pagination a {
        background: hsl(88, 23%, 59%);
        color: #fff;
    }

    .custom-pagination a:hover {
        background: hsl(88, 23%, 59%);
    }

    .img-fluid {
        max-width: 100%;
        height: auto;
    }
</style>

@extends('layouts.app')
@section('title', 'View Product')
@section('content')


    <div class="site-cover site-cover-sm same-height overlay single-page"
        style="background-image: url('img/gift-tips-baner.jpg')">
        <div class="container">
            <div class="row same-height justify-content-center">
                <div class="col-md-6">
                    <div class="post-entry text-center">
                        <h1 class="mb-4">Blog</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="container">
            <div class="row mb-4">
                <div class="col-sm-6"></div>
                <div class="col-sm-6 text-sm-end"></div>
            </div>
                    <div class="row">
                        <div class="col-lg-4 mb-4" style="display: flex;">

                            @foreach ($blogs as $blog)
                            <div class="post-entry-alt border px-2 pt-2 rounded-4" style="max-height: 320px;min-width: 230px;max-width: 232px; margin: 10px;">
                                <a href="{{ route('single_blog', ['blog_id' => $blog->blog_id]) }}" class="img-link">
                                    @foreach ($blog_imgs as $blog_image)
                                        @if ($blog->blog_id == $blog_image->blog_id)
                                            <img style="width:220px; height: 150px;" src="{{ $blog_image->url }}" alt="Image" class="img-fluid" />
                                            @break
                                        @endif
                                    @endforeach
                                </a>
                                <div class="excerpt">
                                    <h2>
                                        <a href="#" class="nav-link">{{ $blog->hastag }}</a>
                                    </h2>
                                    <div class="post-meta align-items-center text-left clearfix">
                                        <figure class="author-figure mb-0 me-3 float-start">
                                            <img style="object-fit: cover;" src="{{ $blog_image->url }}" alt="Author Image" class="img-fluid" />
                                        </figure>
                                        <span class="d-inline-block mt-1">By <a href="#">David Anderson</a></span>
                                        <span>&nbsp;-&nbsp; {{ $blog->date }}</span>
                                    </div>

                                    <p style="height: 100%; width: 100%; overflow: hidden">
                                        {{-- {{ Str::limit($blog->content, 16, '...') }} --}}
                                        {{ $blog->hagtag }}
                                    </p>
                                    <p class="d-flex justify-content-center align-content-center">
                                        <button type="button" class="btn btn-primary"
                                            style="
                                                background-color: hsl(88, 23%, 59%);
                                                border: none;
                                                outline: none;
                                            ">
                                            Reading
                                        </button>
                                    </p>
                                </div>
                            </div>
                        @endforeach
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center align-content-center">
            <div class="col-lg-6">
                <div class="row text-start p-2">
                    <div class="col-md-12 d-flex justify-content-center align-content-center">
                        <div class="custom-pagination">
                            <span>1</span>
                            <a href="#">2</a>
                            <a href="#">3</a>
                            <a href="#">4</a>
                            <span>...</span>
                            <a href="#">Next</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
