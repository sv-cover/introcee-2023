@extends('base.layout')

@section('title', 'Introductory Barbecue')
@section('subtitle', 'September 6, 2023')
@section('title_image', asset('images/barbecue.jpg'))
@section('pagetitle_extra')
    <div class="btn-box mt-4 mb-n4">
        <a href="#form" class="theme-btn btn-one">Sign Up</a>
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
                            <figure class="image"><img src="{{ asset('images/max-bbq.jpeg') }}" alt=""></figure>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                    <div class="content_block_one">
                        <div class="content-box">
                            <div class="sec-title">
                                <span class="sub-title">September 6, 2023</span>
                                <h2>BBQ Time!</h2>
                            </div>
                            <p>After your first 3 days at uni, it's time to have a relaxing meal at the "great garden" of the Bernoulliborg (the big blue building😉). A moment where you cannot only enjoy the finest Dutch weather whilst getting your belly stuffed, but also an opportunity to socialize and meet your fellow students! No matter if you want to enjoy a vegetarian or non-vegetarian meal, there is an option for you! (We've been told it's the good veggie stuff as well 😋). And for the bread and salad types of course you can go all out as well. Don't worry about the dishes though. Cover has got you covered!
                                <br/><br/>Will we see you there 🙋?</p>
                            <div class="btn-box mt-4">
                                <a href="#form" class="theme-btn btn-one">Sign Up</a>
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
                <span class="sub-title">We will update you with news about the BBQ through this site, the official Instagram page of the association (@svcover), and through email, if you signed-up!</span>
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
                                <h2>Good To Know</h2>
                            </div>
                            <div class="text">
                                <p>Place: In front of the Bernoulliborg<br />
                                    Time: put time here<br />
                                    Sign up fee: 3,5<br />
                                    Note: You do not even have to be a Cover member!<br />
                                    Note 2: Are you ready for a fun evening 😉?<br />
                            </div>
                            <div class="btn-box">
                                <a href="#form" class="theme-btn btn-one">Sign Up</a>
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
                            <figure class="image"><img src="{{ asset('images/tents-llama.jpeg') }}" alt=""></figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('barbecueform')

@endsection
