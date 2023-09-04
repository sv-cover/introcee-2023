@extends('base.layout')

@section('title', 'Introductory Camp')
@section('subtitle', 'September 8-10, 2023')
@section('title_image', asset('images/camp-group-dark.jpg'))
@section('pagetitle_extra')
    <div class="btn-box mt-4 mb-n4">
        <a href="{{ route('campregistration') }}" class="theme-btn btn-one">Sign Up</a>
    </div>
@endsection

@section('content')
    @include('components.pagetitle')

    <!-- about-section -->
    <section class="about-section">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                    <div class="image_block_one">
                        <div class="image-box">
                            <div class="shape" style="background-image: url({{ asset('images/shape/shape-3.png') }});"></div>
                            <figure class="image"><img src="{{ asset('images/charlesback.jpg') }}" alt=""></figure>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                    <div class="content_block_one">
                        <div class="content-box">
                            <div class="sec-title">
                                <span class="sub-title">September 8-10, 2023</span>
                                <h2>What is the Introduction Camp?</h2>
                            </div>
                            <div class="text">
                                <div class="icon-box"><i class="flaticon-camping"></i></div>
                                <p>The Cover Introductory Camp is a weekend dedicated to the new students of Artificial
                                    Intelligence and Computing Science at the University of Groningen.</p>
                            </div>
                            <ul class="list-style-one clearfix">
                                <li>Get to know your fellow students and make friends from your first university
                                    weekend.
                                </li>
                                <li>A camp organised by students for students. The organisers are the Introduction Committee of Cover,
                                the Study Association for AI & CS at the UG.</li>
                                <li>This weekend full of games, adventure, parties and fun will help you discover the association, your programme, your cohort and student traditions!</li>
                            </ul>
                            <div class="btn-box">
                                <a href="{{ route('campregistration') }}" class="theme-btn btn-one">Sign Up</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about-section end -->

    <section class="activities-section auto-container">
        <div class="lower-box text-center mt-0">
            <div class="sec-title light">
                <span class="sub-title">We will update you with news about the IntroCamp through this site, the official Instagram page of the association (@svcover), and through email, if you signed-up!</span>
            </div>
        </div>
    </section>

    <section class="about-style-two">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                    <div class="content_block_three">
                        <div class="content-box">
                            <div class="sec-title">
                                <span class="sub-title">What will we do?</span>
                                <h2>Schedule</h2>
                            </div>
                            <div class="text">
                                <p>
                                    <b>Friday:</b> Travel, settle in the rooms, games, surprise activity, dinner party.
                                    <br />
                                    <b>Saturday:</b> Full day of games (P.S. all you're gonna need is some clothes you don’t mind getting dirty), lunch, committee games, surprise activity, dinner, surprise activity with a <b>military</b> theme, party.
                                    <br />
                                    <b>Sunday:</b> Breakfast, games, auction, travel back to Groningen.
                                </p>
                                <h3 class="mt-4 mb-4">Price: €49,- <small>for first-year students</small> </h3>
                                <p>NOTE: The sign-ups will close at <b>23:59 on Wednesday, 7th September</b>.</p>
                            </div>
                            <div class="btn-box">
                                <a href="{{ route('campregistration') }}" class="theme-btn btn-one">Sign Up</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                    <div class="image_block_two">
                        <div class="image-box mr-0 ml-5">
                            <div class="shape">
                                <div class="shape-1"></div>
                                <div class="shape-2"></div>
                            </div>
                            <figure class="image"><img src="{{ asset('images/dirty-games.jpg') }}" alt=""></figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="video-section">
        <div class="bg-layer parallax-bg" data-parallax="{&quot;y&quot;: 100}"
             style="transform:translate3d(0px, 76.696px, 0px) rotateX(0deg) rotateY(0deg) rotateZ(0deg) scaleX(1) scaleY(1) scaleZ(1); -webkit-transform:translate3d(0px, 76.696px, 0px) rotateX(0deg) rotateY(0deg) rotateZ(0deg) scaleX(1) scaleY(1) scaleZ(1); background-image: url({{ asset('images/2017-dark.jpg') }});"></div>
        <div class="auto-container">
            <div class="inner-box">
                <div class="sec-title light">
                    <span class="sub-title">Not convinced yet?</span>
                    <h2>Watch the 2017 aftermovie</h2>
                </div>
                <div class="video-btn">
                    <a href="https://www.youtube.com/watch?v=Ri7FL9maKXc&ab_channel=PhotoCeeCover"
                       class="lightbox-image" data-caption=""
                       style="background-image: url({{ asset('images/shape/shape-7.png') }});"><i
                            class="fas fa-play"></i></a>
                </div>
            </div>
        </div>
    </section>
@endsection
