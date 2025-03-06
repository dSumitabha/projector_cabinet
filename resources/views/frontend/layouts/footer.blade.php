<style>
    .ec-footer-logo img {
        width: 212px;
        !important
    }
</style>


<footer class="ec-footer section-space-mt">
    <div class="footer-container">
        <div class="footer-offer">
            <div class="container">
                <div class="row">
                    <div class="text-center footer-off-msg">
                        <span>Elevate Your Projection Experience with Our Customized Cabinets!</span><a
                            href="{{ route('free_quote') }}" target="_blank">Details & Quote
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-top section-space-footer-p">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-lg-2 ec-footer-contact">
                        <div class="ec-footer-widget">
                            <div class="ec-footer-logo"><a href="#"><img src="{{ asset(get_setting('logo')) }}"
                                        alt=""><img class="dark-footer-logo"
                                        src="{{ asset(get_setting('logo')) }}" alt="Site Logo"
                                        style="display: none;" /></a></div>

                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-3 ec-footer-info">
                        <div class="ec-footer-widget">
                            <h4 class="ec-footer-heading">Contact us</h4>
                            <div class="ec-footer-links">
                                <ul class="align-items-center">
                                    <li class="ec-footer-link"><span>Office Address:</span>KAVITHA LLC
                                        652 Foster Lane Mount Juliet TN 37122.</li>
                                    <li class="ec-footer-link"><span>Production Plant Address (Warehouse):</span>QCR
                                        3278 highway 76 CottonTown TN 37048.</li>
                                    <li class="ec-footer-link"><span>Call Us:</span><a href="tel:+17079219271">+1
                                            7079219271</a></li>
                                    <li class="ec-footer-link"><span>Email:</span><a
                                            href="mailto:support@ustprojectorcabinets.com">support@ustprojectorcabinets.com</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                    <div class="col-sm-12 col-lg-2 ec-footer-info">
                        <div class="ec-footer-widget">
                            <h4 class="ec-footer-heading">Information</h4>
                            <div class="ec-footer-links">
                                <ul class="align-items-center">
                                    <li class="ec-footer-link"><a href="{{ route('about.us') }}">About us</a></li>
                                    <li class="ec-footer-link"><a href="{{ route('faqPage') }}">FAQ</a></li>
                                    <li class="ec-footer-link"><a href="{{ route('free_quote') }}">Contact us</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-lg-2 ec-footer-service">
                        <div class="ec-footer-widget">
                            <h4 class="ec-footer-heading">Services</h4>
                            <div class="ec-footer-links">
                                <ul class="align-items-center">
                                    <li class="ec-footer-link"><a href="{{ route('privecy.policy') }}">Privacy & policy
                                        </a></li>
                                    <li class="ec-footer-link"><a href="{{ route('terms.condition') }}">Term &
                                            condition</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-3 ec-footer-news">
                        <div class="ec-footer-widget">
                            <h4 class="ec-footer-heading">Newsletter</h4>
                            <div class="ec-footer-links">
                                <ul class="align-items-center">
                                    <li class="ec-footer-link">Get instant updates about our new products and
                                        special promos!</li>
                                </ul>
                                <div class="ec-subscribe-form">
                                    <form id="ec-newsletter-form" name="ec-newsletter-form" method="post"
                                        action="{{ route('subscribe') }}">
                                        @csrf
                                        <div id="ec_news_signup" class="ec-form">
                                            <input class="ec-email" type="text"
                                                placeholder="Enter your email here..." name="emaill" value="" />

                                            <button id="ec-news-btn" class="button btn-primary" type="submit"
                                                name="subscribe" value=""><i class="ecicon eci-paper-plane-o"
                                                    aria-hidden="true"></i></button>

                                        </div>
                                        <span class="text-danger error-text emaill_error"></span>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row align-items-center">
                    <!-- Footer social Start -->
                    <div class="col text-left footer-bottom-left">
                        <div class="footer-bottom-social">
                            <span class="social-text text-upper">Follow us on:</span>
                            <ul class="mb-0">
                                <li class="list-inline-item">
                                    <a class="hdr-facebook" href="{{ get_setting('facebook') }}" target="_blank">
                                        <i class="ecicon eci-facebook"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="hdr-youtube" href="{{ get_setting('youtube') }}" target="_blank">
                                        <i class="ecicon eci-youtube"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Footer social End -->
                    <!-- Footer Copyright Start -->
                    <div class="col text-center footer-copy">
                        <div class="footer-bottom-copy ">
                            <div class="ec-copy">Copyright © 2025 <a class="site-name text-upper"
                                    href="https://ustcabinets.com/">USTCabinets<span>.</span></a>. All Rights Reserved</div>
                        </div>
                    </div>
                    <!-- Footer Copyright End -->
                    <!-- Footer payment -->
                    <div class="col footer-bottom-right">
                        <div class="footer-bottom-payment d-flex justify-content-end">
                            <div class="payment-link">
                                <img src="{{ url('/') }}/frontend/assets/images/icons/payment.png"
                                    alt="">
                            </div>

                        </div>
                    </div>
                    <!-- Footer payment -->
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Footer navigation panel for responsive display -->
<div class="ec-nav-toolbar">
    <div class="container">
        <div class="ec-nav-panel">
            <div class="ec-nav-panel-icons">
                <a href="#ec-mobile-menu" class="navbar-toggler-btn ec-header-btn ec-side-toggle"><img
                        src="{{ url('/') }}/frontend/assets/images/icons/menu.svg" class="svg_img header_svg"
                        alt="icon" /></a>
            </div>
            <div class="ec-nav-panel-icons">
                <a href="#ec-side-cart" class="toggle-cart ec-header-btn ec-side-toggle"><img
                        src="{{ url('/') }}/frontend/assets/images/icons/cart.svg" class="svg_img header_svg"
                        alt="icon" /><span class="ec-cart-noti ec-header-count cart-count-lable">3</span></a>
            </div>
            <div class="ec-nav-panel-icons">
                <a href="{{ route('all_products') }}" class="ec-header-btn"><img
                        src="{{ url('/') }}/frontend/assets/images/icons/home.svg" class="svg_img header_svg"
                        alt="icon" /></a>
            </div>
            <div class="ec-nav-panel-icons">
                <a href="{{ route('all_products') }}" class="ec-header-btn"><img
                        src="{{ url('/') }}/frontend/assets/images/icons/wishlist.svg"
                        class="svg_img header_svg" alt="icon" /><span class="ec-cart-noti">4</span></a>
            </div>
            <div class="ec-nav-panel-icons">
                <a href="{{ route('all_products') }}" class="ec-header-btn"><img
                        src="{{ url('/') }}/frontend/assets/images/icons/user.svg" class="svg_img header_svg"
                        alt="icon" /></a>
            </div>

        </div>
    </div>
</div>

<!-- Footer navigation panel for responsive display end -->
<script>
    $(document).ready(function() {
        $('#ec-newsletter-form').on('submit', function(e) {
            e.preventDefault();


            let form = $(this);
            let formData = new FormData(this);

            $.ajax({
                url: form.attr('action'),
                method: form.attr('method'),
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                beforeSend: function() {
                    $('.error-text').text('');
                },
                success: function(data) {
                    if (data.status === 400) {
                        $.each(data.error, function(key, value) {
                            $('.' + key + '_error').text(value[0]);
                        });

                    } else if (data.status === 200) {
                        resetForm();

                        // Show SweetAlert Success Message
                        Swal.fire({
                            title: 'Thank You!',
                            text: 'We have received your request. We will contact you as soon as possible.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            location.reload(); // Reload after user clicks OK
                        });
                    }
                },

            });
        });

        function resetForm() {
            $('#ec-newsletter-form')[0].reset();
            $('.error-text').text('');
        }
    });
</script>
