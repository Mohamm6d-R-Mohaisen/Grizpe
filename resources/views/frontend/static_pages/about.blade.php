@extends('frontend.layout')

@section('content')

    <main id="primary" class="site-main">
        <!-- start: Breadcrumb Section -->
        <section class="tj-page-header" data-bg-image="@if(isset($galary_main->image))@endif">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="tj-page-header-content text-center">
                            <h1 class="tj-page-title">About Us</h1>
                            <div class="tj-page-link">
                                <span><i class="tji-home"></i></span>
                                <span>
                  <a href="{{route('home')}}">Home</a>
                </span>
                                <span>/</span>
                                <span>
                  <span>About Us</span>
                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end: Breadcrumb Section -->

        <!-- start: About Section -->
        <section class="tj-about-section section-gap">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xxl-7 col-lg-6 col-md-12 order-lg-1 order-2">
                        <div class="about-img-area wow fadeInUp" data-wow-delay=".3s">
                            <div class="about-img">
                                <img src="{{ isset($slider_about->image) ? $slider_about->image :
            "assets/images/about/about-1.webp" }}" alt="">
                            </div>
                            @foreach($galarys_about as $galary )
                                <div class="about-img">
                                    <img src="{{$galary->image}}" alt="">
                                </div>
                            @endforeach
                            <div class="circle-text-wrap">
                                <span class="circle-text" data-bg-image="assets/images/about/about-circle-text.webp"></span>
                                <span class="logo-icon"><img src="assets/images/logos/logo-icon.webp" alt=""></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-5 col-lg-6 col-md-12 order-lg-2 order-1">
                        <div class="about-content-area">
                            <div class="sec-heading wow fadeInUp" data-wow-delay=".3s">
                                <span class="sub-title"><i class="tji-switch-on"></i>ABOUT OUR COMPANY Gripz</span>
                                <h2 class="sec-title">{{ isset($slider_about->title) ? $slider_about->title :''}}.</h2>
                            </div>
                            <div class="about-content wow fadeInUp" data-wow-delay=".5s">
                                <p class="desc">{{ isset($slider_about->description) ? $slider_about->description :''}}.</p>
                                <div class="about-info">
                                    <div class="info-left">

                                        <a class="tj-primary-btn" href="{{route('about')}}" data-text="Learn More">
                                            <span class="btn-text">Learn More</span>
                                            <span class="btn-icon pulse"><i class="tji-spark"></i></span>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end: About Section -->

        <!-- start: Achievement Section -->
        <section class="tj-achievement-section section-gap" data-bg-image="assets/images/shape/pattern-bg.webp">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="sec-heading text-center wow fadeInUp" data-wow-delay=".3s">
                            <span class="sub-title"><i class="tji-switch-on"></i>Award Showcase</span>
                            <h2 class="sec-title">Explore <span>ACHIEVEMENTS</span></h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="testimonial-wrapper wow fadeInUp" data-wow-delay=".4s">
                            <div class="swiper swiper-container achievement-slider">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="achievement-item">
                                            <div class="achievement-inner">
                                                <div class="achievement-year">
                                                    2020
                                                    <span></span>
                                                </div>
                                                <div class="achievement-content">
                                                    <h5 class="title">Project Completion</h5>
                                                    <div class="desc">
                                                        <p>Successfully completed 15 major projects, showcasing our ability to deliver high-quality
                                                            construction services on time and within budget. These projects ranged from innovative
                                                            commercial modern.</p>
                                                    </div>
                                                    <a class="read-more" href="#"><span>Read More</span><i class="tji-arrow-right"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="achievement-item">
                                            <div class="achievement-inner">
                                                <div class="achievement-year">
                                                    2022
                                                    <span></span>
                                                </div>
                                                <div class="achievement-content">
                                                    <h5 class="title">Sustainability Initiatives</h5>
                                                    <div class="desc">
                                                        <p>Made significant strides in our commitment to sustainability by achieving a 30% increase
                                                            in the use of eco-friendly materials across all our projects. This initiative not only
                                                            reduced.</p>
                                                    </div>
                                                    <a class="read-more" href="#"><span>Read More</span><i class="tji-arrow-right"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="achievement-item">
                                            <div class="achievement-inner">
                                                <div class="achievement-year">
                                                    2024
                                                    <span></span>
                                                </div>
                                                <div class="achievement-content">
                                                    <h5 class="title">Safety Record</h5>
                                                    <div class="desc">
                                                        <p>Celebrated 365 consecutive days without a safety incident on any job site. This
                                                            accomplishment reflects our unwavering dedication to maintaining the highest safety
                                                            standards for our team.</p>
                                                    </div>
                                                    <a class="read-more" href="#"><span>Read More</span><i class="tji-arrow-right"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-pagination-area"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end: Achievement Section -->

        <!-- start: Team Section -->
        <section class="tj-team-section team-2">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="sec-heading-wrap wow fadeInUp" data-wow-delay=".3s">
                            <span class="sub-title"><i class="tji-switch-on"></i>Meet Our Expert</span>
                            <div class="heading-wrap-content">
                                <div class="sec-heading">
                                    <h2 class="sec-title">Skilled, Certified, and Dedicated <span>Teams</span></h2>
                                </div>
                                <div class="btn-wrap">
                                    <a class="tj-primary-btn" href="about.html" data-text="More member">
                                        <span class="btn-text">More member</span>
                                        <span class="btn-icon"><i class="tji-spark"></i></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach($team as $team)
                    <div class="col-lg-3 col-sm-6">
                        <div class="team-item wow fadeInUp" data-wow-delay=".4s">
                            <div class="team-img">
                                <img src="{{$team->image}}" alt="">
                                <div class="social-links style-2">
                                    <ul>
                                        <li><a href="https://www.facebook.com/" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
                                        </li>
                                        <li><a href="https://www.instagram.com/" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                                        </li>
                                        <li><a href="https://www.linkedin.com/" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a>
                                        </li>
                                        <li><a href="https://x.com/" target="_blank"><i class="fa-brands fa-x-twitter"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="team-content">
                                <h5 class="title">{{$team->title}}</h5>
                                <span class="designation">{{$team->description}}</span>
                            </div>
                        </div>
                    </div>
                        @endforeach
                </div>
            </div>
        </section>
        <!-- end: Team Section -->

        <!-- start: Testimonial Section -->
        <section class="tj-testimonial-section section-gap" data-bg-image="assets/images/shape/pattern-bg.webp">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-12">
                        <div class="sec-heading text-center wow fadeInUp" data-wow-delay=".3s">
                            <span class="sub-title"><i class="tji-switch-on"></i>Client testimonials</span>
                            <h2 class="sec-title">Customer Reviews & <span>Testimonials</span></h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="testimonial-area">
                            <div class="testimonial-img wow fadeInUp" data-wow-delay=".3s">
                                <img src="{{$galary_aside->image}}" alt="">
                            </div>
                            <div class="testimonial-navigation style-2 d-inline-flex wow fadeInUp" data-wow-delay=".4s">
                                <div class="slider-prev">
                  <span class="anim-icon">
                    <i class="tji-arrow-left"></i>
                    <i class="tji-arrow-left"></i>
                  </span>
                                </div>
                                <div class="slider-next">
                  <span class="anim-icon">
                    <i class="tji-arrow-right"></i>
                    <i class="tji-arrow-right"></i>
                  </span>
                                </div>
                            </div>
                            <div class="testimonial-wrapper-2 wow fadeIn" data-wow-delay=".4s">
                                <div class="swiper swiper-container testimonial-slider-2">
                                    <div class="swiper-wrapper">
                                        @foreach($revies as $review)
                                        <div class="swiper-slide">
                                            <div class="testimonial-item">
                                                <div class="testimonial-author">
                                                    <div class="author-inner">
                                                        <div class="author-img">
                                                            <img src="{{$review->image}}" alt="">
                                                        </div>
                                                        <div class="author-header">
                                                            <h6 class="title">{{$review->name}}</h6>
                                                            <span class="designation">Marketing Co.</span>
                                                        </div>
                                                    </div>
                                                    <span class="quote-icon"><i class="tji-quote"></i></span>
                                                </div>
                                                <div class="desc">
                                                    <p>“{{$review->comment}}.”</p>
                                                </div>
                                                <div class="star-ratings">
                                                    <div class="fill-ratings" style="width: {{ $review->rating * 20 }}%">
                                                        <span>★★★★★</span>
                                                    </div>
                                                    <div class="empty-ratings">
                                                        <span>★★★★★</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                            @endforeach
                                    </div>
                                    <div class="swiper-pagination-area d-none"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end: Testimonial Section -->

        <!-- start: Faq Section -->
        <section class="tj-faq-section section-gap">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-xxl-4 col-lg-5">
                        <div class="content-wrap wow fadeInUp" data-wow-delay=".3s">
                            <div class="sec-heading">
                                <span class="sub-title"><i class="tji-switch-on"></i>Read our faq</span>
                                <h2 class="sec-title">Got <span>Questions?</span> We Have Got Answer</h2>
                            </div>
                            <p class="desc">Discover the Difference with Electric <br> Services. Your Trusted Local.</p>
                            <a class="tj-primary-btn" href="contact.html" data-text="Contact us">
                                <span class="btn-text">Contact us</span>
                                <span class="btn-icon pulse"><i class="tji-spark"></i></span>
                            </a>
                        </div>
                    </div>
                    <div class="col-xxl-7 col-lg-7">
                        <div class="accordion tj-faq wow fadeInUp" data-wow-delay=".4s" id="faqOne">
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
                </div>
            </div>
        </section>
        <!-- end: Faq Section -->

        <!-- start: Cta Section -->
        <section class="tj-cta-section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="cta-area wow fadeInUp" data-wow-delay=".3s" data-bg-image="assets/images/shape/cta-bg.webp">
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
