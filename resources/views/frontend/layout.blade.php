<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">

    <!-- Site Title -->
    <title>Gripz - Handyman Services HTML Template</title>

    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/fav.png">

    <!-- CSS here -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/font-awesome-pro.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/gripz-icons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/swiper.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/venobox.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/odometer-theme-default.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/meanmenu.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
</head>

<body>
<div class="body-overlay"></div>

<!-- Preloader Start -->
<div class="preloader">
    <div class="loading-container">
        <div class="loading"></div>
        <div id="loading-icon"><img src="{{asset('assets/images/logos/logo-icon.webp')}}" alt=""></div>
    </div>
</div>
<!-- Preloader end -->

<!-- back to top start -->
<div class="back-to-top-wrapper">
    <button id="back_to_top" type="button" class="back-to-top-btn">
        <i class="tji-arrow-up"></i>
    </button>
</div>
<!-- back to top end -->

<!-- start: Search Popup -->
<div class="search_popup">
    <div class="logo">
        <img src="{{asset('assets/images/logos/footer-logo.webp')}}" alt="">
    </div>
    <div class="search_close">
        <button type="button" class="search_close_btn">
            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M17 1L1 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                      stroke-linejoin="round" />
                <path d="M1 1L17 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                      stroke-linejoin="round" />
            </svg>
        </button>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xxl-12">
                <div class="tj_search_wrapper">
                    <div class="search_form">
                        <form action="#">
                            <div class="search_input">
                                <div class="search-box">
                                    <input class="search-form-input" type="text" placeholder="Type Words and Hit Enter" required="">
                                    <button type="submit">
                                        <i class="tji-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="search-popup-overlay"></div>
<!-- end: Search Popup -->

<!-- start: Hamburger Menu -->
<div class="hamburger-area d-lg-none">
    <div class="hamburger_bg"></div>
    <div class="hamburger_wrapper">
        <div class="hamburger_inner">
            <div class="hamburger_top d-flex align-items-center justify-content-between">
                <div class="hamburger_logo">
                    <a href="{{route('home')}}" class="mobile_logo">
                        <img src="{{asset('assets/images/logos/footer-logo.webp')}}" alt="Logo">
                    </a>
                </div>
                <div class="hamburger_close">
                    <button class="hamburger_close_btn"><i class="fa-thin fa-times"></i></button>
                </div>
            </div>
            <div class="hamburger-search-area">
                <h5 class="hamburger-title">Search Now!</h5>
                <div class="hamburger_search">
                    <form method="get" action="{{route('home')}}">
                        <button type="submit"><i class="tji-search"></i></button>
                        <input type="search" autocomplete="off" name="s" value="" placeholder="Search here...">
                    </form>
                </div>
            </div>
            <div class="hamburger_menu">
                <div class="mobile_menu"></div>
            </div>
            <div class="hamburger-infos">
                <h5 class="hamburger-title">Contact Info</h5>
                <div class="contact-info">
                    <div class="contact-item">
                        <span class="subtitle">Phone</span>
                        <a class="contact-link" href="tel:8089091313">808-909-1313</a>
                    </div>
                    <div class="contact-item">
                        <span class="subtitle">Email</span>
                        <a class="contact-link" href="mailto:hello@gripz.com">hello@gripz.com</a>
                    </div>
                    <div class="contact-item">
                        <span class="subtitle">Location</span>
                        <span class="contact-link">Colortown City, 98765</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="hamburger-socials">
            <h5 class="hamburger-title">Follow Us</h5>
            <div class="social-links style-2">
                <ul>
                    <li><a href="https://www.facebook.com/" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
                    <li><a href="https://www.instagram.com/" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
                    <li><a href="https://www.linkedin.com/" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a></li>
                    <li><a href="https://x.com/" target="_blank"><i class="fa-brands fa-x-twitter"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- end: Hamburger Menu -->

