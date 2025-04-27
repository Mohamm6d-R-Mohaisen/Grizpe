@extends('frontend.layout')

@section('content')
    <main id="primary" class="site-main">
        <!-- start: Breadcrumb Section -->
        <section class="tj-page-header" data-bg-image="assets/images/bg/pheader-bg.webp">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="tj-page-header-content text-center">
                            <h1 class="tj-page-title">Contact Us</h1>
                            <div class="tj-page-link">
                                <span><i class="tji-home"></i></span>
                                <span>
                  <a href="{{route('home')}}">Home</a>
                </span>
                                <span>/</span>
                                <span>
                  <span>Contact Us</span>
                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end: Breadcrumb Section -->

    <!-- start: Contact Top Section -->
    <div class="tj-contact-area section-gap">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="sec-heading text-center">
                        <span class="sub-title"><i class="tji-switch-on"></i>Contact info</span>
                        <h2 class="sec-title"><span>Reach</span> Out to Us</h2>
                    </div>
                </div>
            </div>
            <div class="row row-gap-4">
                <div class="col-xl-3 col-lg-6 col-sm-6">
                    <div class="contact-item style-2">
                        <div class="contact-icon">
                            <i class="tji-location-3"></i>
                        </div>
                        <h3 class="contact-title">Our Location</h3>
                        <p>993 Renner Burg, West Rond, MT 94251-030</p>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-sm-6">
                    <div class="contact-item style-2">
                        <div class="contact-icon">
                            <i class="tji-envelop"></i>
                        </div>
                        <h3 class="contact-title">Email us</h3>
                        <ul class="contact-list">
                            <li><a href="mailto:support@gripz.com">support@gripz.com</a></li>
                            <li><a href="mailto:info@gripz.com">info@gripz.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-sm-6">
                    <div class="contact-item style-2">
                        <div class="contact-icon">
                            <i class="tji-phone-2"></i>
                        </div>
                        <h3 class="contact-title">Call us</h3>
                        <ul class="contact-list">
                            <li><a href="tel:10095447818">+1 (009) 544-7818</a></li>
                            <li><a href="tel:10098801810">+1 (009) 880-1810</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-sm-6">
                    <div class="contact-item style-2">
                        <div class="contact-icon">
                            <i class="tji-chat"></i>
                        </div>
                        <h3 class="contact-title">Live chat</h3>
                        <ul class="contact-list">
                            <li><a href="mailto:livechat@gripz.com">livechat@gripz.com</a></li>
                            <li class="active"><a href="contact.html">Need help?</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end: Contact Top Section -->

    <!-- start: Contact Section -->
    <section class="tj-contact-section-2 section-bottom-gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="contact-form style-2" data-bg-image="assets/images/shape/box-pattern-2.webp">
                        <h3 class="title">Feel free to get in touch or visit our location.</h3>
                        <form id="kt_form" class="form row d-flex flex-column flex-lg-row addForm" data-kt-redirect="{{route('contacts')}}"
                            action="{{route('admin.contacts.store')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-input">
                                        <input type="text" name="full_name">
                                        <label>Full Name <span>*</span></label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-input">
                                        <input type="email" name="email">
                                        <label>Email Address <span>*</span></label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-input">
                                        <input type="tel" name="phone_number">
                                        <label>Phone number <span>*</span></label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-input">
                                        <div class="tj-nice-select-box">
                                            <div class="tj-select">
                                                <select name="service_id" >
                                                    <option></option>
                                                    @foreach ($services as $service)
                                                        <option value="{{ $service->id }}" @if (isset($contact) && $contact->service_id == $service->id) selected @endif>
                                                            {{ $service->title }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-input message-input">
                                        <textarea name="message" id="message"></textarea>
                                        <label>Type message <span>*</span></label>
                                    </div>
                                </div>
                                <div class="submit-btn">
                                    <button class="tj-primary-btn" type="submit" data-text="Send now">
                                        <span class="btn-text">Send now</span>
                                        <span><i class="tji-spark"></i></span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="map-area map-2">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d333936.3045620869!2d-77.00614607189746!3d38.95834849296768!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1741232483205!5m2!1sen!2sbd"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end: Contact Section -->

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
                        <div class="cta-img" data-bg-image="assets/images/shape/cta-img.webp"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end: Cta Section -->
@push('scripts')
            <script src="{{ asset('admin_assets/js/dashboard/handleSubmitForm.js') }}"></script>
    @endpush


@endsection
