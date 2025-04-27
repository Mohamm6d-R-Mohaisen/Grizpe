@extends('frontend.layout')

@section('content')

    <main id="primary" class="site-main">
        <!-- start: Breadcrumb Section -->
        <section class="tj-page-header" data-bg-image="@if(isset($galary_main->image))@endif">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="tj-page-header-content text-center">
                            <h1 class="tj-page-title">Blog Details</h1>
                            <div class="tj-page-link">
                                <span><i class="tji-home"></i></span>
                                <span>
                  <a href="{{route('home')}}">Home</a>
                </span>
                                <span>/</span>
                                <span>
                  <span>Blog Details</span>
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
                    <div class="post-details-wrapper">
                        <div class="blog-images">
                            <img src="{{$blog->image}}" alt="Images">
                        </div>
                        <h2 class="title">{{$blog->title}}</h2>
                        <div class="blog-category-two">
                            <div class="category-item">

                                <div class="cate-text">
                                    <span class="degination">Authored by</span>
                                    <h6 class="title"><a href="blog-details.html">{{$blog->author_name}}</a></h6>
                                </div>
                            </div>
                            <div class="category-item">
                                <div class="cate-icons">
                                    <i class="tji-calendar"></i>
                                </div>
                                <div class="cate-text">
                                    <span class="degination">Date Released</span>
                                    <h6 class="text">{{ $blog->created_at->format('F j, Y') }}</h6>
                                </div>
                            </div>
                            <div class="category-item">
                                <div class="cate-icons">
                                    <i class="tji-comment"></i>
                                </div>
                                <div class="cate-text">
                                    <span class="degination">Comments</span>
                                    <h6 class="text">{{ count($comments) }} Comments</h6>
                                </div>
                            </div>
                        </div>
                        <div class="blog-text">
                            <p>{{$blog->description}}.</p>
                                <cite>Kevin Hooks</cite>
                            </blockquote>
                            <h3>KEY LESSONS OF ELECTRICALS</h3>
                            <p>{{$blog->lessons}}.</p>
                            <div class="images-wrap">
                                <div class="row">
                                    @foreach($galary_slider as $galary)
                                    <div class="col-sm-6">
                                        <div class="image-box">
                                            <img src="{{$galary->image}}" alt="Image">
                                        </div>
                                    </div>
                                        @endforeach
                                </div>
                            </div>


                            <h3>CONCLUSIONS</h3>
                            <p>{{$blog->conclusions}}.</p>
                        </div>

                        <div class="tj-post__navigation" data-bg-image="assets/images/shape/faq-item-bg.webp">
                            <!-- previous post -->
                            <div class="tj-nav__post previous">
                                <div class="tj-nav-post__nav prev_post">
                                    <a href="blog-details.html"><span><i class="tji-arrow-left"></i></span>Previous</a>
                                </div>
                            </div>
                            <div class="tj-nav-post__grid">
                                <i class="tji-window"></i>
                            </div>
                            <!-- next post -->
                            <div class="tj-nav__post next">
                                <div class="tj-nav-post__nav next_post">
                                    <a href="blog-details.html">Next<span><i class="tji-arrow-right"></i></span></a>
                                </div>
                            </div>
                        </div>

                        <div class="tj-comments-container">
                            <div class="tj-comments-wrap">
                                <div class="comments-title">
                                    <h3 class="title">Top Comments </h3>
                                </div>
                                <div class="tj-latest-comments">
                                    <ul>
                                        @foreach($comments as $comment)
                                        <li class="tj-comment">
                                            <div class="comment-content">

                                                <div class="comments-header">
                                                    <div class="avatar-name">
                                                        <h5 class="title">
                                                            <a href="blog-details.html">{{$comment->full_name}}</a>
                                                        </h5>
                                                    </div>
                                                    <div class="comment-text">
                                                        <span class="date">{{ $comment->created_at->format('F j, Y') }}</span>
                                                        <a class="reply" href="blog-details.html">Reply</a>
                                                    </div>
                                                    <div class="desc">
                                                        <p>"{{$comment->comment}}!"</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                            @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="tj-comments__container">
                                <div class="comment-respond">
                                    <h3 class="comment-reply-title">Leave a Comment</h3>
                                    <div class="row">
                                        <form id="kt_form" class="form row d-flex flex-column flex-lg-row addForm"
                                              action="{{route('admin.comments.store')}}" method="post">
                                            @csrf
                                            <input type="hidden" name="blog_id" value="{{$blog->id}}">
                                        <div class="col-lg-12">
                                            <div class="form-input">
                                                <textarea id="comment" name="comment" placeholder="Write Your Comment *"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-input">
                                                <input type="text" id="name" name="full_name" placeholder="Full Name *" required="">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-input">
                                                <input type="email" id="emailOne" name="email" placeholder="Your Email *" required="">
                                            </div>
                                        </div>

                                        <div class="comments-btn">
                                            <button class="tj-primary-btn" type="submit" data-text="Submit now">
                                                <span class="btn-text">Submit now</span>
                                                <span><i class="tji-spark"></i></span>
                                            </button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
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
                                    @foreach($categories as $catogary)
                                    <li><a href="">{{$catogary->name}}</span></a></li>
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


@endsection
