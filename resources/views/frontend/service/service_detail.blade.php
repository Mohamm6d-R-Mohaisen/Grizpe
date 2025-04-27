
@extends('frontend.layout')

@section('content')

    <main id="primary" class="site-main">
        <!-- start: Breadcrumb Section -->
        <section class="tj-page-header" data-bg-image="="@if(isset($galary_main->image))@endif">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="tj-page-header-content text-center">
                            <h1 class="tj-page-title">Service Details</h1>
                            <div class="tj-page-link">
                                <span><i class="tji-home"></i></span>
                                <span>
                  <a href="{{route('home')}}">Home</a>
                </span>
                                <span>/</span>
                                <span>
                  <span>Service Details</span>
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
                                <img src="{{$service->image}}" alt="Images">
                            </div>
                            <h2 class="title">{{$service->title}}</h2>
                            <div class="blog-text">
                                <p>{{$service->description}}.</p>

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
                                <p>{{$service->short_description}}.</p>

                                <h3>FREQUENTLY ASKED QUESTIONS</h3>
                                <div class="accordion tj-faq" id="faqOne">
                                    @foreach($questions as $question)
                                        <div class="accordion-item">
                                            <button class="faq-title collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-6"
                                                    aria-expanded="false">{{$question->title}}</button>
                                            <div id="faq-6" class="collapse" data-bs-parent="#faqOne">
                                                <div class="accordion-body faq-text">
                                                    <p>{{$question->description}}.</p>
                                                </div>
                                            </div>
                                            <div class="faq-bg" data-bg-image="assets/images/shape/faq-item-bg.webp"></div>
                                        </div>
                                    @endforeach

                                </div>

                            </div>
                            <div class="tj-post__navigation mb-0" data-bg-image="assets/images/shape/faq-item-bg.webp">
                                <!-- previous post -->
                                <div class="tj-nav__post previous">
                                    <div class="tj-nav-post__nav prev_post">
                                        <a href="service-details.html"><span><i class="tji-arrow-left"></i></span>Previous</a>
                                    </div>
                                </div>
                                <div class="tj-nav-post__grid">
                                    <i class="tji-window"></i>
                                </div>
                                <!-- next post -->
                                <div class="tj-nav__post next">
                                    <div class="tj-nav-post__nav next_post">
                                        <a href="service-details.html">Next<span><i class="tji-arrow-right"></i></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="tj-main-sidebar">
                            <div class="tj-sidebar-widget widget-categories" data-bg-image="assets/images/shape/box-pattern.webp">
                                <h4 class="widget-title">More services</h4>
                                <nav>
                                    <ul>
                                        @foreach($services as $service)
                                        <li><a href="{{route('services_detail',$service->id)}}">{{$service->title}}<span class="icon"><i
                                                        class="tji-arrow-right"></i></span></a></li>
                                            @endforeach
                                    </ul>
                                </nav>
                            </div>
                            <div class="tj-sidebar-widget widget-feature-item" data-bg-image="assets/images/shape/box-pattern.webp">
                                <div class="feature-box">
                                    <div class="feature-content">
                                        <h2 class="title">Modern</h2>
                                        <span>Home Makeover</span>
                                        <a class="read-more feature-contact" href="tel:8321890640">
                                            <i class="tji-phone"></i>
                                            <span>+8 (321) 890-640</span>
                                        </a>
                                    </div>
                                    <div class="feature-images" data-bg-image="assets/images/services/service-ad.webp"></div>
                                </div>
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
