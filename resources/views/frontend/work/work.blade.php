@extends('frontend.layout')

@section('content')
    <main id="primary" class="site-main">
        <!-- start: Breadcrumb Section -->
        <section class="tj-page-header" data-bg-image="@if(isset($galary_main->image))@endif">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="tj-page-header-content text-center">
                            <h1 class="tj-page-title">Our Works</h1>
                            <div class="tj-page-link">
                                <span><i class="tji-home"></i></span>
                                <span>
                  <a href="{{route('home')}}">Home</a>
                </span>
                                <span>/</span>
                                <span>
                  <span>Our Works</span>
                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end: Breadcrumb Section -->

        <!-- start: Work Section -->
    <section class="tj-work-section work-3 section-gap">
        <div class="container">
            <div class="row row-gap-4">
                @foreach($works as $work)
                    <div class="col-lg-6">
                        <div class="work-item style-3">
                            <div class="work-img">
                                <img src="{{$work->image}}" alt="">
                            </div>
                            <div class="work-content" data-bg-image="">
                                <span class="categories"><a href="{{route('work_detail',$work->id)}}">{{$work->service->title}}</a></span>
                                <div class="work-text">
                                    <h5 class="title"><a href="{{route('work_detail',$work->id)}}">{{$work->title}}</a></h5>
                                    <a class="work-btn" href="{{route('work_detail',$work->id)}}">
                                        <i class="tji-arrow-long"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="tj-pagination d-flex justify-content-center">
                <ul>
                    <li>
                        <span aria-current="page" class="page-numbers current">1</span>
                    </li>
                    <li>
                        <a class="page-numbers" href="#">2</a>
                    </li>
                    <li>
                        <a class="page-numbers" href="#">3</a>
                    </li>
                    <li>
                        <a class="next page-numbers" href="#"><i class="tji-arrow-long-2"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <!-- end: Work Section -->

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