<!-- start: Header Area -->
<header class="header-area header-1">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="header-wrapper">
                    <div class="site_logo">
                        <a class="logo" href="{{route('home')}}"><img src="{{asset('assets/images/logos/logo.webp')}}" alt=""></a>
                    </div>

                    <!-- navigation -->
                    <div class="menu-area d-none d-lg-inline-flex align-items-center">
                        <nav id="mobile-menu" class="mainmenu">
                            <ul>
                                <li class=" current-menu-ancestor"><a href="{{route('home')}}">Home</a>
                                </li>
                                <li class="has-dropdown"><a href="{{route('services')}}">Services</a>
                                    <ul class="sub-menu">
                                        <li><a href="{{route('services')}}">Services</a></li>
                                    </ul>
                                </li>
                                <li class="has-dropdown"><a href="{{route('about')}}">Pages</a>
                                    <ul class="sub-menu">
                                        <li><a href="{{route('about')}}">About Us</a></li>
                                        <li><a href="{{route('faq')}}">Faq</a></li>
                                        <li><a href="{{route('pricing')}}">pricing Page</a></li>
                                    </ul>
                                </li>
                                <li class="has-dropdown"><a href="{{route('work')}}">Works</a>
                                    <ul class="sub-menu">
                                        <li><a href="{{route('work')}}">Works</a></li>
                                    </ul>
                                </li>
                                <li class="has-dropdown"><a href="{{route('news')}}">News</a>
                                    <ul class="sub-menu">
                                        <li><a href="{{route('news')}}">News</a></li>
                                    </ul>
                                </li>
                                <li><a href="{{route('contacts')}}">Contact</a></li>
                            </ul>
                        </nav>
                        <div class="header-search">
                            <button class="search">
                                <i class="tji-search"></i>
                            </button>
                        </div>
                    </div>

                    <!-- header right info -->
                    <div class="header-right-item d-none d-lg-inline-flex">
                        <div class="header-button">
                            <a class="tj-primary-btn" href="{{route('contacts')}}" data-text="Get a Quotes">
                                <span class="btn-text">Get a Quotes</span>
                                <span class="btn-icon pulse"><i class="tji-spark"></i></span>
                            </a>
                        </div>
                        <div class="header-contact d-none d-xl-block">
                            <a class="contact-btn" href="tel:5559091313" data-text="(555) 909-1313">
                                <span class="btn-icon"><i class="tji-phone"></i></span>
                                <span class="btn-text">(555) 909-1313</span>
                            </a>
                        </div>
                    </div>

                    <!-- menu bar -->
                    <div class="menu_bar mobile_menu_bar d-lg-none">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- end: Header Area -->

<!-- start: Header Area -->
<header class="header-area header-1 header-sticky header-duplicate">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="header-wrapper">
                    <div class="site_logo">
                        <a class="logo" href="{{route('home')}}"><img src="{{asset('assets/images/logos/logo.webp')}}" alt=""></a>
                    </div>

                    <!-- navigation -->
                    <div class="menu-area d-none d-lg-inline-flex align-items-center">
                        <nav class="mainmenu">
                            <ul>
                                <li class=" current-menu-ancestor"><a href="{{route('home')}}">Home</a>

                                </li>
                                <li class="has-dropdown"><a href="{{route('services')}}">Services</a>
                                    <ul class="sub-menu">
                                        <li><a href="{{route('services')}}">Services</a></li>

                                    </ul>
                                </li>
                                <li class="has-dropdown"><a href="{{route('about')}}">Pages</a>
                                    <ul class="sub-menu">
                                        <li><a href="{{route('about')}}">About Us</a></li>
                                        <li><a href="{{route('faq')}}">Faq</a></li>
                                        <li><a href="{{route('pricing')}}">pricing Page</a></li>
                                    </ul>
                                </li>
                                <li class="has-dropdown"><a href="{{route('work')}}">Works</a>
                                    <ul class="sub-menu">
                                        <li><a href="{{route('work')}}">Works</a></li>
                                    </ul>
                                </li>
                                <li class="has-dropdown"><a href="{{route('news')}}">News</a>
                                    <ul class="sub-menu">
                                        <li><a href="{{route('news')}}">News</a></li>
                                    </ul>
                                </li>
                                <li><a href="{{route('contacts')}}">Contact</a></li>
                            </ul>
                        </nav>
                        <div class="header-search">
                            <button class="search">
                                <i class="tji-search"></i>
                            </button>
                        </div>
                    </div>

                    <!-- header right info -->
                    <div class="header-right-item d-none d-lg-inline-flex">
                        <div class="header-button">
                            <a class="tj-primary-btn" href="{{route('contacts')}}" data-text="Get a Quotes">
                                <span class="btn-text">Get a Quotes</span>
                                <span class="btn-icon pulse"><i class="tji-spark"></i></span>
                            </a>
                        </div>
                        <div class="header-contact d-none d-xl-block">
                            <a class="contact-btn" href="tel:5559091313" data-text="(555) 909-1313">
                                <span class="btn-icon"><i class="tji-phone"></i></span>
                                <span class="btn-text">(555) 909-1313</span>
                            </a>
                        </div>
                    </div>

                    <!-- menu bar -->
                    <div class="menu_bar mobile_menu_bar d-lg-none">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- end: Header Area -->
