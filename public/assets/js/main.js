/***************************************************
==================== JS INDEX ======================
****************************************************
Preloader js
Data js
Sticky Nav Js
Mobile Menu Js
Search Bar Js
Rating Js
Client-slider Js
Marquee slider Js
Work Slider Js
Work Slider 2 Js
Testimonial Slider Js
Testimonial Slider 2 Js
Color palette slider Js
Hero slider Js
Service Slider Js
Achievement Slider Js
Accordion Js
Backtotop Js
Circle Progress
Odometer js
BeforeAfter Js
VenoBox Js

****************************************************/

(function ($) {
	"use strict";

	// Preloader js
	$(window).on("load", function () {
		$(".preloader").fadeOut(600);
	});

	////////////////////////////////////////////////////
	// Data js
	$("[data-bg-image]").each(function () {
		var $this = $(this),
			$image = $this.data("bg-image");
		$this.css("background-image", "url(" + $image + ")");
	});

	////////////////////////////////////////////////////
	// Sticky Nav Js
	$(window).scroll(function () {
		var Width = $(document).width();
		if ($("body").scrollTop() > 250 || $("html").scrollTop() > 250) {
			$(".header-sticky").addClass("sticky");
		} else {
			$(".header-sticky").removeClass("sticky");
		}
	});

	////////////////////////////////////////////////////
	// Mobile Menu Js
	$(".mobile_menu_bar").on("click", function () {
		$(this).toggleClass("on");
	});

	// offcanvas
	$(".menu_bar.menu_offcanvas").on("click", function () {
		$(".tj-offcanvas-area").toggleClass("opened");
		$("body").toggleClass("overflow-hidden");
		$(".body-overlay").addClass("opened");
	});
	$(".hamburger_close_btn").on("click", function () {
		$(".tj-offcanvas-area").removeClass("opened");
		$(".body-overlay").removeClass("opened");
	});
	$(".body-overlay").on("click", function () {
		$(".tj-offcanvas-area").removeClass("opened");
		$("body").toggleClass("overflow-hidden");
		$(".body-overlay").removeClass("opened");
	});

	// Mobile Menu Js
	$("#mobile-menu").meanmenu({
		meanMenuContainer: ".mobile_menu",
		meanScreenWidth: "991",
		meanExpand: ['<i class="tji-arrow-down"></i>'],
	});

	// Hamburger Menu Js
	$(".mobile_menu_bar").on("click", function () {
		$(".hamburger-area").addClass("opened");
		$(".body-overlay").addClass("opened");
	});
	$(".hamburger_close_btn").on("click", function () {
		$(".hamburger-area").removeClass("opened");
		$(".body-overlay").removeClass("opened");
		$(".mobile_menu_bar").removeClass("on");
	});
	$(".body-overlay").on("click", function () {
		$(".hamburger-area").removeClass("opened");
		$(".body-overlay").removeClass("opened");
		$(".mobile_menu_bar").removeClass("on");
	});

	////////////////////////////////////////////////////
	// Search Bar Js
	$(".header-search .search").on("click", function () {
		$(".search_popup").addClass("search-opened");
		$(".search-popup-overlay").addClass("search-popup-overlay-open");
	});
	$(".search_close_btn").on("click", function () {
		$(".search_popup").removeClass("search-opened");
		$(".search-popup-overlay").removeClass("search-popup-overlay-open");
	});
	$(".search-popup-overlay").on("click", function () {
		$(".search_popup").removeClass("search-opened");
		$(this).removeClass("search-popup-overlay-open");
	});

	////////////////////////////////////////////////////
	// Rating Js
	if ($(".fill-ratings span").length > 0) {
		var star_rating_width = $(".fill-ratings span").width();
		$(".star-ratings").width(star_rating_width);
	}

	if ($(".vertical-fill-ratings span").length > 0) {
		var star_rating_height = $(".vertical-fill-ratings span").height();
		$(".vertical-star-ratings").height(star_rating_height);
	}

	////////////////////////////////////////////////////
	// Nice Select Js
	if ($("select").length > 0) {
		$("select").niceSelect();
	}

	////////////////////////////////////////////////////
	// Client-slider Js
	if ($(".client-slider").length > 0) {
		var service = new Swiper(".client-slider", {
			slidesPerView: 3,
			spaceBetween: 2,
			loop: true,
			autoplay: {
				delay: 2000,
			},
			pagination: {
				el: ".service-pagination",
				clickable: true,
			},
			breakpoints: {
				320: {
					slidesPerView: 1,
				},
				360: {
					slidesPerView: 2,
				},
				680: {
					slidesPerView: 3,
				},
				992: {
					slidesPerView: 4,
				},
				1200: {
					slidesPerView: 5,
				},
				1400: {
					slidesPerView: 6,
				},
			},
		});
	}

	////////////////////////////////////////////////////
	// Marquee slider Js
	if ($(".marquee-slider").length > 0) {
		var marquee = new Swiper(".marquee-slider", {
			slidesPerView: "auto",
			spaceBetween: 0,
			freemode: true,
			centeredSlides: true,
			loop: true,
			speed: 5000,
			allowTouchMove: false,
			autoplay: {
				delay: 1,
				disableOnInteraction: true,
			},
		});
	}

	////////////////////////////////////////////////////
	// Work Slider Js
	if ($(".work-slider").length > 0) {
		var work = new Swiper(".work-slider", {
			slidesPerView: 4,
			spaceBetween: 30,
			loop: true,
			autoplay: {
				delay: 6000,
			},
			speed: 1500,
			navigation: {
				nextEl: ".slider-next",
				prevEl: ".slider-prev",
			},
			pagination: {
				el: ".swiper-pagination-area",
				clickable: true,
			},
			breakpoints: {
				0: {
					slidesPerView: 1,
					spaceBetween: 15,
				},
				576: {
					slidesPerView: 1,
				},
				640: {
					slidesPerView: 2,
				},
				768: {
					slidesPerView: 2,
					spaceBetween: 30,
				},
				1024: {
					slidesPerView: 3,
				},
				1400: {
					slidesPerView: 4,
				},
			},
		});
	}

	// Work Slider 2 Js
	if ($(".work-slider-2").length > 0) {
		var work = new Swiper(".work-slider-2", {
			slidesPerView: "auto",
			spaceBetween: 30,
			loop: true,
			speed: 1500,
			navigation: {
				nextEl: ".slider-next",
				prevEl: ".slider-prev",
			},
			pagination: {
				el: ".slider-progressbar",
				type: "progressbar",
			},
			breakpoints: {
				0: {
					spaceBetween: 15,
				},
				768: {
					spaceBetween: 20,
				},
				1200: {
					spaceBetween: 30,
				},
			},
		});
	}

	////////////////////////////////////////////////////
	// Testimonial Slider Js
	if ($(".testimonial-slider").length > 0) {
		var testimonial = new Swiper(".testimonial-slider", {
			slidesPerView: 3,
			spaceBetween: 28,
			loop: true,
			speed: 1500,
			autoplay: {
				delay: 2000,
			},
			navigation: {
				nextEl: ".slider-next",
				prevEl: ".slider-prev",
			},
			pagination: {
				el: ".swiper-pagination-area",
				clickable: true,
			},
			breakpoints: {
				0: {
					slidesPerView: 1,
					spaceBetween: 20,
				},
				576: {
					slidesPerView: 1,
					spaceBetween: 20,
				},
				768: {
					slidesPerView: 2,
				},
				1024: {
					slidesPerView: 3,
				},
			},
		});
	}

	////////////////////////////////////////////////////
	// Testimonial Slider 2 Js
	if ($(".testimonial-slider-2").length > 0) {
		var testimonial = new Swiper(".testimonial-slider-2", {
			slidesPerView: 1,
			spaceBetween: 28,
			loop: true,
			speed: 1500,
			autoplay: {
				delay: 2000,
			},
			navigation: {
				nextEl: ".slider-next",
				prevEl: ".slider-prev",
			},
			pagination: {
				el: ".swiper-pagination-area",
				clickable: true,
			},
			breakpoints: {
				0: {
					slidesPerView: 1,
				},
				576: {
					slidesPerView: 1,
				},
			},
		});
	}

	////////////////////////////////////////////////////
	// Color palette slider Js
	if ($(".color-palette-slider").length > 0) {
		var color = new Swiper(".color-palette-slider", {
			slidesPerView: 1,
			spaceBetween: 28,
			loop: false,
			speed: 1500,
			navigation: {
				nextEl: ".slider-next",
				prevEl: ".slider-prev",
			},
			pagination: {
				el: ".swiper-pagination-area",
				clickable: true,
			},
			breakpoints: {
				0: {
					slidesPerView: 1,
				},
				576: {
					slidesPerView: 1,
				},
				640: {
					slidesPerView: 1,
					spaceBetween: 20,
				},
				768: {
					slidesPerView: 1,
				},
				1024: {
					slidesPerView: 1,
				},
			},
		});
	}

	////////////////////////////////////////////////////
	// Hero slider Js
	if ($(".hero-slider").length > 0) {
		var hero = new Swiper(".hero-slider", {
			slidesPerView: 1,
			spaceBetween: 0,
			loop: true,
			speed: 1900,
			autoplay: {
				delay: 3000,
			},
			navigation: {
				nextEl: ".slider-next",
				prevEl: ".slider-prev",
			},
			pagination: {
				el: ".hero-pagination",
				clickable: true,
			},
		});
	}

	////////////////////////////////////////////////////
	// Service Slider Js
	if ($(".service-slider").length > 0) {
		var service = new Swiper(".service-slider", {
			slidesPerView: 3,
			spaceBetween: 28,
			loop: true,
			speed: 1500,
			autoplay: {
				delay: 2000,
			},
			navigation: {
				nextEl: ".slider-next",
				prevEl: ".slider-prev",
			},
			pagination: {
				el: ".swiper-pagination-area",
				clickable: true,
			},
			breakpoints: {
				0: {
					slidesPerView: 1,
					spaceBetween: 20,
				},
				576: {
					slidesPerView: 1,
					spaceBetween: 20,
				},
				768: {
					slidesPerView: 2,
				},
				1024: {
					slidesPerView: 3,
				},
			},
		});
	}

	////////////////////////////////////////////////////
	// Achievement Slider Js
	if ($(".achievement-slider").length > 0) {
		var achievement = new Swiper(".achievement-slider", {
			slidesPerView: 3,
			spaceBetween: 60,
			loop: true,
			centeredSlides: true,
			speed: 2000,
			grabCursor: true,
			autoplay: {
				delay: 3000,
			},
			navigation: {
				nextEl: ".slider-next",
				prevEl: ".slider-prev",
			},
			pagination: {
				el: ".swiper-pagination-area",
				clickable: true,
			},
			breakpoints: {
				0: {
					slidesPerView: 1.5,
					spaceBetween: 10,
				},
				576: {
					slidesPerView: 1.6,
					spaceBetween: 10,
				},
				768: {
					slidesPerView: 2.3,
					spaceBetween: 30,
				},
				1024: {
					slidesPerView: 3,
					spaceBetween: 40,
				},
				1200: {
					spaceBetween: 60,
				},
			},
		});
	}

	////////////////////////////////////////////////////
	// Accordion Js
	if ($(".accordion-item").length > 0) {
		$(".accordion-item .faq-title").on("click", function () {
			if ($(this).parent().hasClass("active")) {
				$(this).parent().removeClass("active");
			} else {
				$(this).parent().siblings().removeClass("active");
				$(this).parent().addClass("active");
			}
		});
	}

	////////////////////////////////////////////////////
	// Backtotop Js
	function back_to_top() {
		var btn = $("#back_to_top");
		var btn_wrapper = $(".back-to-top-wrapper");

		$(window).scroll(function () {
			if ($(window).scrollTop() > 300) {
				btn_wrapper.addClass("back-to-top-btn-show");
			} else {
				btn_wrapper.removeClass("back-to-top-btn-show");
			}
		});

		btn.on("click", function (e) {
			e.preventDefault();
			$("html, body").animate({ scrollTop: 0 }, "300");
		});
	}
	back_to_top();

	////////////////////////////////////////////////////
	// Circle Progress
	document.addEventListener("DOMContentLoaded", function () {
		const circles = document.querySelectorAll(".circle-big");

		circles.forEach(circle => {
			const percent = circle.getAttribute("data-percent"); // Get percentage from HTML
			const progress = circle.querySelector(".progress");
			const text = circle.querySelector("span");

			const circumference = 2 * Math.PI * 71; // Circumference of the circle
			const dashOffset = circumference - (percent / 100) * circumference; // Calculate stroke-dashoffset

			progress.style.strokeDashoffset = dashOffset; // Apply offset
			text.textContent = percent + "%"; // Update text
		});
	});

	////////////////////////////////////////////////////
	// Odometer js
	if (jQuery(".odometer").length > 0) {
		var om = jQuery(".odometer");
		om.each(function () {
			jQuery(this).appear(function () {
				var numCount = jQuery(this).attr("data-count");
				jQuery(this).html(numCount);
			});
		});
	}

	////////////////////////////////////////////////////
	// BeforeAfter Js
	if ($(".tj-before-after-wrapper").length > 0) {
		$(".tj-before-after-wrapper").beforeAfter({
			movable: true,
			clickMove: true,
			position: 50,
			separatorColor: "#fafafa",
			bulletColor: "#fafafa",
			onMoveStart: function (e) {
				console.log(event.target);
			},
			onMoving: function () {
				console.log(event.target);
			},
			onMoveEnd: function () {
				console.log(event.target);
			},
		});
	}

	////////////////////////////////////////////////////
	// wow js
	if ($(".wow").length > 0) {
		new WOW().init();
	}

	////////////////////////////////////////////////////
	// VenoBox Js
	if ($(".gallery").length > 0) {
		new VenoBox({
			selector: ".gallery",
			numeration: true,
			// infinigall: true,
			spinner: "pulse",
		});
	}

	if ($(".video-popup").length > 0) {
		new VenoBox({
			selector: ".video-popup",
			numeration: true,
			// infinigall: true,
			spinner: "pulse",
		});
	}
})(jQuery);
