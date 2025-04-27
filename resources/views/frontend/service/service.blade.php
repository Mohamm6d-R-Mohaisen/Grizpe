@extends('frontend.layout')

@section('content')

    <main id="primary" class="site-main">
        <!-- start: Breadcrumb Section -->
        <section class="tj-page-header" data-bg-image="@if(isset($galary_main->image))@endif">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="tj-page-header-content text-center">
                            <h1 class="tj-page-title">Service</h1>
                            <div class="tj-page-link">
                                <span><i class="tji-home"></i></span>
                                <span>
                  <a href="{{route('home')}}">Home</a>
                </span>
                                <span>/</span>
                                <span>
                  <span>Service</span>
                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end: Breadcrumb Section -->

        <!-- start: Service Section -->
        <section class="tj-service-section section-gap service-3">
            <div class="container">
                <div class="row row-gap-4">
                    @foreach($services as $service)
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="service-item style-2">
                            <div class="service-icon">
                                <i class="{{$service->icon}}"></i>
                            </div>
                            <h5 class="title">
                                <a href="{{route('services_detail',$service->id)}}">{{$service->title}}</a>
                            </h5>
                            <div class="service-content">
                                <p class="desc">{{$service->description}}.</p>
                                <a class="read-more" href="{{route('services_detail',$service->id)}}"><span>Learn More</span><i
                                        class="tji-arrow-right"></i></a>
                            </div>
                            <div class="item-bg" data-bg-image="{{$service->image}}"></div>
                        </div>
                    </div>
                        @endforeach
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



        <!-- start: Pricing Section -->
        <section class="tj-pricing-section section-gap">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="sec-heading text-center">
                            <span class="sub-title"><i class="tji-switch-on"></i>Pricing plan</span>
                            <h2 class="sec-title">Find Your <span>Package</span></h2>
                        </div>
                    </div>
                </div>
                <div class="row row-gap-4">
                    @foreach($plans as $plan)
                        <div class="col-xl-4 col-md-6">
                            <div class="pricing-box">
                                <div class="pricing-header">
                                    <h6 class="package-name">{{$plan->title}}</h6>
                                    <div class="package-desc">
                                        <p>{{$plan->description}}</p>
                                    </div>
                                    <div class="package-price">
                                        <span class="package-currency">$</span>
                                        <span class="price-number">{{$plan->price}}</span>
                                        <span class="package-period">/per {{$plan->type}}</span>
                                    </div>
                                    <div class="pricing-btn">
                                        <a href="contact.html">
                                            <span class="btn-text">Chose Plan</span>
                                            <span class="btn-icon"><i class="tji-arrow-right"></i></span>
                                        </a>
                                    </div>
                                </div>
                                <div class="check-list">
                                    <ul>

                                        @foreach($plan->features as $feature)
                                            <li><i class="tji-circle-check"></i>{{ $feature->title }}</li>
                                        @endforeach

                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- end: Pricing Section -->

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
