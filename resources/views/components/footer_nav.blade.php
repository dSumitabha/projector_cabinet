<div class="ec-nav-toolbar">
    <div class="container">
        <div class="ec-nav-panel">
            <div class="ec-nav-panel-icons">
                <a href="#ec-mobile-menu" class="navbar-toggler-btn ec-header-btn ec-side-toggle"><img
                        src="{{ url('/') }}/frontend/assets/images/icons/menu.svg" class="svg_img header_svg" alt="icon" /></a>
            </div>
            <div class="ec-nav-panel-icons">
                <a href="#ec-side-cart" class="toggle-cart ec-header-btn ec-side-toggle"><img
                        src="{{ url('/') }}/frontend/assets/images/icons/cart.svg" class="svg_img header_svg" alt="icon" /><span
                        class="ec-cart-noti ec-header-count cart-count-lable">3</span></a>
            </div>
            <div class="ec-nav-panel-icons">
                <a href="{{route('all_products')}}" class="ec-header-btn"><img src="{{ url('/') }}/frontend/assets/images/icons/home.svg"
                        class="svg_img header_svg" alt="icon" /></a>
            </div>
            <div class="ec-nav-panel-icons">
                <a href="{{route('all_products')}}" class="ec-header-btn"><img src="{{ url('/') }}/frontend/assets/images/icons/wishlist.svg"
                        class="svg_img header_svg" alt="icon" /><span class="ec-cart-noti">4</span></a>
            </div>
            <div class="ec-nav-panel-icons">
                <a href="{{route('all_products')}}" class="ec-header-btn"><img src="{{ url('/') }}/frontend/assets/images/icons/user.svg"
                        class="svg_img header_svg" alt="icon" /></a>
            </div>

        </div>
    </div>
</div>
