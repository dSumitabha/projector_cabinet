<!--=========================================================
    Item Name: Starpact - projector HTML Template.
    Author: ashishmaraviya
    Version: 3.3
    Copyright 2022-2023
 Author URI: https://themeforest.net/user/ashishmaraviya
 ============================================================-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <title> UST Projector Cabinet.</title>
    <meta name="keywords"
        content="apparel, catalog, ProjectorScreen, projector, projector HTML, electronics, fashion, html projector, html store, minimal, multipurpose, multipurpose projector, online store, responsive projector template, shops" />
    <meta name="description" content="Best projector html template for single and multi vendor store.">
    <meta name="author" content="ashishmaraviya">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- site Favicon -->
    <link rel="icon" href="{{ asset(get_setting('logo')) }}" sizes="32x32" />
    <link rel="apple-touch-icon" href="{{ asset(get_setting('logo')) }}" />
    <meta name="msapplication-TileImage" content="{{ asset(get_setting('logo')) }}" />

    <!-- css Icon Font -->
    <link rel="stylesheet" href="{{ url('/') }}/frontend/assets/css/vendor/ecicons.min.css" />

    <!-- css All Plugins Files -->
    <link rel="stylesheet" href="{{ url('/') }}/frontend/assets/css/plugins/animate.css" />
    <link rel="stylesheet" href="{{ url('/') }}/frontend/assets/css/plugins/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ url('/') }}/frontend/assets/css/plugins/jquery-ui.min.css" />
    <link rel="stylesheet" href="{{ url('/') }}/frontend/assets/css/plugins/countdownTimer.css" />
    <link rel="stylesheet" href="{{ url('/') }}/frontend/assets/css/plugins/slick.min.css" />
    <link rel="stylesheet" href="{{ url('/') }}/frontend/assets/css/plugins/nouislider.css" />
    <link rel="stylesheet" href="{{ url('/') }}/frontend/assets/css/plugins/bootstrap.css" />

    <!-- Main Style -->
    <link rel="stylesheet" href="{{ url('/') }}/frontend/assets/css/demo1.css" />
    <link rel="stylesheet" href="{{ url('/') }}/frontend/assets/css/responsive.css" />
    {{-- <link rel="stylesheet" href="{{ url('/') }}/frontend/assets/css/style.css" /> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/owl.carousel@2.3.4/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/owl.carousel@2.3.4/dist/assets/owl.theme.default.min.css">
    <!-- Background css -->
    <link rel="stylesheet" id="bg-switcher-css" href="{{ url('/') }}/frontend/assets/css/backgrounds/bg-4.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

</head>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-S61CTLHY9B"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'G-S61CTLHY9B');
</script>

<body>


    <!-- Header start  -->
    @include('frontend.layouts.header')
    <!-- Header End  -->

    @yield('content')

    <!-- Footer Start -->
    @include('frontend.layouts.footer')
    <!-- Footer End -->

    <!-- Newsletter Modal Start -->

    <!-- Newsletter Modal end -->
    <x-modal />

    <!-- Cart Floating Button -->
    <div class="ec-cart-float">
        <a href="#ec-side-cart" class="ec-header-btn ">
            <div class="header-icon"><img src="{{ url('/') }}/frontend/assets/images/icons/cart.svg"
                    class="svg_img header_svg" alt="cart" />
            </div>
            <span class="ec-cart-count cart-count-lable">3</span>
        </a>
    </div>
    <!-- Cart Floating Button end -->

    <!-- Whatsapp -->
    @include('frontend.layouts.whatsapp_chat')
    <!-- Whatsapp end -->

    <!-- Vendor JS -->
    <script src="{{ url('/') }}/frontend/assets/js/vendor/jquery-3.5.1.min.js"></script>
    <script src="{{ url('/') }}/frontend/assets/js/vendor/popper.min.js"></script>
    <script src="{{ url('/') }}/frontend/assets/js/vendor/bootstrap.min.js"></script>

    <script src="{{ url('/') }}/frontend/assets/js/vendor/jquery-migrate-3.3.0.min.js"></script>
    <script src="{{ url('/') }}/frontend/assets/js/vendor/modernizr-3.11.2.min.js"></script>
    <script src="{{ url('/') }}/frontend/assets/js/vendor/jquery.magnific-popup.min.js"></script>

    <!--Plugins JS-->
    <script src="{{ url('/') }}/frontend/assets/js/plugins/swiper-bundle.min.js"></script>
    <script src="{{ url('/') }}/frontend/assets/js/plugins/nouislider.js"></script>
    <script src="{{ url('/') }}/frontend/assets/js/plugins/countdownTimer.min.js"></script>
    <script src="{{ url('/') }}/frontend/assets/js/plugins/scrollup.js"></script>
    <script src="{{ url('/') }}/frontend/assets/js/plugins/jquery.zoom.min.js"></script>

    <script src="{{ url('/') }}/frontend/assets/js/plugins/slick.min.js"></script>
    <script src="{{ url('/') }}/frontend/assets/js/plugins/infiniteslidev2.js"></script>

    <script src="{{ url('/') }}/frontend/assets/js/plugins/jquery.sticky-sidebar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/owl.carousel@2.3.4/dist/owl.carousel.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Google translate Js -->
    <script src="{{ url('/') }}/frontend/assets/js/vendor/google-translate.js"></script>
    <script>
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en'
            }, 'google_translate_element');
        }
        $('document').ready(function() {
            $('.carousel').carousel();
        });
        $('#myModal').on('shown.bs.modal', function() {
            $('#myInput').trigger('focus')
        })
    </script>
    <!-- Main Js -->
    <script src="{{ url('/') }}/frontend/assets/js/vendor/index.js"></script>
    <script src="{{ url('/') }}/frontend/assets/js/main.js"></script>
    <script src="{{ url('/') }}/frontend/assets/js/script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function updateCartCount() {
            fetch('{{ route('cart.count') }}', {
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => response.json())
                .then(data => {
                    document.querySelector('.cart-count-lable').innerText = data.count;
                });
        }

        // Call the function once to set the initial cart count on page load
        document.addEventListener('DOMContentLoaded', updateCartCount);
    </script>
    <script>
        $(document).ready(function() {
            @if (session('success'))
                toastr.success("{{ session('success') }}");
            @endif
            @if (session('error'))
                toastr.error("{{ session('error') }}");
            @endif
        });
    </script>

    @stack('script')
</body>

</html>