<main id="primary" class="site-main">

    <!-- end: Breadcrumb Section -->
@yield('content')
    <!-- start: Cta Section -->

    <!-- end: Cta Section -->
<!-- start: Footer Section -->

<footer class="tj-footer-section footer-1" data-bg-image="assets/images/shape/pattern-bg.webp">
    <div class="footer-main-area">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="footer-widget">
                        <div class="footer-logo">
                            <a href="index.html">
                                <img src="assets/images/logos/logo.webp" alt="Logos">
                            </a>
                        </div>
                        <div class="footer-text">
                            <p>At Gripz, we are dedicated to our providing reliable, an innovative, and top-quality
                                electrical.</p>
                        </div>
                        <div class="social-links">
                            <ul>
                                <li><a href="https://www.facebook.com/" target="_blank">FB</a></li>
                                <li><a href="https://www.instagram.com/" target="_blank">IN</a></li>
                                <li><a href="https://www.linkedin.com/" target="_blank">LN</a></li>
                                <li><a href="https://x.com/" target="_blank">TW</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-4 col-md-6">
                    <div class="footer-widget widget-nav-menu">
                        <h6 class="title">Company</h6>
                        <ul>
                            <li><a href="#">Request Service</a></li>
                            <li><a href="#">Recent Works</a></li>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Services</a></li>
                            <li><a href="#">Process</a></li>
                            <li><a href="#">Contact </a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="footer-widget widget-work-time">
                        <h6 class="title">Working Hour</h6>
                        <ul>
                            <li><span>Thu - Fri</span><span>8:00 AM - 6:00 PM</span></li>
                            <li><span>Mon - Wed</span><span>9:00 AM - 7:00 PM</span></li>
                            <li><span>Saturday</span><span>7:00 AM - 9:00 PM</span></li>
                            <li><span>Sunday </span><span class="off-day">Close</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5 col-md-6">
                    <div class="footer-widget widget-subscribe">
                        <h6 class="title">Subscribe Now!</h6>
                        <div class="subscribe-form">
                            <form action="#">
                                <input type="email" name="email" placeholder="Enter Email">
                                <button type="submit"><i class="tji-bell"></i></button>
                                <label for="agree"><input id="agree" type="checkbox">Agree our <a href="#">Terms &
                                        Condition</a></label>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tj-copyright-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="copyright-text text-center">
                        <p><a href="https://themeforest.net/user/theme-junction/portfolio" target="_blank">Gripz</a> &copy;
                            2025. All Rights Reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- end: Footer Section -->
</main>

<!-- JS here -->
<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.nice-select.min.js')}}"></script>
<script src="{{asset('assets/js/swiper.min.js')}}"></script>
<script src="{{asset('assets/js/odometer.min.js')}}"></script>
<script src="{{asset('assets/js/venobox.min.js')}}"></script>
<script src="{{asset('assets/js/appear.min.js')}}"></script>
<script src="{{asset('assets/js/wow.min.js')}}"></script>
<script src="{{asset('assets/js/meanmenu.js')}}"></script>
<script src="{{asset('assets/js/main.js')}}"></script>
@stack('scripts')
</body>

</html>

