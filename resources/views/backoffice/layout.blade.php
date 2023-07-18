<!DOCTYPE html>
<!--
Author: Keenthemes
Product Name: Metronic
Product Version: 8.1.8
Purchase: https://1.envato.market/EA4JP
Website: http://www.keenthemes.com
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">
<!--begin::Head-->
<head>
    <base href=""/>
    <title>@yield('title') - IntroCee Backoffice</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700"/>
    <!--end::Fonts-->
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="{{ asset('backoffice/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('backoffice/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
          type="text/css"/>
    <!--end::Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('backoffice/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('backoffice/css/style.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <!--end::Global Stylesheets Bundle-->
    <link href="{{ asset('backoffice/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_app_body" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true"
      data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true"
      data-kt-app-sidebar-push-footer="true" class="app-default">
<!--begin::Theme mode setup on page load-->
<script>var defaultThemeMode = "light";
    var themeMode;
    if (document.documentElement) {
        if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
            themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
        } else {
            if (localStorage.getItem("data-bs-theme") !== null) {
                themeMode = localStorage.getItem("data-bs-theme");
            } else {
                themeMode = defaultThemeMode;
            }
        }
        if (themeMode === "system") {
            themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
        }
        document.documentElement.setAttribute("data-bs-theme", themeMode);
    }</script>
