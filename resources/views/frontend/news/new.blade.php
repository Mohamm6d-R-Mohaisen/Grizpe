@extends('frontend.layout')

@section('content')
    <main id="primary" class="site-main">
        <!-- start: Breadcrumb Section -->
        <section class="tj-page-header" data-bg-image="@if(isset($galary_main->image))@endif">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="tj-page-header-content text-center">
                            <h1 class="tj-page-title">Read Blog</h1>
                            <div class="tj-page-link">
                                <span><i class="tji-home"></i></span>
                                <span>
                  <a href="{{route('home')}}">Home</a>
                </span>
                                <span>/</span>
                                <span>
                  <span>Blog</span>
                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end: Breadcrumb Section -->
    <!-- start: Blog Section -->
    <section class="tj-blog-section section-gap">
        <div class="container">
            <div class="row row-gap-5">
                <div class="col-lg-8">
                    <div class="blog-wrapper">
                        @foreach($blogs as $blog)
                        <article class="blog-item">
                            <div class="blog-thumb">
                                <a href="{{route('news_detail',$blog->id)}}"><img src="{{$blog->image}}" alt=""></a>
                                <span class="categories"><a href="{{route('news_detail',$blog->id)}}">Electrical</a></span>
                            </div>
                            <div class="blog-content">
                                <div class="blog-meta">
                                    <span>By <a href="{{route('news_detail',$blog->id)}}">{{$blog->author_name}}</a></span>
                                    <span>{{ $blog->created_at->format('F j, Y') }}</span>
                                </div>
                                <h3 class="title"><a href="{{route('news_detail',$blog->id)}}">{{$blog->title}}</a></h3>
                                <p class="desc">{{$blog->short_description}}.</p>
                                <a class="read-more" href="{{route('news_detail',$blog->id)}}"><span>Read More</span><i
                                        class="tji-arrow-right"></i></a>
                            </div>
                        </article>
                            @endforeach
                        <div class="tj-pagination d-flex">

                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="tj-main-sidebar">
                        <div class="tj-sidebar-widget widget-search" data-bg-image="assets/images/shape/box-pattern.webp">
                            <h4 class="widget-title">Search here</h4>
                            <div class="search-box">
                                <form action="#">
                                    <input type="search" name="search" id="searchTwo" placeholder="Search here">
                                    <button type="submit" value="search">
                                        <i class="tji-search"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="tj-sidebar-widget tj-recent-posts" data-bg-image="assets/images/shape/box-pattern.webp">
                            <h4 class="widget-title">Related post</h4>
                            <ul>
                                @foreach($related as $blog)
                                <li>
                                    <div class="post-thumb">
                                        <a href="{{route('news_detail',$blog->id)}}"> <img src="{{$blog->image}}" alt="Blog"></a>
                                    </div>
                                    <div class="post-content">
                                        <h5 class="post-title">
                                            <a href="{{route('news_detail',$blog->id)}}">{{$blog->title}}</a>
                                        </h5>
                                        <div class="blog-meta">
                                            <ul>
                                                <li>{{ $blog->created_at->format('F j, Y') }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                    @endforeach
                            </ul>
                        </div>
                        <div class="tj-sidebar-widget widget-categories" data-bg-image="assets/images/shape/box-pattern.webp">
                            <h4 class="widget-title">Categories</h4>
                            <nav>
                                <ul>
                                    @foreach($blogs as $blog)
                                    <li><a href="{{route('news_detail',$blog->id)}}">{{$blog->category->name}}<span class="number">(03)</span></a></li>
                                        @endforeach
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end: Blog Section -->

    <!-- start: Cta Section -->
    <section class="tj-cta-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="cta-area" data-bg-image="assets/images/shape/cta-bg.webp">
                        <div class="sec-heading">
                            <h2 class="sec-title"><span>Light Up</span> Your Space <br> Call Us Now!</h2>
                            <a class="call-btn" href="tel:123456987"><i class="tji-phone"></i></a>
                        </div>
                        <div class="cta-img" data-bg-image="@if(isset( $galary_footer->image))@endif"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end: Cta Section -->
@endsection
