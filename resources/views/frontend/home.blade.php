
@extends('frontend.layout')

@section('content')
<main id="primary" class="site-main overflow-x-hidden">
    <!-- start: Banner -->
    <section class="tj-banner-section" data-bg-image="assets/images/shape/hero-pattern-bg.webp">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="banner-area">
                        <div class="banner-content">
                <span class="sub-title wow fadeInUp" data-wow-delay=".2s">
                  <img src="assets/images/hero/green-check.webp" alt="">100% WORKMANSHIP GUARANTEE
                </span>
                            <h1 class="banner-title wow fadeInUp" data-wow-delay=".4s">  {{$sliders_home->title}}.</h1>

                            <div class="banner-desc wow fadeInUp" data-wow-delay=".6s">
                                {{$sliders_home->description}}
                            </div>
                            <div class="banner-btn-area wow fadeInUp" data-wow-delay=".8s">
                                <div class="btn-link">
                                    <a class="tj-primary-btn" href="{{route('contacts')}}" data-text="Learn More">
                                        <span class="btn-text">Learn More</span>
                                        <span class="btn-icon pulse"><i class="tji-spark"></i></span>
                                    </a>
                                </div>
                                <div class="video-btn-area">
                                    <div class="video-area">
                                        <a class="video-btn video-popup" data-autoplay="true" data-vbtype="video" data-maxwidth="1200px"
                                           href="https://www.youtube.com/watch?v=MLpWrANjFbI&ab_channel=eidelchteinadvogados">
                        <span class="play-btn">
                          <span class="play-icon"><i class="tji-play"></i></span>
                        </span>
                                            <span class="video-text">How We Work</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="banner-img wow fadeInUp" data-wow-delay=".5s">
            <img src="  {{$sliders_home->image}}" alt="">
        </div>
        <div class="banner-shape wow fadeInUp" data-wow-delay=".3s">
            <img src="assets/images/shape/hero-shape.svg" alt="">
        </div>
        <div class="banner-rating-area wow fadeIn" data-wow-delay=".5s">
            <img src="assets/images/hero/google.webp" alt="">
            <div class="vertical-star-ratings">
                <div class="vertical-fill-ratings" style="height: 80%">
                    <span>★★★★★</span>
                </div>
                <div class="empty-ratings">
                    <span>★★★★★</span>
                </div>
            </div>
            <div class="rating-text">4.5 Star(80)</div>
        </div>
        <div class="banner-scroll">
            <a href="#chose" class="scroll-down">
                <span></span>
                Scroll
            </a>
        </div>
    </section>
    <!-- end: Banner -->

    <!-- start: Consult Area -->
    <section class="tj-consult-section wow fadeInUp" data-wow-delay="1s" data-wow-duration=".8s">
        <div class="container consult-container">
            <div class="row">
                <div class="col">
                    <div class="consult-area" data-bg-image="assets/images/shape/consult-bg.webp">
                        <div class="consult-inner">
                            <h4 class="title">Consultation Here!</h4>
                            <form action="#">
                                <div class="consult-form">
                                    <div class="consult-col">
                                        <div class="form-input">
                                            <input type="text" name="name" placeholder="Enter Full Name*">
                                        </div>
                                        <div class="form-input">
                                            <input type="email" name="email" placeholder="Enter Email*">
                                        </div>
                                    </div>
                                    <div class="consult-col">
                                        <div class="form-input">
                                            <input type="tel" name="phone" placeholder="Enter Phone*">
                                        </div>
                                        <div class="form-input">
                                            <div class="tj-nice-select-box">
                                                <div class="tj-select">
                                                    <select name="service">
                                                        <option value="0">Select Service*</option>
                                                        <option value="1">Electrical Installations</option>
                                                        <option value="2">Repairs and Maintenance</option>
                                                        <option value="3">Home Automation</option>
                                                        <option value="4">Energy Solutions</option>
                                                        <option value="5">Lighting Solutions</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="consult-col">
                                        <div class="form-input">
                                            <textarea name="message" id="message" placeholder="Type Message*"></textarea>
                                        </div>
                                    </div>
                                    <button class="circle-send-btn" type="submit">
                                        <span class="circle-text" data-bg-image="assets/images/shape/circle-text.webp"></span>
                                        <span><i class="tji-paper-plane"></i></span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end: Consult Area -->

    <!-- start: Chose Area -->
    <section id="chose" class="tj-chose-section section-gap chose-1">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="sec-heading text-center wow fadeInUp" data-wow-delay=".3s">
                        <span class="sub-title"><i class="tji-switch-on"></i>Reason to chose us</span>
                        <h2 class="sec-title">Wavering <span>Commitment</span> to Excellence.</h2>
                    </div>
                </div>
            </div>
            <div class="row row-gap-4">
                <div class="col-xl-3 col-sm-6">
                    <div class="chose-box wow fadeInUp" data-wow-delay=".4s">
                        <div class="chose-icon">
                            <i class="tji-human"></i>
                        </div>
                        <div class="chose-content">
                            <h5 class="title">Full Range of Electrical Services</h5>
                            <p class="desc">Handyman projects often focus on immediate needs, such as repairing broken fixtures.</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="chose-box wow fadeInUp" data-wow-delay=".5s">
                        <div class="chose-icon">
                            <i class="tji-badge-check-2"></i>
                        </div>
                        <div class="chose-content">
                            <h5 class="title">Skilled & Experienced Electricians</h5>
                            <p class="desc">Handyman projects often focus on immediate needs, such as repairing broken fixtures.</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="chose-box wow fadeInUp" data-wow-delay=".6s">
                        <div class="chose-icon">
                            <i class="tji-community"></i>
                        </div>
                        <div class="chose-content">
                            <h5 class="title">Commitment to Safety and Quality</h5>
                            <p class="desc">Handyman projects often focus on immediate needs, such as repairing broken fixtures.</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="chose-box wow fadeInUp" data-wow-delay=".7s">
                        <div class="chose-icon">
                            <i class="tji-time"></i>
                        </div>
                        <div class="chose-content">
                            <h5 class="title">Reliable & On-Time Service</h5>
                            <p class="desc">Handyman projects often focus on immediate needs, such as repairing broken fixtures.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end: Chose Area -->

    <!-- start: Client Section -->
    <section class="tj-client-section">
        <div class="container-fluid client-container">
            <div class="row">
                <div class="col">
                    <div class="swiper client-slider wow fadeInUp" data-wow-delay=".5s">
                        <div class="swiper-wrapper">
                            @if(!$galarys_home)
                                <div class="swiper-slide">
                                    <div class="client-item-box">
                                        <div class="client-item" data-bg-image="assets/images/shape/box-pattern.webp">
                                            <div class="client-logo">
                                                <img src="assets/images/brands/brand-1.webp" alt="No Image Available">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                @foreach($galarys_home as $galary)
                                    <div class="swiper-slide">
                                        <div class="client-item-box">
                                            <!-- الصورة الأساسية -->
                                            <div class="client-item" data-bg-image="{{ asset($galary->image )}}">
                                                <div class="client-logo">
                                                    <img src="{{ asset($galary->image) }}" alt="">
                                                </div>
                                            </div>
                                            <!-- الصورة عند التحويم -->
                                            <div class="client-item hover" data-bg-image="{{ asset($galary['image'] ?? $image->image) }}">
                                                <div class="client-logo">
                                                    <img src="{{ asset($galary['image'] ?? $galary->image) }}" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end: Client Section -->

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

    <!-- start: Service Section -->
    <section class="tj-service-section section-gap" data-bg-image="assets/images/shape/pattern-bg.webp">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="sec-heading text-center wow fadeInUp" data-wow-delay=".3s">
                        <span class="sub-title"><i class="tji-switch-on"></i>OUR SERVICES</span>
                        <h2 class="sec-title">Our Reliable <span>Services</span> Electrical Solo.</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="service-wrapper">
                        @foreach($services as $service)
                        <div class="service-item wow fadeInUp" data-wow-delay=".3s">
                            <div class="service-content-wrap">
                                <div class="service-title">
                                    <div class="service-icon">
                                        <i class="tji-plug"></i>
                                    </div>
                                    <h5 class="title">
                                        <a href="service-details.html">{{$service->title}}</a>
                                    </h5>
                                </div>
                                <div class="service-content">
                                    <p class="desc">{{$service->description}}.</p>
                                    <div class="service-arrow">
                                        <a href="{{route('services')}}"><i class="tji-arrow-long"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="service-reveal-bg" data-bg-image="{{$service->image}}"></div>
                        </div>
                            @endforeach
                    </div>
                    <div class="service-btn-area text-center wow fadeInUp" data-wow-delay=".3s">
                        <a class="tj-primary-btn" href="{{route('services')}}" data-text="Learn More">
                            <span class="btn-text">Learn More</span>
                            <span class="btn-icon pulse"><i class="tji-spark"></i></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end: Service Section -->

    <!-- start: Marquee Section -->
    <section class="tj-marquee-section">
        <div class="marquee-wrapper">
            <div class="swiper marquee-slider">
                <div class="swiper-wrapper marquee-wrapper">
                    <div class="swiper-slide marquee-item">
                        <h4 class="marquee-text">Reliable</h4>
                        <div class="marquee-icons">
                            <i class="tji-marquee-icon"></i>
                        </div>
                    </div>
                    <div class="swiper-slide marquee-item">
                        <h4 class="marquee-text">Affordable</h4>
                        <div class="marquee-icons">
                            <i class="tji-marquee-icon"></i>
                        </div>
                    </div>
                    <div class="swiper-slide marquee-item">
                        <h4 class="marquee-text">Electrical</h4>
                        <div class="marquee-icons">
                            <i class="tji-marquee-icon"></i>
                        </div>
                    </div>
                    <div class="swiper-slide marquee-item">
                        <h4 class="marquee-text">Reliable</h4>
                        <div class="marquee-icons">
                            <i class="tji-marquee-icon"></i>
                        </div>
                    </div>
                    <div class="swiper-slide marquee-item">
                        <h4 class="marquee-text">Affordable</h4>
                        <div class="marquee-icons">
                            <i class="tji-marquee-icon"></i>
                        </div>
                    </div>
                    <div class="swiper-slide marquee-item">
                        <h4 class="marquee-text">Electrical</h4>
                        <div class="marquee-icons">
                            <i class="tji-marquee-icon"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end: Marquee Section -->

    <!-- start: Work Section -->
    <section class="tj-work-section section-gap">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="sec-heading">
                        <div class="sec-text wow fadeInUp" data-wow-delay=".3s">
                            <span class="sub-title"><i class="tji-switch-on"></i>Our recent work</span>
                            <h2 class="sec-title">Excellence in Every <span>Connection</span></h2>
                        </div>
                        <div class="work-navigation d-none d-sm-inline-flex wow fadeInUp" data-wow-delay=".4s">
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
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="work-wrapper wow fadeInUp" data-wow-delay=".4s">
                        <div class="swiper work-slider">
                            <div class="swiper-wrapper">
                                @foreach($works as $work)
                                    <div class="swiper-slide">
                                        <div class="work-item">
                                            <!-- الصورة الديناميكية -->
                                            <div class="work-img" data-bg-image="{{ asset($work->image) }}"></div>

                                            <!-- محتوى العمل -->
                                            <div class="work-content">
                                                <!-- اسم الخدمة المرتبطة -->
                                                @if($work->service)
                                                    <span class="categories"><a href="#">{{ $work->service->title }}</a></span>
                                                @else
                                                    <span class="categories"><a href="#">No Service</a></span>
                                                @endif

                                                <div class="work-text">
                                                    <!-- عنوان العمل -->
                                                    <h4 class="title">
                                                        <a href="{{ route('work_detail', $work->id) }}">{{ $work->title }}</a>
                                                    </h4>

                                                    <!-- زر التفاصيل -->
                                                    <a class="work-btn" href="{{ route('work_detail', $work->id) }}">
                                                        <i class="tji-arrow-long"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                            <div class="swiper-pagination-area"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end: Work Section -->

    <!-- start: Skill Section -->
    <section class="tj-skill-section section-gap">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-xxl-5 col-xl-6 col-lg-5">
                    <div class="content-wrap wow fadeInUp" data-wow-delay=".3s">
                        <div class="sec-heading">
                            <span class="sub-title"><i class="tji-switch-on"></i>You Can Trust</span>
                            <h2 class="sec-title"><span>Key Skills</span> That Power Our Electricians</h2>
                        </div>
                        <p class="desc">Discover the Difference with Electric Services. Your Trusted Local Experts Electricals
                            Contracting.</p>
                        <a class="tj-primary-btn" href="contact.html" data-text="Learn More">
                            <span class="btn-text">Learn More</span>
                            <span class="btn-icon pulse"><i class="tji-spark"></i></span>
                        </a>
                    </div>
                </div>
                <div class="col-xxl-6 col-xl-6 col-lg-7">
                    <div class="skill-area wow fadeInUp" data-wow-delay=".4s">
                        <div class="skill-item">
                            <div class="skill-info">
                                <div class="circle-big" data-percent="96">
                                    <span>96%</span>
                                    <svg>
                                        <circle class="bg" cx="75" cy="75" r="71"></circle>
                                        <circle class="progress" cx="75" cy="75" r="71"></circle>
                                    </svg>
                                </div>
                                <span class="text">Technical Knowledge</span>
                            </div>
                        </div>
                        <div class="skill-item">
                            <div class="skill-info">
                                <div class="circle-big" data-percent="92">
                                    <span>92%</span>
                                    <svg>
                                        <circle class="bg" cx="75" cy="75" r="71"></circle>
                                        <circle class="progress" cx="75" cy="75" r="71"></circle>
                                    </svg>
                                </div>
                                <span class="text">Problem-Solving Skills</span>
                            </div>
                        </div>
                        <div class="skill-item">
                            <div class="skill-info">
                                <div class="circle-big" data-percent="94">
                                    <span>94%</span>
                                    <svg>
                                        <circle class="bg" cx="75" cy="75" r="71"></circle>
                                        <circle class="progress" cx="75" cy="75" r="71"></circle>
                                    </svg>
                                </div>
                                <span class="text">Attention to Detail</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end: Skill Section -->

    <!-- start: Testimonial Section -->
    <section class="tj-testimonial-section section-gap" data-bg-image="assets/images/shape/pattern-bg.webp">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-12">
                    <div class="sec-heading text-center wow fadeInUp" data-wow-delay=".3s">
                        <span class="sub-title"><i class="tji-switch-on"></i>Client testimonials</span>
                        <h2 class="sec-title">See Why Our Clients Success
                            <span><img src="assets/images/testimonial/profile.webp" alt=""></span>
                            <span>Feedback</span>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="testimonial-wrapper wow fadeInUp" data-wow-delay=".5s">
                        <div class="swiper swiper-container testimonial-slider">
                            <div class="swiper-wrapper">
                                @foreach($reviews as $reviewss)
                                    <div class="swiper-slide">
                                        <div class="testimonial-item">
                                            <!-- صورة الشخص -->
                                            <div class="rating-wrap">
                                                <div class="rating-img">
                                                    <img src="{{ asset($reviewss->image) }}" alt="{{ $reviewss->name }}">
                                                </div>
                                                <div class="rating-area">
                                                    <!-- تقييم الشخص -->
                                                    <div class="star-ratings">
                                                        <div class="fill-ratings" style="width: {{ $reviewss->rating * 20 }}%">
                                                            <span>★★★★★</span>
                                                        </div>
                                                        <div class="empty-ratings">
                                                            <span>★★★★★</span>
                                                        </div>
                                                    </div>
                                                    <div class="rating-text">
                                                        <strong>{{ $reviewss->rating }}</strong> out of 5.00
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- نص الشهادة -->
                                            <div class="desc">
                                                <p>“{{ $reviewss->comment }}”</p>
                                            </div>

                                            <!-- معلومات الشخص -->
                                            <div class="testimonial-author">
                                                <div class="author-header">
                                                    <h6 class="title">{{ $reviewss->name }}</h6>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                            <div class="swiper-pagination-area"></div>
                        </div>
                        <div class="testimonial-navigation d-none d-md-inline-flex">
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

    <!-- start: Blog Section -->
    <section class="tj-blog-section section-gap border-hr">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="sec-heading text-center wow fadeInUp" data-wow-delay=".3s">
                        <span class="sub-title"><i class="tji-switch-on"></i>Recent blog</span>
                        <h2 class="sec-title">Read Our latest <span>Blogs</span></h2>
                    </div>
                </div>
            </div>
            <div class="row row-gap-4">
                @foreach($blogs as $blog)
                <div class="col-lg-4">
                    <div class="blog-item wow fadeInUp" data-wow-delay=".4s">
                        <div class="blog-thumb">
                            <a href="blog-details.html"><img src="{{$blog->image}}" alt=""></a>
                            <span class="categories"><a href="blog-details.html">{{$blog->category->name}}</a></span>
                        </div>
                        <div class="blog-content">
                            <div class="blog-meta">
                                <span>By <a href="blog-details.html">{{$blog->author_name}}</a></span>
                                <span>{{ $blog->created_at->format('F j, Y') }}</span>                            </div>
                            <h5 class="title"><a href="blog-details.html">{{$blog->title}}</a></h5>
                            <a class="read-more" href="blog-details.html"><span>Read More</span><i class="tji-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                    @endforeach
            </div>
        </div>
    </section>
    <!-- end: Blog Section -->

    <!-- start: Cta Section -->
   @foreach($galarys_home_footer as $galary)
    <section class="tj-cta-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="cta-area" data-bg-image="{{asset('assets/images/shape/cta-bg.webp')}}">
                        <div class="sec-heading">
                            <h2 class="sec-title"><span>Light Up</span> Your Space <br> Call Us Now!</h2>
                            <a class="call-btn" href="tel:123456987"><i class="tji-phone"></i></a>
                        </div>
                        <div class="cta-img" data-bg-image="{{$galary->image}}"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end: Cta Section -->
@endforeach
@endsection
