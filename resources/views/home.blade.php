@extends('base.layout')

@section('title', 'Home')

@section('content')
    @include('components.slider')
    <section class="activities-section sec-pad centred" id="activities">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-4 col-md-6 col-sm-12 activities-block mb-4">
                    <div class="activities-block-one wow fadeInUp animated animated" data-wow-delay="00ms"
                         data-wow-duration="1500ms"
                         style="visibility: visible; animation-duration: 1500ms; animation-delay: 0ms; animation-name: fadeInUp;">
                        <div class="inner-box">
                            <div class="image-box"><a><img
                                        src="{{ asset('images/zernike.jpg') }}" alt=""></a></div>
                            <div class="lower-content">
                                <div class="icon-box">
                                    <div class="shape"
                                         style="background-image: url({{ asset('images/shape/shape-5.png') }});"></div>
                                    <div class="overlay-shape"
                                         style="background-image: url({{ asset('images/shape/shape-6.png') }});"></div>
                                    <img src="{{ asset('images/maps.png') }}" class="icon-image" width="60" />
                                </div>
                                <h3><a>Treasure Hunt</a></h3>
                                <p>Monday, September 4, 2023<br/>(Various Times)</p>
                                <div class="link"><a>Information From Mentors</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 activities-block mb-4">
                    <div class="activities-block-one wow fadeInUp animated animated" data-wow-delay="00ms"
                         data-wow-duration="1500ms"
                         style="visibility: visible; animation-duration: 1500ms; animation-delay: 0ms; animation-name: fadeInUp;">
                        <div class="inner-box">
                            <div class="image-box"><a href="{{ route('barbecue') }}"><img
                                        src="{{ asset('images/barbecue.jpg') }}" alt=""></a></div>
                            <div class="lower-content">
                                <div class="icon-box">
                                    <div class="shape"
                                         style="background-image: url({{ asset('images/shape/shape-5.png') }});"></div>
                                    <div class="overlay-shape"
                                         style="background-image: url({{ asset('images/shape/shape-6.png') }});"></div>
                                    <img src="{{ asset('images/barbecue.png') }}" class="icon-image" width="60" />
                                </div>
                                <h3><a href="{{ route('barbecue') }}">Barbecue</a></h3>
                                <p>Wednesday, September 6, 2023<br/>17:00 @ Field in front of Bernoulliborg</p>
                                <div class="link"><a href="{{ route('barbecue') }}">Information & Registration</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 activities-block mb-4">
                    <div class="activities-block-one wow fadeInUp animated animated" data-wow-delay="00ms"
                         data-wow-duration="1500ms"
                         style="visibility: visible; animation-duration: 1500ms; animation-delay: 0ms; animation-name: fadeInUp;">
                        <div class="inner-box">
                            <div class="image-box"><a><img
                                        src="{{ asset('images/social.jpg') }}" alt=""></a></div>
                            <div class="lower-content">
                                <div class="icon-box">
                                    <div class="shape"
                                         style="background-image: url({{ asset('images/shape/shape-5.png') }});"></div>
                                    <div class="overlay-shape"
                                         style="background-image: url({{ asset('images/shape/shape-6.png') }});"></div>
                                    <img src="{{ asset('images/cheers.png') }}" class="icon-image" width="70" />
                                </div>
                                <h3><a>Social Drinks</a></h3>
                                <p>Wednesday, September 6, 2023<br /> 21:00 @ Location TBA</p>
                                <div class="link"><a>Read More</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 activities-block mb-4">
                    <div class="activities-block-one wow fadeInUp animated animated" data-wow-delay="00ms"
                         data-wow-duration="1500ms"
                         style="visibility: visible; animation-duration: 1500ms; animation-delay: 0ms; animation-name: fadeInUp;">
                        <div class="inner-box">
                            <div class="image-box"><a><img
                                        src="{{ asset('images/sport.jpg') }}" alt=""></a></div>
                            <div class="lower-content">
                                <div class="icon-box">
                                    <div class="shape"
                                         style="background-image: url({{ asset('images/shape/shape-5.png') }});"></div>
                                    <div class="overlay-shape"
                                         style="background-image: url({{ asset('images/shape/shape-6.png') }});"></div>
                                    <img src="{{ asset('images/sports.png') }}" class="icon-image" width="60" />
                                </div>
                                <h3><a>Sport Activity</a></h3>
                                <p>Thursday, September 7, 2023<br /> Location & Time TBA</p>
                                <div class="link"><a>More Information Soon</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 col-sm-12 inner-column">
                    <div class="content_block_two" style="height: calc(100% - 25px);">
                        <div class="content-box" style="height: 100%;align-items: center;display: flex; justify-content: center;background-image:url({{ asset('images/camp-group-dark.jpg') }});background-size: cover;  background-position: center;">
                            <div class="upper">
                                <h3 style="font-weight: 800; color: white;font-size:36px;margin-bottom: 10px;">Introductory Camp</h3>
                                <p>September 8 - 10, 2023<br />@ Pagedal, Stadskanaal</p>
                                <a href="{{ route('camp') }}" class="theme-btn btn-one">Register now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
