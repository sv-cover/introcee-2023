<!-- banner-section -->
<section class="banner-section centred">
    <div class="pattern-layer" style="background-image: url({{ asset('images/shape/shape-1.png') }});"></div>
    <div class="banner-carousel owl-theme owl-carousel owl-dots-none">
        <div class="slide-item">
            <div class="image-layer" style="background-image:url({{ asset('images/camp-group-dark.jpg') }})"></div>
            <div class="auto-container">
                <div class="content-box">
                    <div class="shape" style="background-image: url({{ asset('images/shape/shape-2.png') }});"></div>
                    <span>September 4-10, 2023</span>
                    <h2>The Kick-Off Week of Your Student Life</h2>
                    <div class="btn-box">
                        <a href="#activities" class="theme-btn btn-one">Scroll Down</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="slide-item style-two">
            <div class="image-layer" style="background-image:url({{ asset('images/roleplay-dark.jpg') }})"></div>
            <div class="auto-container">
                <div class="content-box">
                    <div class="shape" style="background-image: url({{ asset('images/shape/shape-2.png') }});"></div>
                    <span>September 8-10, 2023</span>
                    <h2>A Camp with your Fellow First-Years</h2>
                    <div class="btn-box">
                        <a href="{{ route('camp') }}" class="theme-btn btn-one">Camp Information</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('components.mediapartner')
</section>
<!-- banner-section end -->
