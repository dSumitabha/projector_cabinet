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
                                     <h1 class="ec-slide-title">UST Projector Cabinets</h1>
                                     <h2 class="ec-slide-stitle">Sale Offer</h2>
                                     <p>Cabinet for Ultra Short throw Projector with Center Channel</p>
                                     <a href="#" class="btn btn-lg btn-secondary">Request Quote</a>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="ec-slide-item swiper-slide d-flex ec-slide-2">
                     <div class="container align-self-center">
                         <div class="row">
                             <div class="col-xl-6 col-lg-7 col-md-7 col-sm-7 align-self-center">
                                 <div class="ec-slide-content slider-animation">
                                     <h1 class="ec-slide-title">MY STORE</h1>
                                     <h2 class="ec-slide-stitle">Sale Offer</h2>
                                     <p>Cabinet for Ultra Short throw Projector with Center Channel</p>
                                     <a href="#" class="btn btn-lg btn-secondary">Request Quote</a>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="swiper-pagination swiper-pagination-white"></div>
             <div class="swiper-buttons">
                 <div class="swiper-button-next"></div>
                 <div class="swiper-button-prev"></div>
             </div>
         </div>
     </div>
     <!-- Main Slider End -->

     <!-- Product tab Area Start -->
        <x-collection />
     <!-- ec Product tab Area End -->
    <!-- Description Section Start -->
        <x-description />
    <!-- Description Section End -->
    <!-- ec Banner Section Start -->

    <!-- ec Banner Section End -->

    <!--  Category Section Start -->
        <x-buying_guides />
    <!-- Category Section End -->

    <!--  Feature & Special Section Start -->
    <!-- Feature & Special Section End -->

    <!--  Top Vendor Section Start -->

    <!--  Top Vendor Section End -->
    <!--  offer Section Start -->
        <x-offer_section />
    <!-- offer Section End -->
    <!--  services Section Start -->
        <x-services />
    <!--services Section End -->



    <!-- New Product Start -->

    <!-- New Product end -->

    <!-- ec testmonial Start -->

    <!-- ec testmonial end -->

    <!-- Ec Brand Section Start -->

    <!-- Ec Brand Section End -->

    <!-- Ec Instagram Start -->

    <!-- Ec Instagram End -->
@endsection
