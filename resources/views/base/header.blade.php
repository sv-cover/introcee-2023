<!-- main header -->
<header class="main-header header-style-one">
    <div class="header-lower">
        <div class="logo-box">
            <figure class="logo"><a href="{{ route('home') }}"><img src="{{ asset('images/dual-logo.svg') }}" alt=""></a></figure>
        </div>
        <div class="outer-box">
            <div class="menu-area">
                <!--Mobile Navigation Toggler-->
                <div class="mobile-nav-toggler">
                    <i class="icon-bar"></i>
                    <i class="icon-bar"></i>
                    <i class="icon-bar"></i>
                </div>
                <nav class="main-menu navbar-expand-md navbar-light">
                    <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                        <ul class="navigation clearfix">
                            <li><a href="{{ url('/#activities') }}">Kick-Off Week</a></li>
                            <li><a href="{{ route('barbecue') }}">Barbecue</a></li>
                            <li><a href="{{ route('camp') }}">IntroCamp</a></li>
                            <li><a href="{{ route('committee') }}">Committee</a></li>
                        </ul>
                    </div>
                </nav>
            </div>
            <div class="menu-right-content">
                <div class="support-box">
                    <div class="icon"><i class="flaticon-chat"></i></div>
                    <span>Questions? Email us!</span>
                    <h5><a href="mailto:introcee@svcover.nl">introcee@svcover.nl</a></h5>
                </div>
                <div class="cart-box"><a href="https://svcover.nl/join/" target="_blank"><i class="fal fa-file-alt"></i> Join Cover</a></div>
            </div>
        </div>
    </div>

    <!--sticky Header-->
    <div class="sticky-header">
        <div class="outer-box">
            <div class="menu-area">
                <nav class="main-menu clearfix">
                    <!--Keep This Empty / Menu will come through Javascript-->
                </nav>
            </div>
            <div class="menu-right-content">
                <div class="support-box">
                    <div class="icon"><i class="flaticon-chat"></i></div>
                    <span>Questions? Email us</span>
                    <h5><a href="mailto:introcee@svcover.nl">introcee@svcover.nl</a></h5>
                </div>
                <div class="cart-box"><a href="https://svcover.nl/join/" target="_blank"><i class="fal fa-file-alt"></i> Join Cover</a></div>
            </div>
        </div>
    </div>
</header>
<!-- main-header end -->

<!-- Mobile Menu  -->
<div class="mobile-menu">
    <div class="menu-backdrop"></div>
    <div class="close-btn"><i class="fas fa-times"></i></div>

    <nav class="menu-box">
        <div class="nav-logo"><a href="index.html"><img src="assets/images/logo-2.png" alt="" title=""></a></div>
        <div class="menu-outer"><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>
        <div class="contact-info">
            <h4>Contact Info</h4>
            <ul>
                <li><a href="mailto:introcee@svcover.nl">introcee@svcover.nl</a></li>
                <li><a href="mailto:board@svcover.nl">board@svcover.nl</a></li>
                <li>Nijenborgh 9, Room 0041a,<br />9747 AG, Groningen</li>
            </ul>
        </div>
        <div class="social-links">
            <ul class="clearfix">
                <li><a href="https://instagram.com/svcover.nl/" target="_blank"><i class="fab fa-instagram"></i></a></li>
                <li><a href="https://whatsapp.svcover.nl/" target="_blank"><i class="fab fa-whatsapp"></i></a></li>
                <li><a href="https://nl.linkedin.com/company/svcover/" target="_blank"><i class="fab fa-linkedin"></i></a></li>
            </ul>
        </div>
    </nav>
</div><!-- End Mobile Menu -->
