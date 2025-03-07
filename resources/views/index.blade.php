<!-- contact_us.blade.php -->
@extends('frontend.layouts.master')

@section('title', 'Contact Us')

@section('content')
<!-- Starpact Cart Start -->
<div class="ec-side-cart-overlay"></div>
     <div id="ec-side-cart" class="ec-side-cart">
         <div class="ec-cart-inner">
             <div class="ec-cart-top">
                 <div class="ec-cart-title">
                     <span class="cart_title">My Cart</span>
                     <button class="ec-close">×</button>
                 </div>
                 <ul class="eccart-pro-items">
                     <li>
                         <a href="product-left-sidebar.html" class="sidekka_pro_img"><img
                                 src="{{ url('/') }}/frontend/assets/images/product-image/6_1.jpg" alt="product"></a>
                         <div class="ec-pro-content">
                             <a href="product-left-sidebar.html" class="cart_pro_title">Cabinet Designed for UST projector and Center Channel</a>
                             <span class="cart-price"><span>$76.00</span> x 1</span>
                             <div class="qty-plus-minus">
                                 <input class="qty-input" type="text" name="ec_qtybtn" value="1" />
                             </div>
                             <a href="javascript:void(0)" class="remove">×</a>
                         </div>
                     </li>
                     <li>
                         <a href="product-left-sidebar.html" class="sidekka_pro_img"><img
                                 src="{{ url('/') }}/frontend/assets/images/product-image/12_1.jpg" alt="product"></a>
                         <div class="ec-pro-content">
                             <a href="product-left-sidebar.html" class="cart_pro_title">Cabinet Designed for UST projector and Center Channel</a>
                             <span class="cart-price"><span>$64.00</span> x 1</span>
                             <div class="qty-plus-minus">
                                 <input class="qty-input" type="text" name="ec_qtybtn" value="1" />
                             </div>
                             <a href="javascript:void(0)" class="remove">×</a>
                         </div>
                     </li>
                     <li>
                         <a href="product-left-sidebar.html" class="sidekka_pro_img"><img
                                 src="{{ url('/') }}/frontend/assets/images/product-image/3_1.jpg" alt="product"></a>
                         <div class="ec-pro-content">
                             <a href="product-left-sidebar.html" class="cart_pro_title">Cabinet Designed for UST projector and Center Channel</a>
                             <span class="cart-price"><span>$59.00</span> x 1</span>
                             <div class="qty-plus-minus">
                                 <input class="qty-input" type="text" name="ec_qtybtn" value="1" />
                             </div>
                             <a href="javascript:void(0)" class="remove">×</a>
                         </div>
                     </li>
                 </ul>
             </div>
             <div class="ec-cart-bottom">
                 <div class="cart-sub-total">
                     <table class="table cart-table">
                         <tbody>
                             <tr>
                                 <td class="text-left">Sub-Total :</td>
                                 <td class="text-right">$300.00</td>
                             </tr>
                             <tr>
                                 <td class="text-left">VAT (20%) :</td>
                                 <td class="text-right">$60.00</td>
                             </tr>
                             <tr>
                                 <td class="text-left">Total :</td>
                                 <td class="text-right primary-color">$360.00</td>
                             </tr>
                         </tbody>
                     </table>
                 </div>
                 <div class="cart_btn">
                     <a href="cart.html" class="btn btn-primary">View Cart</a>
                     <a href="checkout.html" class="btn btn-secondary">Checkout</a>
                 </div>
             </div>
         </div>
     </div>
     <!-- Starpact Cart End -->


     <!-- Main Slider Start -->
     <div class="sticky-header-next-sec ec-main-slider section section-space-pb">
         <div class="ec-slider swiper-container main-slider-nav main-slider-dot">
             <!-- Main slider -->
             <div class="swiper-wrapper">
                 <div class="ec-slide-item swiper-slide d-flex ec-slide-1">
                     <div class="container align-self-center">
                         <div class="row">
                             <div class="col-xl-6 col-lg-7 col-md-7 col-sm-7 align-self-center">
                                 <div class="ec-slide-content slider-animation">
                                    <p style="margin-bottom: 0.25rem;">Welcome to</p>
                                    <h1 class="ec-slide-title">UST Cabinets.com</h1>
                                    <p style="max-width: 30rem;">Your Ultimate Destination for Ultra Short Throw Projector Solutions At USTCabinets.com, we specialize in designing, manufacturing, and selling premium cabinets tailored for ultra short throw (UST) projectors. Our innovative solutions cater to all your home theater needs, offering a perfect blend of functionality, style, and cutting-edge technology.</p>
                                    <a href="{{ route('all_products') }}" class="btn btn-lg btn-secondary">All Products</a>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>             
         </div>
     </div>
     <!-- Main Slider End -->
    <section class="container py-5 ">
        <div class="section-title text-center mb-5">
            <h2 class="ec-bg-title" style="display: block;">UST Cabinets</h2>
            <h2 class="ec-title" style="font-size:2.5rem;">Our Product Range</h2>
        </div>

        <div class="row" >

            <div class="row col-lg-10 align-items-center mb-4">
                <div class="col-md-2 text-end pe-4" style="border-right: 1px solid #000;">
                    <h1 class="fw-bold display-3" style="color: gray;">01</h1>
                    <p class="fw-bold" style=" color : darkblue;">UST Projector Cabinets</p>
                </div>
                <div class="col-md-10">
                    
                    <p class="mb-0 " style="font-size: 1.25rem; ">
                        Our specially designed cabinets provide the ideal housing for your UST projector, 
                        ensuring optimal performance and seamless integration into your living space.
                    </p>
                </div>
            </div>
            <div class="col-lg-2"></div>

            <div class="col-lg-2"></div>
            <div class="row col-lg-10 align-items-center mb-4">
                <div class="col-md-2 text-end pe-4" style="border-right: 1px solid #000;">
                    <h1 class="fw-bold display-3" style="color: gray;">02</h1>
                    <p class="fw-bold" style="color : darkblue;">UST Projector & Center Channel Cabinets</p>
                </div>
                <div class="col-md-10">
                    <p class="mb-0" style="font-size: 1.25rem; ">
                        Experience immersive audio-visual entertainment with our cabinets that accommodate 
                        both your UST projector and center channel speaker for a fixed screen setup.
                    </p>
                </div>
            </div>
                
            <div class="row col-lg-10 align-items-center">
                <div class="col-md-2 text-end pe-4" style="border-right: 1px solid #000;">
                    <h1 class="fw-bold display-3" style="color: gray;">03</h1>
                    <p class="fw-bold" style="color : darkblue;">Integrated UST Projector Solutions</p>
                </div>
                <div class="col-md-10">
                    <p class="mb-0" style="font-size: 1.25rem; ">
                        For the ultimate home theater setup, explore our integrated cabinets that house your 
                        UST projector, center channel, and a floor-rising screen - all in one sleek unit.
                    </p>
                </div>
            </div>
            <div class="col-lg-2"></div>
        </div>
    </section>


    <!-- Description Section Start -->
        <x-description />
    <!-- Description Section End -->
    <!-- ec Banner Section Start -->

    <!-- ec Banner Section End -->

    <!--  Category Section Start -->

    <!-- Category Section End -->

    <!--  Feature & Special Section Start -->
    <!-- Feature & Special Section End -->

    <!--  Top Vendor Section Start -->

    <!--  Top Vendor Section End -->
      
    <!--  services Section Start -->
        <x-services />
    <!--services Section End -->

    <!--  offer Section Start -->
        <x-offer_section />
    <!-- offer Section End -->

    <!-- New Product Start -->

    <!-- New Product end -->

    <!-- ec testmonial Start -->

    <!-- ec testmonial end -->

    <!-- Ec Brand Section Start -->

    <!-- Ec Brand Section End -->

    <!-- Ec Instagram Start -->

    <!-- Ec Instagram End -->
@endsection