<!--end::Theme mode setup on page load-->
<!--begin::App-->
<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
    <!--begin::Page-->
    <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
        <div id="kt_app_header" class="app-header" data-kt-sticky="true" data-kt-sticky-activate-="true"
             data-kt-sticky-name="app-header-sticky" data-kt-sticky-offset="{default: '200px', lg: '300px'}">
            <!--begin::Header container-->
            <div class="app-container container-xxl d-flex align-items-stretch justify-content-between"
                 id="kt_app_header_container">
                <!--begin::Header wrapper-->
                <div class="app-header-wrapper d-flex flex-grow-1 align-items-stretch justify-content-between"
                     id="kt_app_header_wrapper">
                    <!--begin::Menu wrapper-->
                    <div class="app-header-menu app-header-mobile-drawer align-items-start align-items-lg-center w-100"
                         data-kt-drawer="true" data-kt-drawer-name="app-header-menu"
                         data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
                         data-kt-drawer-width="250px" data-kt-drawer-direction="end"
                         data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true"
                         data-kt-swapper-mode="{default: 'append', lg: 'prepend'}"
                         data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_wrapper'}">
                        <!--begin::Menu-->
                        <div
                            class="menu menu-rounded menu-column menu-lg-row menu-active-bg menu-state-primary menu-title-gray-700 menu-arrow-gray-400 menu-bullet-gray-400 my-5 my-lg-0 align-items-stretch fw-semibold px-2 px-lg-0"
                            id="#kt_header_menu" data-kt-menu="true">
                            <!--begin:Menu item-->
                            <div class="menu-item menu-here-bg menu-lg-down-accordion me-0 me-lg-2">
                                <!--begin:Menu link-->
                                <span class="menu-link">
                                    <a href="{{ route('home') }}"><span class="menu-title">Go to Website</span></a>
								</span>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        <!--end::Menu-->
                    </div>
                    <!--end::Menu wrapper-->
                    <!--begin::Logo wrapper-->
                    <div class="d-flex align-items-center">
                        <!--begin::Logo wrapper-->
                        <div
                            class="btn btn-icon btn-color-gray-600 btn-active-color-primary ms-n3 me-2 d-flex d-lg-none"
                            id="kt_app_sidebar_toggle">
                            <i class="ki-outline ki-abstract-14 fs-2"></i>
                        </div>
                        <!--end::Logo wrapper-->
                        <!--begin::Logo image-->
                        <a href="{{ route('admin') }}" class="d-flex d-lg-none">
                            <img alt="Logo" src="{{ asset('images/dual-logo.svg') }}" class="h-20px theme-light-show">
                            <img alt="Logo" src="{{ asset('images/dual-logo.svg') }}" class="h-20px theme-dark-show">
                        </a>
                        <!--end::Logo image-->
                    </div>
                    <!--end::Logo wrapper-->
                    <!--begin::Navbar-->
                    <div class="app-navbar flex-shrink-0">
                        <!--begin::Chat-->
                        <div class="app-navbar-item ms-1 ms-lg-3">
                            <!--begin::Menu wrapper-->
                            <a href="{{ route('backoffice.scanner') }}">
                                <div
                                    class="btn btn-color-gray-500 btn-active-color-primary btn-custom shadow-xs bg-body"
                                    id="kt_drawer_chat_toggle">
                                    <i class="ki-outline ki-barcode fs-1"></i> Scanner
                                </div>
                            </a>

                            <a class="ms-5" href="{{ route('admin') }}">
                                <div
                                    class="btn btn-icon btn-color-gray-500 btn-active-color-primary btn-custom shadow-xs bg-body"
                                    id="kt_drawer_chat_toggle">
                                    <i class="ki-outline ki-home fs-1"></i>
                                </div>
                            </a>
                            <!--end::Menu wrapper-->
                        </div>
                        <!--end::Chat-->
                        <!--begin::Header menu mobile toggle-->
                        <div class="app-navbar-item d-lg-none ms-2 me-n1" title="Show header menu">
                            <div class="btn btn-icon btn-color-gray-600 btn-active-color-primary"
                                 id="kt_app_header_menu_toggle">
                                <i class="ki-outline ki-text-align-left fs-2 fw-bold"></i>
                            </div>
                        </div>
                        <!--end::Header menu mobile toggle-->
                    </div>
                    <!--end::Navbar-->
                </div>
                <!--end::Header wrapper-->
            </div>
            <!--end::Header container-->
        </div>
        <!--begin::Wrapper-->
        <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
            <!--begin::Sidebar-->
            <div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true"
                 data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}"
                 data-kt-drawer-overlay="true" data-kt-drawer-width="275px" data-kt-drawer-direction="start"
                 data-kt-drawer-toggle="#kt_app_sidebar_toggle">
                <!--begin::Logo-->
                <div class="d-flex flex-stack px-4 px-lg-6 py-3 py-lg-8" id="kt_app_sidebar_logo">
                    <!--begin::Logo image-->
                    <a href="{{ route('admin') }}">
                        <img alt="Logo" src="{{ asset('images/dual-logo.svg') }}"
                             class="h-20px h-lg-25px theme-light-show"/>
                        <img alt="Logo" src="{{ asset('images/dual-logo.svg') }}"
                             class="h-20px h-lg-25px theme-dark-show"/>
                    </a>
                    <!--end::Logo image-->
                    <!--begin::User menu-->
                    <div class="ms-3">
                        <!--begin::Menu wrapper-->
                        <div class="cursor-pointer position-relative symbol symbol-circle symbol-40px"
                             data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
                             data-kt-menu-placement="bottom-end">
                            <img
                                src="https://svcover.nl/profile/{{ $coverApi->get_cover_session()->id }}/picture/square/124"
                                alt="user"/>
                            <div
                                class="position-absolute rounded-circle bg-success start-100 top-100 h-8px w-8px ms-n3 mt-n3"></div>
                        </div>
                        <!--begin::User account menu-->
                        <div
                            class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
                            data-kt-menu="true">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <div class="menu-content d-flex align-items-center px-3">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-50px me-5">
                                        <img alt="Logo"
                                             src="https://svcover.nl/profile/{{ $coverApi->get_cover_session()->id }}/picture/square/124"/>
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Username-->
                                    <div class="d-flex flex-column">
                                        <div class="fw-bold d-flex align-items-center fs-5">
                                            {{ $coverApi->get_cover_session()->voornaam }}
                                            {{ ' ' }}
                                            @if($coverApi->get_cover_session()->tussenvoegsel)
                                                {{ $coverApi->get_cover_session()->tussenvoegsel }}
                                                {{ ' ' }}
                                            @endif
                                            {{ $coverApi->get_cover_session()->achternaam }}
                                            {{--                                            <span class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">--}}
                                            {{--                                                Pro--}}
                                            {{--                                            </span>--}}
                                        </div>
                                        <a
                                            class="fw-semibold text-muted text-hover-primary fs-7">{{ $coverApi->get_cover_session()->email }}</a>
                                    </div>
                                    <!--end::Username-->
                                </div>
                            </div>
                        </div>
                        <!--end::User account menu-->
                        <!--end::Menu wrapper-->
                    </div>
                    <!--end::User menu-->
                </div>
                <!--end::Logo-->
                <style>
                    #kt_app_sidebar_nav::-webkit-scrollbar, #kt_app_sidebar_nav_wrapper::-webkit-scrollbar{
                        display: none;
                    }
                </style>
                <!--begin::Sidebar nav-->
                <div class="flex-column-fluid px-4 px-lg-8 py-4" id="kt_app_sidebar_nav">
                    <!--begin::Nav wrapper-->
                    <div id="kt_app_sidebar_nav_wrapper" class="d-flex flex-column hover-scroll-y pe-4 me-n4"
                         data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto"
                         data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
                         data-kt-scroll-wrappers="#kt_app_sidebar, #kt_app_sidebar_nav" data-kt-scroll-offset="5px">
                        <!--begin::Progress-->
                        <div class="d-flex align-items-center flex-column w-100 mb-6">
                            <div class="d-flex justify-content-between fw-bolder fs-6 text-gray-800 w-100 mt-auto mb-3">
                                <span>Camp First Year Sign-ups</span>
                            </div>
                            @php
                                $spots = 125;
								$participants = \App\Models\ParticipantCamp::where('first_year', 1)->count();
								$percentage = ($participants / $spots) * 100;
                            @endphp
                            <div class="w-100 bg-light-primary rounded mb-2" style="height: 24px">
                                <div class="bg-primary rounded" role="progressbar"
                                     style="height: 24px; width: {{ $percentage }}%;"
                                     aria-valuenow="{{ $participants }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="fw-semibold fs-7 text-primary w-100 mt-auto">
                                <span>reached {{ $percentage }}% of the target</span>
                            </div>
                        </div>
                        <!--end::Progress-->
                        <!--begin::Stats-->
                        <div class="d-flex mb-3 mb-lg-6">
                            <!--begin::Stat-->
                            <div class="border border-gray-300 border-dashed rounded min-w-100px w-100 py-2 px-4 me-6">
                                <!--begin::Date-->
                                <span class="fs-6 text-gray-500 fw-bold">Camp Total</span>
                                <!--end::Date-->
                                <!--begin::Label-->
                                <div
                                    class="fs-2 fw-bold text-success">{{ \App\Models\ParticipantCamp::where('confirmed', 1)->count() }}</div>
                                <!--end::Label-->
                            </div>
                            <!--end::Stat-->
                            <!--begin::Stat-->
                            <div class="border border-gray-300 border-dashed rounded min-w-100px w-100 py-2 px-4">
                                <!--begin::Date-->
                                <span class="fs-6 text-gray-500 fw-bold">BBQ Total</span>
                                <!--end::Date-->
                                <!--begin::Label-->
                                <div
                                    class="fs-2 fw-bold text-danger">{{ \App\Models\ParticipantBarbecue::where('confirmed', 1)->count() }}</div>
                                <!--end::Label-->
                            </div>
                            <!--end::Stat-->
                        </div>
                        <!--end::Stats-->
                        <!--begin::Links-->
                        <div class="mb-6">
                            <!--begin::Title-->
                            <h3 class="text-gray-800 fw-bold mb-8">Introductory Camp</h3>
                            <!--end::Title-->
                            <!--begin::Row-->
                            <div class="row row-cols-3" data-kt-buttons="true"
                                 data-kt-buttons-target="[data-kt-button]">
                                <!--begin::Col-->
                                <div class="col mb-4">
                                    <!--begin::Link-->
                                    <a href="{{ route('backoffice.camp') }}"
                                       class="btn btn-icon btn-outline btn-bg-light btn-active-light-primary {{ Route::is('backoffice.camp') && 'active' }} btn-flex flex-column flex-center w-lg-90px h-lg-90px w-70px h-70px border-gray-200"
                                       data-kt-button="true">
                                        <!--begin::Icon-->
                                        <span class="mb-2">
											<i class="ki-outline ki-compass fs-1"></i>
                                        </span>
                                        <!--end::Icon-->
                                        <!--begin::Label-->
                                        <span class="fs-7 fw-bold">Participants</span>
                                        <!--end::Label-->
                                    </a>
                                    <!--end::Link-->
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col mb-4">
                                    <!--begin::Link-->
                                    <a href="{{ route('backoffice.scanner') }}"
                                       class="btn btn-icon btn-outline btn-bg-light btn-active-light-primary {{ Route::is('backoffice.camp') && 'active' }} btn-flex flex-column flex-center w-lg-90px h-lg-90px w-70px h-70px border-gray-200"
                                       data-kt-button="true">
                                        <!--begin::Icon-->
                                        <span class="mb-2">
											<i class="ki-outline ki-barcode fs-1"></i>
                                        </span>
                                        <!--end::Icon-->
                                        <!--begin::Label-->
                                        <span class="fs-7 fw-bold">Scanner</span>
                                        <!--end::Label-->
                                    </a>
                                    <!--end::Link-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Row-->
                        </div>
                        <!--end::Links-->
                        <!--begin::Links-->
                        <div class="mb-6">
                            <!--begin::Title-->
                            <h3 class="text-gray-800 fw-bold mb-8">Barbecue</h3>
                            <!--end::Title-->
                            <!--begin::Row-->
                            <div class="row row-cols-3" data-kt-buttons="true"
                                 data-kt-buttons-target="[data-kt-button]">
                                <!--begin::Col-->
                                <div class="col mb-4">
                                    <!--begin::Link-->
                                    <a href="{{ route('backoffice.bbq') }}"
                                       class="btn btn-icon btn-outline btn-bg-light btn-active-light-primary {{ Route::is('backoffice.bbq') && 'active' }} btn-flex flex-column flex-center w-lg-90px h-lg-90px w-70px h-70px border-gray-200"
                                       data-kt-button="true">
                                        <!--begin::Icon-->
                                        <span class="mb-2">
											<i class="las la-hamburger fs-1"></i>
                                        </span>
                                        <!--end::Icon-->
                                        <!--begin::Label-->
                                        <span class="fs-7 fw-bold">Participants</span>
                                        <!--end::Label-->
                                    </a>
                                    <!--end::Link-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Row-->
                        </div>
                        <!--end::Links-->
                        <!--begin::Links-->
                        <div class="mb-6">
                            <!--begin::Title-->
                            <h3 class="text-gray-800 fw-bold mb-8">POS</h3>
                            <!--end::Title-->
                            <!--begin::Row-->
                            <div class="row row-cols-3" data-kt-buttons="true"
                                 data-kt-buttons-target="[data-kt-button]">
                                <!--begin::Col-->
                                <div class="col mb-4">
                                    <!--begin::Link-->
                                    <a href="{{ route('backoffice.pos.products') }}"
                                       class="btn btn-icon btn-outline btn-bg-light btn-active-light-primary {{ Route::is('backoffice.pos.products') && 'active' }} btn-flex flex-column flex-center w-lg-90px h-lg-90px w-70px h-70px border-gray-200"
                                       data-kt-button="true">
                                        <!--begin::Icon-->
                                        <span class="mb-2">
											<i class="las la-shopping-cart fs-1"></i>
                                        </span>
                                        <!--end::Icon-->
                                        <!--begin::Label-->
                                        <span class="fs-7 fw-bold">Products</span>
                                        <!--end::Label-->
                                    </a>
                                    <!--end::Link-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Row-->
                        </div>
                        <!--end::Links-->
                    </div>
                    <!--end::Nav wrapper-->
                </div>
                <!--end::Sidebar nav-->
            </div>
            <!--end::Sidebar-->
            <!--begin::Main-->
            <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                <!--begin::Content wrapper-->
                <div class="d-flex flex-column flex-column-fluid">
                    @yield('content')
                </div>
                <!--end::Content wrapper-->
                <!--begin::Footer-->
                <div id="kt_app_footer" class="app-footer">
                    <!--begin::Footer container-->
                    <div
                        class="app-container container-xxl d-flex flex-column flex-md-row flex-center flex-md-stack py-3">
                        <!--begin::Copyright-->
                        <div class="text-dark order-2 order-md-1">
                            <span class="text-muted fw-semibold me-1">{{ date('Y') }}&copy;</span>
                            <a href="{{ route('home') }}" target="_blank" class="text-gray-800 text-hover-primary">IntroCee
                                Cover</a>
                        </div>
                        <!--end::Copyright-->
                        <!--begin::Menu-->
                        <ul class="menu menu-gray-600 menu-hover-primary fw-semibold order-1">
                            <li class="menu-item">
                                <a href="https://svcover.nl/" target="_blank" class="menu-link px-2">Cover Website</a>
                            </li>
                            <li class="menu-item">
                                <a href="https://svcover.nl/committees?commissie=introcee" target="_blank"
                                   class="menu-link px-2">IntroCee Committee Page</a>
                            </li>
                        </ul>
                        <!--end::Menu-->
                    </div>
                    <!--end::Footer container-->
                </div>
                <!--end::Footer-->
            </div>
            <!--end:::Main-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Page-->
</div>
<!--end::App-->

<!--begin::Scrolltop-->
<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
    <i class="ki-outline ki-arrow-up"></i>
</div>
<!--end::Scrolltop-->

<!--begin::Javascript-->
<script>var hostUrl = "assets/";</script>
<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="{{ asset('backoffice/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('backoffice/js/scripts.bundle.js') }}"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Vendors Javascript(used for this page only)-->
<script src="{{ asset('backoffice/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
<script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
<script src="https://cdn.amcharts.com/lib/5/map.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script>
<script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
<!--end::Vendors Javascript-->
<!--begin::Custom Javascript(used for this page only)-->
<script src="{{ asset('backoffice/js/widgets.bundle.js') }}"></script>
<script src="{{ asset('backoffice/js/custom/widgets.js') }}"></script>
<!--end::Custom Javascript-->

<script src="{{ asset('backoffice/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<!--begin::Custom Javascript(used for this page only)-->
<script src="{{ asset('backoffice/js/custom/apps/customers/list/export.js') }}"></script>
<script src="{{ asset('backoffice/campparticipants.js') }}"></script>
<script src="{{ asset('backoffice/js/custom/apps/customers/add.js') }}"></script>
<!--end::Custom Javascript-->

<!--end::Javascript-->
</body>
<!--end::Body-->
</html>
