<!-- main-footer -->
<footer class="main-footer">
    <div class="pattern-layer" style="background-image: url(assets/images/shape/shape-13.png);"></div>
    <div class="auto-container">
        <div class="footer-top">
            <div class="top-inner">
                <div class="text">
                    <h5>Contact IntroCee</h5>
                    <h3><a href="mailto:introcee@svcover.nl">introcee@svcover.nl</a></h3>

                </div>
                <figure class="footer-logo"><a href="{{ route('home') }}"><img src="{{ asset('images/dual-logo.svg') }}" alt=""></a></figure>
                <div class="text">
                    <h5>Cover Board</h5>
                    <h3><a href="mailto:board@svcover.nl">board@svcover.nl</a></h3>
                </div>
            </div>
        </div>
        <div class="widget-section">
            <div class="row clearfix">
                <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                    <div class="footer-widget links-widget">
                        <div class="widget-title">
                            <h4>About Cover</h4>
                        </div>
                        <div class="widget-content">
                            <ul class="links-list clearfix">
                                <li><a href="https://svcover.nl/" target="_blank">Cover Website</a></li>
                                <li><a href="{{ route('committee') }}">Committee</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                    <div class="footer-widget links-widget">
                        <div class="widget-title">
                            <h4>Activities</h4>
                        </div>
                        <div class="widget-content">
                            <ul class="links-list clearfix">
                                <li><a href="{{ url('/#activities') }}">Kick-Off Week</a></li>
                                <li><a href="{{ route('camp') }}">IntroCamp</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 footer-column">
                    <div class="footer-widget links-widget">
                        <div class="widget-title">
                            <h4>Documents</h4>
                        </div>
                        <div class="widget-content">
                            <ul class="links-list clearfix">
                                <li><a href="#">Terms & Conditions</a></li>
                                <li><a href="https://sd.svcover.nl/Privacy%20Statement/Privacy%20statement.pdf">Privacy Statement</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-12 footer-column">
                    <div class="footer-widget contact-widget">
                        <div class="widget-title">
                            <h4>Social Media</h4>
                        </div>
                        <ul class="social-links clearfix">
                            <li><a href="https://instagram.com/svcover.nl/" target="_blank"><i class="fab fa-instagram"></i></a></li>
                            <li><a href="https://whatsapp.svcover.nl/" target="_blank"><i class="fab fa-whatsapp"></i></a></li>
                            <li><a href="https://nl.linkedin.com/company/svcover/" target="_blank"><i class="fab fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom centred">
        <div class="auto-container">
            <div class="copyright">
                <p>&copy; Copyright {{ date('Y') }} | All rights reserved to <a target="_blank" href="https://svcover.nl">Cover.</a> | Built by <a target="_blank" href="https://www.svcover.nl/profile?lid=2772">Fabian Cuza</a></p>
            </div>
        </div>
    </div>
</footer>
<!-- main-footer end -->


<!-- scroll to top -->
<button class="scroll-top scroll-to-target" data-target="html">
    <i class="fal fa-long-arrow-up"></i>
</button>
