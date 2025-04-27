@extends('frontend.layout')

@section('content')
    <main id="primary" class="site-main">
        <!-- start: Breadcrumb Section -->
        <section class="tj-page-header" data-bg-image="{{$galary_main->image}}">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="tj-page-header-content text-center">
                            <h1 class="tj-page-title">FAQ</h1>
                            <div class="tj-page-link">
                                <span><i class="tji-home"></i></span>
                                <span>
                  <a href="{{route('home')}}">Home</a>
                </span>
                                <span>/</span>
                                <span>
                  <span>Faq</span>
                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end: Breadcrumb Section -->
    <!-- start: Faq Section -->
    <section class="tj-faq-section section-gap">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-xxl-4 col-lg-5">
                    <div class="content-wrap">
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
                    <div class="accordion tj-faq" id="faqOne">

                        @foreach($faqs as $index => $faq)
                            <div class="accordion-item">
                                <!-- زر السؤال -->
                                <button class="faq-title collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faq-{{ $faq->id }}" aria-expanded="false">
                                    {{ $faq->question }}
                                </button>

                                <!-- الإجابة -->
                                <div id="faq-{{ $faq->id }}" class="collapse" data-bs-parent="#faqOne">
                                    <div class="accordion-body faq-text">
                                        <p>{{ $faq->answer }}</p>
                                    </div>
                                </div>

                                <!-- خلفية السؤال -->
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
                    <div class="cta-area" data-bg-image="assets/images/shape/cta-bg.webp">
                        <div class="sec-heading">
                            <h2 class="sec-title"><span>Light Up</span> Your Space <br> Call Us Now!</h2>
                            <a class="call-btn" href="tel:123456987"><i class="tji-phone"></i></a>
                        </div>
                        <div class="cta-img" data-bg-image="{{$galary_footer->image}}"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end: Cta Section -->
@endsection
