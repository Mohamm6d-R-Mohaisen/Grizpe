@extends('frontend.layout')

@section('content')
    <main id="primary" class="site-main">
        <!-- start: Banner Slider -->
        <section class="tj-slider-section">
            <div class="swiper swiper-container hero-slider">
                <div class="swiper-wrapper">
                    <div class="swiper-slide tj-slider-item">
                        <div class="slider-bg-image" data-bg-image="assets/images/hero/slider-1.webp"></div>
                        <div class="container">
                            <div class="slider-wrapper">
                                <div class="slider-content ">
                                    <h1 class="slider-title">Expert Renovation Service for Home & Offices
                                        <img src="assets/images/hero/title-img.webp" alt="">
                                    </h1>
                                    <div class="slider-desc">From concept to completion, we make sure every detail.</div>
                                    <div class="slider-btn">
                                        <a class="tj-primary-btn" href="contact.html" data-text="Start your project">
                                            <span class="btn-text">Start your project</span>
                                            <span class="btn-icon rotate"><i class="tji-loading"></i></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide tj-slider-item">
                        <div class="slider-bg-image" data-bg-image="assets/images/hero/slider-2.webp"></div>
                        <div class="container">
                            <div class="slider-wrapper">
                                <div class="slider-content ">
                                    <h1 class="slider-title">Superior Home & Office Renovation Service
                                        <img src="assets/images/hero/title-img.webp" alt="">
                                    </h1>
                                    <div class="slider-desc">From concept to completion, we make sure every detail.</div>
                                    <div class="slider-btn">
                                        <a class="tj-primary-btn" href="contact.html" data-text="Start your project">
                                            <span class="btn-text">Start your project</span>
                                            <span class="btn-icon rotate"><i class="tji-loading"></i></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide tj-slider-item">
                        <div class="slider-bg-image" data-bg-image="assets/images/hero/slider-3.webp"></div>
                        <div class="container">
                            <div class="slider-wrapper">
                                <div class="slider-content ">
                                    <h1 class="slider-title">Smart Home & Office Makeover Solutions
                                        <img src="assets/images/hero/title-img.webp" alt="">
                                    </h1>
                                    <div class="slider-desc">From concept to completion, we make sure every detail.</div>
                                    <div class="slider-btn">
                                        <a class="tj-primary-btn" href="contact.html" data-text="Start your project">
                                            <span class="btn-text">Start your project</span>
                                            <span class="btn-icon rotate"><i class="tji-loading"></i></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hero-pagination wow fadeIn" data-wow-delay="1s"></div>
                <div class="hero-navigation wow fadeIn" data-wow-delay="1s">
                    <div class="slider-next">
            <span class="anim-icon">
              <i class="tji-arrow-right"></i>
              <i class="tji-arrow-right"></i>
            </span>
                    </div>
                    <div class="slider-prev">
            <span class="anim-icon">
              <i class="tji-arrow-left"></i>
              <i class="tji-arrow-left"></i>
            </span>
                    </div>
                </div>
            </div>
            <div class="banner-scroll">
                <a href="#about" class="scroll-down">
                    <span></span>
                    Scroll
                </a>
            </div>
        </section>
        <!-- end: Banner Slider -->

        <!-- start: About Section -->
        <section id="about" class="tj-about-section-3 section-gap">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xxl-6 col-lg-6 col-md-12 order-lg-1 order-2">
                        <div class="about-img-area-3">
                            <div class="about-img wow fadeInUp" data-wow-delay=".3s">
                                <img src="assets/images/about/about-5.webp" alt="">
                            </div>
                            <div class="about-img-small wow fadeInUp" data-wow-delay=".5s">
                                <img src="assets/images/about/about-6.webp" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-6 col-lg-6 col-md-12 order-lg-2 order-1">
                        <div class="about-content-area">
                            <div class="sec-heading wow fadeInUp" data-wow-delay=".3s">
                                <span class="sub-title"><i class="tji-loading-2"></i>ABOUT OUR COMPANY Gripz</span>
                                <h2 class="sec-title">Your Trusted Partner in Transforming Spaces & Our Lifestyles.</h2>
                            </div>
                            <div class="about-content wow fadeInUp" data-wow-delay=".5s">
                                <p class="desc">At Gripz, we specialize in providing top-notch renovation services that breathe new life
                                    into your home or business. With years of experience and a passion for craftsmanship, we are dedicated
                                    to delivering personalized high-quality renovations.</p>
                                <div class="about-info">
                                    <div class="info-left">
                                        <div class="check-list">
                                            <ul>
                                                <li><i class="tji-circle-check"></i>Guaranteed Quality</li>
                                                <li><i class="tji-circle-check"></i>Skilled Professionals</li>
                                                <li><i class="tji-circle-check"></i>Experienced Team</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="info-right">
                                        <div class="customers">
                                            <ul>
                                                <li><img src="assets/images/testimonial/client-1.webp" alt=""></li>
                                                <li><img src="assets/images/testimonial/client-2.webp" alt=""></li>
                                                <li><img src="assets/images/testimonial/client-3.webp" alt=""></li>
                                                <li><span><i class="tji-plus"></i></span></li>
                                            </ul>
                                        </div>
                                        <h6 class="title">Join over <span>5000+</span> satisfied customers</h6>
                                    </div>
                                </div>
                                <div class="btn-area">
                                    <a class="tj-primary-btn" href="about.html" data-text="Learn More">
                                        <span class="btn-text">Learn More</span>
                                        <span class="btn-icon rotate"><i class="tji-loading"></i></span>
                                    </a>
                                    <a class="contact-btn style-2" href="tel:5559091313" data-text="(555) 909-1313">
                                        <span class="btn-icon"><i class="tji-phone"></i></span>
                                        <span class="btn-text">(555) 909-1313</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end: About Section -->

        <!-- start: Chose Area -->
        <section class="tj-chose-section section-gap chose-3" data-bg-image="assets/images/shape/pattern-bg.webp">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="work-experience-area">
                            <div class="sec-heading wow fadeInUp" data-wow-delay=".3s">
                                <span class="sub-title"><i class="tji-loading-2"></i>Reason to chose us</span>
                                <h2 class="sec-title">wavering Commitment to Excellence Reliable in Affordable</h2>
                            </div>
                            <div class="experience-wrap wow fadeInUp" data-wow-delay=".5s">
                                <div class="year-count">12</div>
                                <div class="experience-text">
                                    <span><i class="tji-plus"></i></span>
                                    <h6 class="title">Years of Work experience</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="chose-box-area">
                            <div class="row row-gap-4">
                                <div class="col-sm-6">
                                    <div class="chose-box wow fadeInUp" data-wow-delay=".4s">
                                        <div class="chose-icon">
                                            <i class="tji-human"></i>
                                        </div>
                                        <div class="chose-content">
                                            <h5 class="title">Full Range of Electrical Services</h5>
                                            <p class="desc">Handyman projects often focus on immediate needs, such as repairing broken
                                                fixtures.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="chose-box wow fadeInUp" data-wow-delay=".4s">
                                        <div class="chose-icon">
                                            <i class="tji-badge-check-2"></i>
                                        </div>
                                        <div class="chose-content">
                                            <h5 class="title">Skilled & Experienced Electricians</h5>
                                            <p class="desc">Handyman projects often focus on immediate needs, such as repairing broken
                                                fixtures.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="chose-box wow fadeInUp" data-wow-delay=".4s">
                                        <div class="chose-icon">
                                            <i class="tji-community"></i>
                                        </div>
                                        <div class="chose-content">
                                            <h5 class="title">Commitment to Safety and Quality</h5>
                                            <p class="desc">Handyman projects often focus on immediate needs, such as repairing broken
                                                fixtures.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="chose-box wow fadeInUp" data-wow-delay=".4s">
                                        <div class="chose-icon">
                                            <i class="tji-time"></i>
                                        </div>
                                        <div class="chose-content">
                                            <h5 class="title">Reliable & On-Time Service</h5>
                                            <p class="desc">Handyman projects often focus on immediate needs, such as repairing broken
                                                fixtures.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!-- end: Chose Area -->

        <!-- start: Service Section -->
        <section class="tj-service-section section-gap service-3">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="sec-heading text-center wow fadeInUp" data-wow-delay=".3s">
                            <span class="sub-title"><i class="tji-loading-2"></i>OUR SERVICES</span>
                            <h2 class="sec-title">Renovation Services Tailored Needs</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="service-wrapper wow fadeInUp" data-wow-delay=".4s">
                            <div class="swiper swiper-container service-slider">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="service-item style-3">
                                            <div class="service-img">
                                                <img src="assets/images/services/service-2.webp" alt="">
                                            </div>
                                            <div class="service-inner" data-bg-image="assets/images/shape/box-pattern.webp">
                                                <div class="service-icon">
                                                    <i class="tji-rebuild"></i>
                                                </div>
                                                <h5 class="title"><a href="service-details.html">Rebuild & Renovation</a></h5>
                                                <p class="desc">With Van Mier you are in the right place for renovating and rebuilding.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="service-item style-3">
                                            <div class="service-img">
                                                <img src="assets/images/services/service-3.webp" alt="">
                                            </div>
                                            <div class="service-inner" data-bg-image="assets/images/shape/box-pattern.webp">
                                                <div class="service-icon">
                                                    <i class="tji-extensions"></i>
                                                </div>
                                                <h5 class="title"><a href="service-details.html">Extensions & Buildup</a></h5>
                                                <p class="desc">We are your partner in expanding living space and enriching.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="service-item style-3">
                                            <div class="service-img">
                                                <img src="assets/images/services/service-4.webp" alt="">
                                            </div>
                                            <div class="service-inner" data-bg-image="assets/images/shape/box-pattern.webp">
                                                <div class="service-icon">
                                                    <i class="tji-maintenance"></i>
                                                </div>
                                                <h5 class="title"><a href="service-details.html">Maintenance</a></h5>
                                                <p class="desc">We carry out maintenance work through various professional customers.</p>
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
        <!-- end: Service Section -->

        <!-- start: Marquee Section -->
        <section class="tj-marquee-section-2">
            <div class="marquee-wrapper">
                <div class="swiper marquee-slider">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide marquee-item style-2">
                            <div class="marquee-title">
                                <span class="marquee-text">Helps users</span>
                            </div>
                            <div class="marquee-icons">
                                <i class="tji-marquee-icon-2"></i>
                            </div>
                        </div>
                        <div class="swiper-slide marquee-item style-2">
                            <div class="marquee-title">
                                <span class="marquee-text">Builds credibility</span>
                            </div>
                            <div class="marquee-icons">
                                <i class="tji-marquee-icon-2"></i>
                            </div>
                        </div>
                        <div class="swiper-slide marquee-item style-2">
                            <div class="marquee-title">
                                <span class="marquee-text">immediate action</span>
                            </div>
                            <div class="marquee-icons">
                                <i class="tji-marquee-icon-2"></i>
                            </div>
                        </div>
                        <div class="swiper-slide marquee-item style-2">
                            <div class="marquee-title">
                                <span class="marquee-text">Streamlined Process</span>
                            </div>
                            <div class="marquee-icons">
                                <i class="tji-marquee-icon-2"></i>
                            </div>
                        </div>
                        <div class="swiper-slide marquee-item style-2">
                            <div class="marquee-title">
                                <h4 class="marquee-text">Clear Communication</h4>
                            </div>
                            <div class="marquee-icons">
                                <i class="tji-marquee-icon-2"></i>
                            </div>
                        </div>
                        <div class="swiper-slide marquee-item style-2">
                            <div class="marquee-title">
                                <h4 class="marquee-text">Ethics & Integrity</h4>
                            </div>
                            <div class="marquee-icons">
                                <i class="tji-marquee-icon-2"></i>
                            </div>
                        </div>
                        <div class="swiper-slide marquee-item style-2">
                            <div class="marquee-title">
                                <h4 class="marquee-text">We Actually Care</h4>
                            </div>
                            <div class="marquee-icons">
                                <i class="tji-marquee-icon-2"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end: Marquee Section -->

        <!-- start: Working process Section -->
        <div class="tj-working-process" data-bg-image="assets/images/shape/pattern-bg.webp">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="working-process-wrap">
                            <div class="content-wrap wow fadeInUp" data-wow-delay=".3s">
                                <span class="sub-title"><i class="tji-loading-2"></i>How it’s work</span>
                                <div class="sec-heading">
                                    <h2 class="sec-title">Effortless Steps to Get Started Now.</h2>
                                </div>
                                <p class="desc">Discover the Difference with Electric Services. Trusted Expert Electrical Contracting.
                                    Discover Difference with Electric.</p>
                            </div>
                            <div class="accordion tj-faq style-3 wow fadeInUp" data-wow-delay=".5s" id="faqThree">
                                <div class="accordion-item active">
                                    <button class="faq-title" type="button" data-bs-toggle="collapse" data-bs-target="#faq-1"
                                            aria-expanded="true">Consultation & Planning</button>
                                    <div id="faq-1" class="collapse show" data-bs-parent="#faqThree">
                                        <div class="accordion-body faq-text">
                                            <p>Clients discuss their vision, budget, and needs with the remodeling team. The company often
                                                conducts an on-site evaluation to understand.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <button class="faq-title" type="button" data-bs-toggle="collapse" data-bs-target="#faq-2"
                                            aria-expanded="true">Design & Approval</button>
                                    <div id="faq-2" class="collapse" data-bs-parent="#faqThree">
                                        <div class="accordion-body faq-text">
                                            <p>Clients discuss their vision, budget, and needs with the remodeling team. The company often
                                                conducts an on-site evaluation to understand.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <button class="faq-title" type="button" data-bs-toggle="collapse" data-bs-target="#faq-3"
                                            aria-expanded="true">Construction & Completion</button>
                                    <div id="faq-3" class="collapse" data-bs-parent="#faqThree">
                                        <div class="accordion-body faq-text">
                                            <p>Clients discuss their vision, budget, and needs with the remodeling team. The company often
                                                conducts an on-site evaluation to understand.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="working-img-area">
                <div class="working-img wow fadeInUp" data-wow-delay=".3s">
                    <img src="assets/images/work/work-8.webp" alt="">
                </div>
                <div class="circle-text-wrap video-btn">
                    <a class="play-btn video-popup" data-autoplay="true" data-vbtype="video" data-maxwidth="1200px"
                       href="https://www.youtube.com/watch?v=MLpWrANjFbI&ab_channel=eidelchteinadvogados">
                        <span class="play-icon"><i class="tji-play"></i></span>
                    </a>
                    <span class="circle-text" data-bg-image="assets/images/shape/circle-text-2.webp"></span>
                </div>
            </div>
        </div>
        <!-- end: Working process Section -->

        <!-- start: Testimonial Section -->
        <section class="tj-testimonial-section testimonial-2 section-gap">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-12">
                        <div class="sec-heading text-center wow fadeInUp" data-wow-delay=".3s">
                            <span class="sub-title"><i class="tji-loading-2"></i>Client testimonials</span>
                            <h2 class="sec-title">See Why Our Clients Success
                                <span><img src="assets/images/testimonial/profile.webp" alt=""></span>
                                Feedback
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="testimonial-wrapper wow fadeInUp" data-wow-delay=".5s">
                            <div class="swiper swiper-container testimonial-slider">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="testimonial-item" data-bg-image="assets/images/shape/box-pattern.webp">
                                            <div class="rating-wrap">
                                                <div class="rating-img">
                                                    <img src="assets/images/testimonial/google-2.webp" alt="">
                                                </div>
                                                <div class="rating-area">
                                                    <div class="star-ratings">
                                                        <div class="fill-ratings" style="width: 80%">
                                                            <span>★★★★★</span>
                                                        </div>
                                                        <div class="empty-ratings">
                                                            <span>★★★★★</span>
                                                        </div>
                                                    </div>
                                                    <div class="rating-text"><strong>4.5</strong> out of 5.00</div>
                                                </div>
                                            </div>
                                            <div class="desc">
                                                <p>“We couldn’t be happier with our home renovation! From the initial consultation to the final
                                                    touches, the team at Griz was professional, attentive, and truly understood our vision.”</p>
                                            </div>
                                            <div class="testimonial-author">
                                                <div class="author-header">
                                                    <h6 class="title">Eleanor Pena</h6>
                                                    <span class="designation">Medical Pro.</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="testimonial-item" data-bg-image="assets/images/shape/box-pattern.webp">
                                            <div class="rating-wrap">
                                                <div class="rating-img">
                                                    <img src="assets/images/testimonial/google-2.webp" alt="">
                                                </div>
                                                <div class="rating-area">
                                                    <div class="star-ratings">
                                                        <div class="fill-ratings" style="width: 80%">
                                                            <span>★★★★★</span>
                                                        </div>
                                                        <div class="empty-ratings">
                                                            <span>★★★★★</span>
                                                        </div>
                                                    </div>
                                                    <div class="rating-text"><strong>4.5</strong> out of 5.00</div>
                                                </div>
                                            </div>
                                            <div class="desc">
                                                <p>The team did an incredible job on our bathroom remodel. We had a tight deadline, and they
                                                    delivered on time without compromising the best quality. The attention to detail.</p>
                                            </div>
                                            <div class="testimonial-author">
                                                <div class="author-header">
                                                    <h6 class="title">Brookln Simons</h6>
                                                    <span class="designation">Marketing Co.</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="testimonial-item" data-bg-image="assets/images/shape/box-pattern.webp">
                                            <div class="rating-wrap">
                                                <div class="rating-img">
                                                    <img src="assets/images/testimonial/google-2.webp" alt="">
                                                </div>
                                                <div class="rating-area">
                                                    <div class="star-ratings">
                                                        <div class="fill-ratings" style="width: 80%">
                                                            <span>★★★★★</span>
                                                        </div>
                                                        <div class="empty-ratings">
                                                            <span>★★★★★</span>
                                                        </div>
                                                    </div>
                                                    <div class="rating-text"><strong>4.5</strong> out of 5.00</div>
                                                </div>
                                            </div>
                                            <div class="desc">
                                                <p>“We hired Gripz for full home renovation, and they exceeded all our expectations. Their
                                                    expertise and vision for our space made the entire process stress-free and we’ve received”</p>
                                            </div>
                                            <div class="testimonial-author">
                                                <div class="author-header">
                                                    <h6 class="title">Darrell Steward</h6>
                                                    <span class="designation">Nursing Head</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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

        <!-- start: Work Section -->
        <section class="tj-work-section work-3 section-gap border-hr">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="content-wrap sticky-lg-top wow fadeInUp" data-wow-delay=".3s">
                            <div class="sec-heading">
                                <span class="sub-title"><i class="tji-loading-2"></i>Our recent work</span>
                                <h2 class="sec-title">Recent Renovation Highlights</h2>
                            </div>
                            <p class="desc">Explore our latest renovation projects, where <br> creativity meets craftsmanship. From
                                modern kitchen <br> upgrades to full home makeovers.</p>
                            <a class="tj-primary-btn" href="work.html" data-text="Explore More">
                                <span class="btn-text">Explore More</span>
                                <span class="btn-icon rotate"><i class="tji-loading"></i></span>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="work-wrapper">
                            <div class="work-item style-3 wow fadeInUp" data-wow-delay=".3s">
                                <div class="work-img">
                                    <img src="assets/images/work/work-9.webp" alt="">
                                </div>
                                <div class="work-content" data-bg-image="assets/images/shape/faq-item-bg.webp">
                                    <span class="categories"><a href="work-details.html">Remodeling</a></span>
                                    <div class="work-text">
                                        <h5 class="title"><a href="work-details.html">Modernized with state-of-the-art appliances and
                                                finishes.</a></h5>
                                        <a class="work-btn" href="work-details.html">
                                            <i class="tji-arrow-long"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="work-item style-3 wow fadeInUp" data-wow-delay=".3s">
                                <div class="work-img">
                                    <img src="assets/images/work/work-10.webp" alt="">
                                </div>
                                <div class="work-content" data-bg-image="assets/images/shape/faq-item-bg.webp">
                                    <span class="categories"><a href="work-details.html">Remodeling</a></span>
                                    <div class="work-text">
                                        <h5 class="title"><a href="work-details.html">Cozy, calming atmosphere with custom cabinetry and
                                                lighting.</a></h5>
                                        <a class="work-btn" href="work-details.html">
                                            <i class="tji-arrow-long"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="work-item style-3 wow fadeInUp" data-wow-delay=".3s">
                                <div class="work-img">
                                    <img src="assets/images/work/work-11.webp" alt="">
                                </div>
                                <div class="work-content" data-bg-image="assets/images/shape/faq-item-bg.webp">
                                    <span class="categories"><a href="work-details.html">Remodeling</a></span>
                                    <div class="work-text">
                                        <h5 class="title"><a href="work-details.html">Finished into additional living or entertainment
                                                space.</a></h5>
                                        <a class="work-btn" href="work-details.html">
                                            <i class="tji-arrow-long"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end: Work Section -->

        <!-- start: Team Section -->
        <section class="tj-team-section" data-bg-image="assets/images/shape/pattern-bg.webp">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="sec-heading text-center wow fadeInUp" data-wow-delay=".3s">
                            <span class="sub-title"><i class="tji-loading-2"></i>Meet Our Expert</span>
                            <h2 class="sec-title">Skilled, Certified, and Dedicated Teams</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="team-item wow fadeInUp" data-wow-delay=".4s">
                            <div class="team-img">
                                <img src="assets/images/team/team-1.webp" alt="">
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
                                <h5 class="title">PeGuy Hawekins</h5>
                                <span class="designation">Interior Designer</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="team-item wow fadeInUp" data-wow-delay=".4s">
                            <div class="team-img">
                                <img src="assets/images/team/team-2.webp" alt="">
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
                                <h5 class="title">Dianne Russell</h5>
                                <span class="designation">Founder & CEO</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="team-item wow fadeInUp" data-wow-delay=".4s">
                            <div class="team-img">
                                <img src="assets/images/team/team-3.webp" alt="">
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
                                <h5 class="title">Kristin Watson</h5>
                                <span class="designation">Project Manager</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="team-item wow fadeInUp" data-wow-delay=".4s">
                            <div class="team-img">
                                <img src="assets/images/team/team-4.webp" alt="">
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
                                <h5 class="title">Darlene Robertson</h5>
                                <span class="designation">Master Carpenter</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end: Team Section -->

        <!-- start: Before After Section -->
        <section class="tj-before-after-section section-gap">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 order-lg-1 order-2">
                        <div class="tj-before-after-wrapper wow fadeInUp" data-wow-delay=".3s">
                            <img src="assets/images/before-after/before.webp" alt="">
                            <img src="assets/images/before-after/after.webp" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6 order-lg-2 order-1">
                        <div class="content-wrap wow fadeInUp" data-wow-delay=".3s">
                            <div class="sec-heading">
                                <span class="sub-title"><i class="tji-loading-2"></i>Before & After</span>
                                <h2 class="sec-title">Transformations That Speak Themselves.</h2>
                            </div>
                            <p class="desc">Explore our collection of before and after photos to <br> see the remarkable
                                transformations we’ve created. <br> From outdated kitchens to luxurious.</p>
                            <a class="tj-primary-btn" href="work.html" data-text="View Gallery">
                                <span class="btn-text">View Gallery</span>
                                <span class="btn-icon rotate"><i class="tji-loading"></i></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end: Before After Section -->

        <!-- start: Client Section -->
        <section class="tj-client-section">
            <div class="container-fluid client-container">
                <div class="row">
                    <div class="col">
                        <div class="swiper client-slider">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="client-item-box">
                                        <div class="client-item" data-bg-image="assets/images/shape/box-pattern.webp">
                                            <div class="client-logo">
                                                <img src="assets/images/brands/brand-1.webp" alt="">
                                            </div>
                                        </div>
                                        <div class="client-item hover" data-bg-image="assets/images/brands/brand-hover-bg.webp">
                                            <div class="client-logo">
                                                <img src="assets/images/brands/brand-1-hover.webp" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="client-item-box">
                                        <div class="client-item" data-bg-image="assets/images/shape/box-pattern.webp">
                                            <div class="client-logo">
                                                <img src="assets/images/brands/brand-2.webp" alt="">
                                            </div>
                                        </div>
                                        <div class="client-item hover" data-bg-image="assets/images/brands/brand-hover-bg.webp">
                                            <div class="client-logo">
                                                <img src="assets/images/brands/brand-2-hover.webp" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="client-item-box">
                                        <div class="client-item" data-bg-image="assets/images/shape/box-pattern.webp">
                                            <div class="client-logo">
                                                <img src="assets/images/brands/brand-3.webp" alt="">
                                            </div>
                                        </div>
                                        <div class="client-item hover" data-bg-image="assets/images/brands/brand-hover-bg.webp">
                                            <div class="client-logo">
                                                <img src="assets/images/brands/brand-3-hover.webp" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="client-item-box">
                                        <div class="client-item" data-bg-image="assets/images/shape/box-pattern.webp">
                                            <div class="client-logo">
                                                <img src="assets/images/brands/brand-4.webp" alt="">
                                            </div>
                                        </div>
                                        <div class="client-item hover" data-bg-image="assets/images/brands/brand-hover-bg.webp">
                                            <div class="client-logo">
                                                <img src="assets/images/brands/brand-4-hover.webp" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="client-item-box">
                                        <div class="client-item" data-bg-image="assets/images/shape/box-pattern.webp">
                                            <div class="client-logo">
                                                <img src="assets/images/brands/brand-5.webp" alt="">
                                            </div>
                                        </div>
                                        <div class="client-item hover" data-bg-image="assets/images/brands/brand-hover-bg.webp">
                                            <div class="client-logo">
                                                <img src="assets/images/brands/brand-5-hover.webp" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="client-item-box">
                                        <div class="client-item" data-bg-image="assets/images/shape/box-pattern.webp">
                                            <div class="client-logo">
                                                <img src="assets/images/brands/brand-6.webp" alt="">
                                            </div>
                                        </div>
                                        <div class="client-item hover" data-bg-image="assets/images/brands/brand-hover-bg.webp">
                                            <div class="client-logo">
                                                <img src="assets/images/brands/brand-6-hover.webp" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="client-item-box">
                                        <div class="client-item" data-bg-image="assets/images/shape/box-pattern.webp">
                                            <div class="client-logo">
                                                <img src="assets/images/brands/brand-3.webp" alt="">
                                            </div>
                                        </div>
                                        <div class="client-item hover" data-bg-image="assets/images/brands/brand-hover-bg.webp">
                                            <div class="client-logo">
                                                <img src="assets/images/brands/brand-3-hover.webp" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end: Client Section -->

@endsection
