<!-- Page Title -->
<section class="page-title centred">
    <div class="bg-layer" style="background-image: url(@yield('title_image'));"></div>
    <div class="pattern-layer" style="background-image: url({{ asset('images/shape/shape-12.png') }});"></div>
    <div class="auto-container">
        <div class="content-box">
            <ul class="bread-crumb clearfix">
                <li>@yield('subtitle')</li>
            </ul>
            <div class="title">
                <h1>@yield('title')</h1>
            </div>
            @yield('pagetitle_extra')
        </div>
    </div>
    @include('components.mediapartner')
</section>
<!-- End Page Title -->
