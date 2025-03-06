<header class="ec-header">
    <style>

.header-logo img {
    width: 212px!important;
}
    </style>
    <!--Ec Header Top Start -->
    <div class="header-top">
        <div class="container">
            <div class="row align-items-center" id="topWrapper">
                <!-- Header Top Message Start -->
                <div class="col text-center header-top-center" id="topCarousel">
                    <x-text_carousel />
                </div>
                <!-- Header Top Message End -->

                <!-- Header Top responsive Action -->
                <div class="col d-lg-none" id="topNav">
                    <div class="ec-header-bottons">
                        <!-- Header User Start -->
                        <div class="ec-header-user dropdown">
                            <button class="dropdown-toggle" data-bs-toggle="dropdown"><img
                                    src="{{ url('/') }}/frontend/assets/images/icons/user.svg"
                                    class="svg_img header_svg" alt="" /></button>
                            @auth
                            @if (auth()->user()->user_type == 0)
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a class="dropdown-item" href="{{ route('profile') }}">My Profile</a></li>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                </form>
                            </ul>
                            @else
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a class="dropdown-item" href="{{ route('register') }}">Register</a></li>

                                <li><a class="dropdown-item" href="{{ route('login') }}">Login</a></li>
                            </ul>
                            @endif
                            @endauth
                            @guest
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a class="dropdown-item" href="">Register</a></li>

                                <li><a class="dropdown-item" href="">Login</a></li>
                            </ul>

                            @endguest
                        </div>
                        <!-- Header User End -->
                        <!-- Header Cart Start -->
                        <a href="" class="ec-header-btn ec-header-wishlist">
                            <div class="header-icon"><img
                                    src="{{ url('/') }}/frontend/assets/images/icons/wishlist.svg"
                                    class="svg_img header_svg" alt="" /></div>
                            <span class="ec-header-count">4</span>
                        </a>
                        <!-- Header Cart End -->
                        <!-- Header Cart Start -->
                        <a href="#ec-side-cart" class="ec-header-btn ">
                            <div class="header-icon"><img
                                    src="{{ url('/') }}/frontend/assets/images/icons/cart.svg"
                                    class="svg_img header_svg" alt="" /></div>
                            <span class="ec-header-count cart-count-lable">{{ $cartCount }}</span>
                        </a>
                        <!-- Header Cart End -->
                        <!-- Header menu Start -->
                        <a href="#ec-mobile-menu" class="ec-header-btn  d-lg-none">
                            <img src="{{ url('/') }}/frontend/assets/images/icons/menu.svg"
                                class="svg_img header_svg" alt="icon" />
                        </a>
                        <!-- Header menu End -->
                    </div>
                </div>
                <!-- Header Top responsive Action -->
            </div>
        </div>
    </div>
    <!-- Ec Header Top  End -->
    <!-- Ec Header Bottom  Start -->
    <style>
        .ec-header-bottom {
            padding: 0px;!important
        }

    </style>
    <div class="ec-header-bottom d-none d-lg-block">
        <div class="container position-relative">
            <div class="row">
                <div class="ec-flex">
                    <!-- Ec Header Logo Start -->

                    <!-- Ec Header Logo End -->

                    <!-- Ec Header Search Start -->
                    <div class="align-self-center d-flex align-items-center">
                        <!-- Ec Header Logo Start -->
                        <div class="header-logo me-3" style="margin-bottom:20px;"> <!-- Added margin-end for spacing -->
                            <a href="{{ route('all_products') }}">
                                <img src="{{ asset(get_setting('logo')) }}" width="212px"alt="Site Logo" />
                                <img class="dark-logo" src="{{ asset(get_setting('logo')) }}" alt="Site Logo" style="display: none;"  />
                            </a>
                        </div>
                        <!-- Ec Header Logo End -->

                        <!-- Ec Header Search Start -->

                        <!-- Ec Header Search End -->
                    </div>
                    <style>
                        /* Dropdown styling */
                        .search-results-container {
                            position: absolute;
                            width: 100%;
                            max-height: 300px;
                            overflow-y: auto;
                            background: #fff;
                            border: 1px solid #ddd;
                            border-radius: 5px;
                            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                            z-index: 1000;
                        }

                        /* Individual search items */
                        .search-item {
                            padding: 12px;
                            border-bottom: 1px solid #eee;
                            transition: background 0.3s ease-in-out;
                            font-size: 14px;
                        }

                        .search-item:last-child {
                            border-bottom: none;
                        }

                        .search-item:hover {
                            background: #f1f1f1;
                            cursor: pointer;
                        }

                        /* Custom scrollbar */
                        .search-results-container::-webkit-scrollbar {
                            width: 6px;
                        }

                        .search-results-container::-webkit-scrollbar-track {
                            background: #f1f1f1;
                        }

                        .search-results-container::-webkit-scrollbar-thumb {
                            background: #bbb;
                            border-radius: 3px;
                        }

                        .search-results-container::-webkit-scrollbar-thumb:hover {
                            background: #888;
                        }
                    </style>
                    <!-- Ec Header Search End -->

                    <!-- Ec Header Button Start -->
                    <div class="align-self-center">

                        <div class="ec-header-bottons">
                            <div class="header-search position-relative">
                                <form class="ec-btn-group-form" action="#">
                                    <input class="form-control ec-search-bar" id="search-box" placeholder="Search by Product Name "
                                        type="text" autocomplete="off">
                                    <button class="submit" type="submit">
                                        <img src="{{ url('/') }}/frontend/assets/images/icons/search.svg" class="svg_img header_svg" alt="Search" />
                                    </button>
                                </form>
                                <div id="search-results" class="dropdown-menu w-100 shadow-sm mt-1" style="display: none;"></div>
                            </div>
                            <!-- Header User Start -->
                            <div class="ec-header-user dropdown" >
                                <button class="dropdown-toggle" data-bs-toggle="dropdown"><img
                                        src="{{ url('/') }}/frontend/assets/images/icons/person-outline.svg"
                                        class="svg_img header_svg" alt="" />

                                </button>
                                @auth
                                @if (auth()->user()->user_type == 0)
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a class="dropdown-item" href="{{ route('profile') }}">My Profile</a></li>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                    </form>
                                </ul>
                                @else
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a class="dropdown-item" href="{{ route('register') }}">Register</a></li>

                                    <li><a class="dropdown-item" href="{{ route('login') }}">Login</a></li>
                                </ul>
                                @endif
                                @endauth
                                @guest
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a class="dropdown-item" href="{{ route('register') }}">Register</a></li>

                                    <li><a class="dropdown-item" href="{{ route('login') }}">Login</a></li>
                                </ul>

                                @endguest
                            </div>
                            <!-- Header User End -->
                            <!-- Header Cart Start -->
                            <a href="{{ route('cart.view') }}" class="ec-header-btn ">
                                <div class="header-icon"><img
                                        src="{{ url('/') }}/frontend/assets/images/icons/cart-outline.svg"
                                        class="svg_img header_svg" alt="" /></div>
                                <span class="ec-header-count cart-count-lable">{{ $cartCount }}</span>
                            </a>
                            <!-- Header Cart End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec Header Button End -->
    <!-- Header responsive Bottom  Start -->
    <div class="ec-header-bottom d-lg-none">
        <div class="container position-relative">
            <div class="row ">

                <!-- Ec Header Logo Start -->
                <div class="col">
                    <div class="header-logo">
                        <a href="/"><img src="{{ asset(get_setting('logo')) }}" width="212px"
                                alt="Site Logo" /><img class="dark-logo"
                                src="{{ asset(get_setting('logo')) }}" alt="Site Logo"
                                style="display: none;" /></a>
                    </div>
                </div>
                <!-- Ec Header Logo End -->
                <!-- Ec Header Search Start -->
                <div class="col">
                    <div class="header-search">
                        <form class="ec-btn-group-form" action="#">
                            <input class="form-control ec-search-bar" placeholder="Search products..." type="text"
                                name="search ">
                            <button class="submit" type="submit"><img
                                    src="{{ url('/') }}/frontend/assets/images/icons/search.svg"
                                    class="svg_img header_svg" alt="icon" /></button>
                        </form>
                    </div>
                </div>
                <!-- Ec Header Search End -->
            </div>
        </div>
    </div>
    <!-- Header responsive Bottom  End -->
    <!-- EC Main Menu Start -->
    <div id="ec-main-menu-desk" class="d-none d-lg-block sticky-nav">
        <div class="container position-relative">
            <div class="row">
                <div class="col-md-12 align-self-center">
                    <div class="ec-main-menu">

                        <ul>
                            <li class="dropdown">
                                <a href="{{ route('home') }}">Home</a>
                            </li>

                            <li class="dropdown">
                                <a href="{{ route('all_products') }}">All Products</a>
                            </li>
                            <li>
                                <a href="{{ route('contacts') }}">Contact</a>
                            </li>
                            <li>
                                <a href="{{ route('blogs') }}">Blogs</a>
                            </li>
                            <li>
                                <a href="{{ route('free_quote') }}">Free Quote</a>
                            </li>
                            {{-- <li class="dropdown scroll-to"><a href="javascript:void(0)"><img
                                src="{{ url('/') }}/frontend/assets/images/icons/scroll.svg" class="svg_img header_svg scroll" alt="" /></a>
                            <ul class="sub-menu">
                                <li class="menu_title">Scroll To Section</li>
                                <li><a href="javascript:void(0)" data-scroll="collection" class="nav-scroll">Top Collection</a></li>
                                <li><a href="javascript:void(0)" data-scroll="categories" class="nav-scroll">Categories</a></li>
                                <li><a href="javascript:void(0)" data-scroll="offers" class="nav-scroll">Offers</a></li>
                                <li><a href="javascript:void(0)" data-scroll="vendors" class="nav-scroll">Top Vendors</a></li>
                                <li><a href="javascript:void(0)" data-scroll="services" class="nav-scroll">Services</a></li>
                                <li><a href="javascript:void(0)" data-scroll="arrivals" class="nav-scroll">New Arrivals</a></li>
                                <li><a href="javascript:void(0)" data-scroll="reviews" class="nav-scroll">Client Review</a></li>
                                <li><a href="javascript:void(0)" data-scroll="insta" class="nav-scroll">Instagram Feed</a></li>
                            </ul>
                            </li> --}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec Main Menu End -->
    <!-- Starpact Mobile Menu Start -->
    <div id="ec-mobile-menu" class="ec-side-cart ec-mobile-menu">
        <div class="ec-menu-title">
            <span class="menu_title">My Menu</span>
            <button class="ec-close">×</button>
        </div>
        <div class="ec-menu-inner">
            <div class="ec-menu-content">
                <ul>

                    <li><a href="{{ route('home') }}">Home</a>
                    <li>
                        <a href="{{ route('all_products') }}">All Products</a>
                    </li>



                    <li>
                        <a href="{{ route('blogs') }}">Blogs</a>
                    </li>
                    <li>
                        <a href="{{ route('free_quote') }}">Free Quote</a>
                    </li>

                    </li>

                </ul>
            </div>
            <div class="header-res-lan-curr">

                <!-- Social Start -->
                <div class="header-res-social">
                    <div class="header-top-social">
                        <ul class="mb-0">
                            <li class="list-inline-item"><a class="hdr-facebook" href="#"><i
                                        class="ecicon eci-facebook"></i></a></li>
                            <li class="list-inline-item"><a class="hdr-twitter" href="#"><i
                                        class="ecicon eci-twitter"></i></a></li>
                            <li class="list-inline-item"><a class="hdr-instagram" href="#"><i
                                        class="ecicon eci-instagram"></i></a></li>
                            <li class="list-inline-item"><a class="hdr-linkedin" href="#"><i
                                        class="ecicon eci-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
                <!-- Social End -->
            </div>
        </div>
    </div>
    <!-- starpact mobile Menu End -->
</header>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('#search-box').on('keyup', function() {
            let query = $(this).val();

            if (query.length > 1) {
                $.ajax({
                    url: "{{ route('search.products') }}",
                    type: "GET",
                    data: {
                        query: query
                    },
                    success: function(data) {
                        let resultHtml = `<div class="search-results-container">`;

                        if (data.length > 0) {
                            $.each(data, function(key, product) {
                                let slugSource = product.product_frontend_name ? product.product_frontend_name : product.product_name;
                                let slug = slugSource.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '');


                                let productUrl = "{{ route('product_details', ['slug' => '__SLUG__', 'id' => '__ID__']) }}"
                                    .replace('__SLUG__', slug)
                                    .replace('__ID__', product.product_id);
                                   // console.log(productUrl);

                                resultHtml += `
                                <div class="search-item">
                                    <a href="${productUrl}" class="search-link">
                                        <strong>${product.product_name}</strong>
<br><small><b>${product.product_id}</b></small>
                                    </a>
                                </div>`;
                            });
                        } else {
                            resultHtml += `<div class="search-item text-center">No results found</div>`;
                        }

                        resultHtml += `</div>`;

                        $('#search-results').html(resultHtml).fadeIn();
                    }
                });
            } else {
                $('#search-results').fadeOut();
            }
        });

        // Hide search results when clicking outside
        $(document).click(function(e) {
            if (!$(e.target).closest('.header-search').length) {
                $('#search-results').fadeOut();
            }
        });
    });
</script>
