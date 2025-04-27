
<div class="aside" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}"
    data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}"
    data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle" style="top: 0;">


    <div class="aside-menu flex-column-fluid">
        <div class="hover-scroll-overlay-y " id="kt_aside_menu_wrapper" data-kt-scroll="true"
            data-kt-scroll-height="auto"
            data-kt-scroll-dependencies="{default: '#kt_aside_toolbar, #kt_aside_footer', lg: '#kt_header, #kt_aside_toolbar, #kt_aside_footer'}"
            data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="5px">
            <div class="menu aside-toolbar menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
                id="#kt_aside_menu" data-kt-menu="true">
                <div class="aside-user d-flex align-items-sm-center justify-content-center py-5">
                    <div class="symbol symbol-50px">
                        <img src="{{ asset('admin_assets/img/favicon.ico') }}" alt="" style="width: auto;"/>
                    </div>
                </div>
                <div class="aside-user d-flex align-items-sm-center justify-content-center py-5">
                    <div class="symbol symbol-50px">
                        <img src="{{ asset('admin_assets/media/svg/avatars/blank.svg') }}" alt="" style="width: auto;"/>
                    </div>
                    <div class="aside-user-info flex-row-fluid flex-wrap ms-5">
                        <div class="d-flex">
                            <div class="flex-grow-1 me-2">
                                <a href="#" class="text-white text-hover-primary fs-6 fw-bold">{{ auth()->user()->name }}</a>
                                <span class="text-gray-600 fw-semibold d-block fs-8 mb-1">{{ auth()->user()->email }}</span>
                                <div class="d-flex align-items-center text-success fs-9">
                                <span class="bullet bullet-dot bg-success me-1"></span>online</div>
                            </div>
                        </div>
                    </div>
                </div>
                @if(auth()->user()->can('view_home'))
                    <div class="menu-item">
                        <a class="menu-link {{ $is_active == 'home' ? 'active' : '' }}" href="{{ route('admin.home') }}">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22.876" height="23.778"
                                        viewBox="0 0 22.876 23.778">
                                        <g id="Iconly_Curved_Home" data-name="Iconly/Curved/Home"
                                            transform="translate(1 1)">
                                            <g id="Home">
                                                <path id="Stroke_1" data-name="Stroke 1" d="M0,.549H3.057"
                                                    transform="translate(9.275 14.896)" fill="none" stroke="#fff"
                                                    stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"
                                                    stroke-width="2" />
                                                <path id="Stroke_2" data-name="Stroke 2"
                                                    d="M0,12.754c0-6.132.669-5.7,4.267-9.041C5.842,2.446,8.292,0,10.408,0s4.614,2.434,6.2,3.713c3.6,3.337,4.266,2.91,4.266,9.041,0,9.024-2.133,9.024-10.438,9.024S0,21.778,0,12.754Z"
                                                    fill="none" stroke="#fff" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2" />
                                            </g>
                                        </g>
                                    </svg>
                                </span>
                            </span>
                            <span class="menu-title">{{ __('admin.menu.home') }}</span>
                        </a>
                    </div>
                @endif
                @if(auth()->user()->can('view_products'))
                    <div class="menu-item menu-accordion {{ $is_active_parent == 'products' ? 'here show' : '' }}">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <i class="fa-solid fa-font-awesome"></i>
                                </span>
                            </span>
                            <span class="menu-title">
                                <a class="{{ $is_active == 'products' ? 'active' : '' }}"
                                    href="{{ route('admin.products.index')}}">
                                    <span class="menu-title">{{ __('admin.menu.products') }}</span>
                                </a>
                            </span>
                        </span>
                    </div>
                @endif
                @if(auth()->user()->can('view_attributes'))
                    <div class="menu-item menu-accordion {{ $is_active_parent == 'attributes' ? 'here show' : '' }}">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <i class="fa-solid fa-font-awesome"></i>
                                </span>
                            </span>
                            <span class="menu-title">
                                <a class="{{ $is_active == 'attributes' ? 'active' : '' }}"
                                    href="{{ route('admin.attributes.index')}}">
                                    <span class="menu-title">{{ __('admin.menu.attributes') }}</span>
                                </a>
                            </span>
                        </span>
                    </div>
                @endif
                @if(auth()->user()->can('view_attribute_values'))
                    <div class="menu-item menu-accordion {{ $is_active_parent == 'attribute_values' ? 'here show' : '' }}">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <i class="fa-solid fa-font-awesome"></i>
                                </span>
                            </span>
                            <span class="menu-title">
                                <a class="{{ $is_active == 'attribute_values' ? 'active' : '' }}"
                                    href="{{ route('admin.attribute_values.index')}}">
                                    <span class="menu-title">{{ __('admin.menu.attribute_values') }}</span>
                                </a>
                            </span>
                        </span>
                    </div>
                @endif
                @if(auth()->user()->can('view_categories'))
                    <div class="menu-item menu-accordion {{ $is_active_parent == 'categories' ? 'here show' : '' }}">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <i class="fa-solid fa-font-awesome"></i>
                                </span>
                            </span>
                            <span class="menu-title">
                                <a class="{{ $is_active == 'categories' ? 'active' : '' }}"
                                    href="{{ route('admin.categories.index')}}">
                                    <span class="menu-title">{{ __('admin.menu.categories') }}</span>
                                </a>
                            </span>
                        </span>
                    </div>
                @endif
{{--                @if(auth()->user()->can('view_slider'))--}}
                    <div class="menu-item menu-accordion {{ $is_active_parent == 'sliders' ? 'here show' : '' }}">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <i class="fa-solid fa-font-awesome"></i>
                                </span>
                            </span>
                            <span class="menu-title">
                                <a class="{{ $is_active == 'sliders' ? 'active' : '' }}"
                                   href="{{ route('admin.sliders.index')}}">
                                    <span class="menu-title">{{ __('admin.menu.slider') }}</span>
                                </a>
                            </span>
                        </span>
                    </div>
                <div class="menu-item menu-accordion {{ $is_active_parent == 'galaries' ? 'here show' : '' }}">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <i class="fa-solid fa-font-awesome"></i>
                                </span>
                            </span>
                            <span class="menu-title">
                                <a class="{{ $is_active == 'galaries' ? 'active' : '' }}"
                                   href="{{ route('admin.galaries.index')}}">
                                    <span class="menu-title">{{ __('admin.menu.galaries') }}</span>
                                </a>
                            </span>
                        </span>
                </div>
                <div class="menu-item menu-accordion {{ $is_active_parent == 'questions' ? 'here show' : '' }}">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <i class="fa-solid fa-font-awesome"></i>
                                </span>
                            </span>
                            <span class="menu-title">
                                <a class="{{ $is_active == 'questions' ? 'active' : '' }}"
                                   href="{{ route('admin.questions.index')}}">
                                    <span class="menu-title">{{ __('admin.menu.questions') }}</span>
                                </a>
                            </span>
                        </span>
                </div>
                <div class="menu-item menu-accordion {{ $is_active_parent == 'services' ? 'here show' : '' }}">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <i class="fa-solid fa-font-awesome"></i>
                                </span>
                            </span>
                            <span class="menu-title">
                                <a class="{{ $is_active == 'services' ? 'active' : '' }}"
                                   href="{{ route('admin.services.index')}}">
                                    <span class="menu-title">{{ __('admin.menu.services') }}</span>
                                </a>
                            </span>
                        </span>
                </div>
                <div class="menu-item menu-accordion {{ $is_active_parent == 'planes' ? 'here show' : '' }}">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <i class="fa-solid fa-font-awesome"></i>
                                </span>
                            </span>
                            <span class="menu-title">
                                <a class="{{ $is_active == 'planes' ? 'active' : '' }}"
                                   href="{{ route('admin.planes.index')}}">
                                    <span class="menu-title">{{ __('admin.menu.planes') }}</span>
                                </a>
                            </span>
                        </span>
                </div>
                <div class="menu-item menu-accordion {{ $is_active_parent == 'works' ? 'here show' : '' }}">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <i class="fa-solid fa-font-awesome"></i>
                                </span>
                            </span>
                            <span class="menu-title">
                                <a class="{{ $is_active == 'works' ? 'active' : '' }}"
                                   href="{{ route('admin.works.index')}}">
                                    <span class="menu-title">{{ __('admin.menu.works') }}</span>
                                </a>
                            </span>
                        </span>
                </div>
                <div class="menu-item menu-accordion {{ $is_active_parent == 'blogs' ? 'here show' : '' }}">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <i class="fa-solid fa-font-awesome"></i>
                                </span>
                            </span>
                            <span class="menu-title">
                                <a class="{{ $is_active == 'blogs' ? 'active' : '' }}"
                                   href="{{ route('admin.blogs.index')}}">
                                    <span class="menu-title">{{ __('admin.menu.blogs') }}</span>
                                </a>
                            </span>
                        </span>
                </div>
                <div class="menu-item menu-accordion {{ $is_active_parent == 'comments' ? 'here show' : '' }}">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <i class="fa-solid fa-font-awesome"></i>
                                </span>
                            </span>
                            <span class="menu-title">
                                <a class="{{ $is_active == 'comments' ? 'active' : '' }}"
                                   href="{{ route('admin.comments.index')}}">
                                    <span class="menu-title">{{ __('admin.menu.comments') }}</span>
                                </a>
                            </span>
                        </span>
                </div>
                <div class="menu-item menu-accordion {{ $is_active_parent == 'contacts' ? 'here show' : '' }}">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <i class="fa-solid fa-font-awesome"></i>
                                </span>
                            </span>
                            <span class="menu-title">
                                <a class="{{ $is_active == 'contacts' ? 'active' : '' }}"
                                   href="{{ route('admin.contacts.index')}}">
                                    <span class="menu-title">{{ __('admin.menu.contacts') }}</span>
                                </a>
                            </span>
                        </span>
                </div>
{{--                @endif--}}
                @if(auth()->user()->can('view_adds'))
                    <div class="menu-item menu-accordion {{ $is_active_parent == 'adds' ? 'here show' : '' }}">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <i class="fa-solid fa-font-awesome"></i>
                                </span>
                            </span>
                            <span class="menu-title">
                                <a class="{{ $is_active == 'adds' ? 'active' : '' }}"
                                   href="{{ route('admin.adds.index')}}">
                                    <span class="menu-title">{{ __('admin.menu.adds') }}</span>
                                </a>
                            </span>
                        </span>
                    </div>
                @endif
                @if(auth()->user()->can('view_coupons'))
                    <div class="menu-item menu-accordion {{ $is_active_parent == 'coupons' ? 'here show' : '' }}">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <i class="fa-solid fa-font-awesome"></i>
                                </span>
                            </span>
                            <span class="menu-title">
                                <a class="{{ $is_active == 'coupons' ? 'active' : '' }}"
                                    href="{{ route('admin.coupons.index')}}">
                                    <span class="menu-title">{{ __('admin.menu.coupons') }}</span>
                                </a>
                            </span>
                        </span>
                    </div>
                @endif
                @if(auth()->user()->can('view_offers'))
                    <div class="menu-item menu-accordion {{ $is_active_parent == 'offers' ? 'here show' : '' }}">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <i class="fa-solid fa-font-awesome"></i>
                                </span>
                            </span>
                            <span class="menu-title">
                                <a class="{{ $is_active == 'offers' ? 'active' : '' }}"
                                    href="{{ route('admin.offers.index')}}">
                                    <span class="menu-title">{{ __('admin.menu.offers') }}</span>
                                </a>
                            </span>
                        </span>
                    </div>
                @endif
                @if(auth()->user()->can('view_orders'))
                    <div class="menu-item menu-accordion {{ $is_active_parent == 'orders' ? 'here show' : '' }}">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <i class="fa-solid fa-font-awesome"></i>
                                </span>
                            </span>
                            <span class="menu-title">
                                <a class="{{ $is_active == 'orders' ? 'active' : '' }}"
                                    href="{{ route('admin.orders.index')}}">
                                    <span class="menu-title">{{ __('admin.menu.orders') }}</span>
                                </a>
                            </span>
                        </span>
                    </div>
                @endif
                @if(auth()->user()->can('view_reviews'))
                    <div class="menu-item menu-accordion {{ $is_active_parent == 'reviews' ? 'here show' : '' }}">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <i class="fa-solid fa-font-awesome"></i>
                                </span>
                            </span>
                            <span class="menu-title">
                                <a class="{{ $is_active == 'reviews' ? 'active' : '' }}"
                                    href="{{ route('admin.reviews.index')}}">
                                    <span class="menu-title">{{ __('admin.menu.reviews') }}</span>
                                </a>
                            </span>
                        </span>
                    </div>
                @endif
                @if(auth()->user()->can('view_shipping_companies'))
                    <div class="menu-item menu-accordion {{ $is_active_parent == 'shipping_companies' ? 'here show' : '' }}">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <i class="fa-solid fa-font-awesome"></i>
                                </span>
                            </span>
                            <span class="menu-title">
                                <a class="{{ $is_active == 'shipping_companies' ? 'active' : '' }}"
                                    href="{{ route('admin.shipping_companies.index')}}">
                                    <span class="menu-title">{{ __('admin.menu.shipping_companies') }}</span>
                                </a>
                            </span>
                        </span>
                    </div>
                @endif
                @if(auth()->user()->can('view_static_pages'))
                    <div class="menu-item menu-accordion {{ $is_active_parent == 'static_pages' ? 'here show' : '' }}">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <i class="fa-solid fa-font-awesome"></i>
                                </span>
                            </span>
                            <span class="menu-title">
                                <a class="{{ $is_active == 'static_pages' ? 'active' : '' }}"
                                    href="{{ route('admin.static_pages.index')}}">
                                    <span class="menu-title">{{ __('admin.menu.static_pages') }}</span>
                                </a>
                            </span>
                        </span>
                    </div>
                @endif
                @if(auth()->user()->can('view_home_sections'))
                    <div class="menu-item menu-accordion {{ $is_active_parent == 'home_sections' ? 'here show' : '' }}">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <i class="fa-solid fa-font-awesome"></i>
                                </span>
                            </span>
                            <span class="menu-title">
                                <a class="{{ $is_active == 'home_sections' ? 'active' : '' }}"
                                    href="{{ route('admin.home_sections.index')}}">
                                    <span class="menu-title">{{ __('admin.menu.home_sections') }}</span>
                                </a>
                            </span>
                        </span>
                    </div>
                @endif
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ $is_active_parent == 'user_management' ? 'here show' : '' }}">
                    <span class="menu-link menu-accordion">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <i class="fa-solid fa-font-awesome"></i>
                            </span>
                        </span>
                        <span class="menu-title">ادارة المستخدمين</span>
                        <span class="menu-arrow"></span>
                    </span>
                    @if(auth()->user()->can('view_admins'))
                        <div class="menu-sub menu-sub-accordion">
                            <div class="menu-item">
                                <a class="menu-link {{ $is_active == 'admins' ? 'active' : '' }}"
                                    href="{{ route('admin.admins.index')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{ __('admin.menu.admins') }}</span>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if(auth()->user()->can('view_users'))
                        <div class="menu-sub menu-sub-accordion">
                            <div class="menu-item">
                                <a class="menu-link {{ $is_active == 'users' ? 'active' : '' }}"
                                    href="{{ route('admin.users.index')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{ __('admin.menu.users') }}</span>
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
                @if(auth()->user()->can('view_roles'))
                    <div class="menu-item menu-accordion {{ $is_active_parent == 'roles' ? 'here show' : '' }}">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <i class="fa-solid fa-font-awesome"></i>
                                </span>
                            </span>
                            <span class="menu-title">
                                <a class="{{ $is_active == 'roles' ? 'active' : '' }}"
                                    href="{{ route('admin.roles.index')}}">
                                    <span class="menu-title">{{ __('admin.menu.roles') }}</span>
                                </a>
                            </span>
                        </span>
                    </div>
                @endif

                @if(auth()->user()->can('view_settings'))
                    <div class="menu-item menu-accordion {{ $is_active_parent == 'settings' ? 'here show' : '' }}">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <i class="fa-solid fa-font-awesome"></i>
                                </span>
                            </span>
                            <span class="menu-title">
                                <a class="{{ $is_active == 'settings' ? 'active' : '' }}"
                                    href="{{ route('admin.settings.index')}}">
                                    <span class="menu-title">{{ __('admin.form.settings') }}</span>
                                </a>
                            </span>
                        </span>
                    </div>
                @endif
                {{-- <div class="menu-item menu-accordion {{ $is_active_parent == 'logout' ? 'here show' : '' }}">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <i class="fa-solid fa-font-awesome"></i>
                            </span>
                        </span>
                        <span class="menu-title">
                            <a class="{{ $is_active == 'logout' ? 'active' : '' }}"
                                href="aaaaa.logout.index')}}">
                                <span class="menu-title">{{ __('admin.menu.logout') }}</span>
                            </a>
                        </span>
                    </span>
                </div> --}}
            </div>
        </div>
    </div>
</div>
