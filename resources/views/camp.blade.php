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
                                <h2>What is the IntroCamp?</h2>
                            </div>
                            <div class="text">
                                <div class="icon-box"><i class="flaticon-camping"></i></div>
                                <p>The Cover Introductory Camp is a weekend dedicated to the new students of Artificial
                                    Intelligence and Computing Science at the University of Groningen.</p>
                            </div>
                            <ul class="list-style-one clearfix">
                                <li>150 participants in total</li>
                                <li>Get to know your fellow colleagues and create connections from your first university
                                    weekend.
                                </li>
                                <li>Have a weekend full of fun activities organised by us.</li>
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
                                <h2>Details</h2>
                            </div>
                            <div class="text">
                                <p>In order to guarantee the safety and good ambiance during the introductory weekend, the Study Association Cover is affiliated with the ACI (Advies Commissie Introductietijden). The ACI is an independent agency from the University of Groningen which advises us where needed. It is always possible to contact them with general questions regarding the introductory period through their website.</p>
                                <h3 class="mt-4 mb-4">Price: €49,- / Higher Years: €59,- </h3>
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

    <section class="about-style-two">
        <div class="auto-container">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="content_block_three">
                        <div class="content-box">
                            <div class="sec-title">
                                <span class="sub-title">Where are we going?</span>
                                <h2>Location</h2>
                            </div>
                            <div class="text">
                                <p>
                                    This year's camp will be held at the same location as the previous IntroCamp. The amazing location that we will be visiting is the Pageborg in Stadskanaal, but don't worry, we will pick you up at the Zernike Campus by bus and also drop you off again at Zernike or the train station.
                                    <br /><br />
                                    The location has everything, just bring a good vibe and the other things on the packing list :)
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
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
                                    <b>Saturday:</b> Full day of games (P.S. all we're gonna is that you will need some clothes you don’t mind getting dirty), lunch, committee games, surprise activity, dinner, surprise activity with a <b>military</b> theme, party.
                                    <br />
                                    <b>Sunday:</b> Breakfast, games, auction, travel back to Groningen.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="btn-box text-center">
                <a href="{{ route('campregistration') }}" class="theme-btn btn-one">Sign Up</a>
            </div>
        </div>
    </section>
@endsection
