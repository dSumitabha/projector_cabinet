<div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 mb-6 pro-gl-content  p-3">
    <div class="ec-product-inner border p-2">
        <div class="ec-pro-image-outer">
            <div class="ec-pro-image">
                <a href="{{route('product_details')}}" class="image">
                    <img class="main-image" src="{{ url('/') }}/frontend/assets/images/our_brands/product_demo_2_xl.png" alt="Product">
                    <img class="hover-image" src="{{ url('/') }}/frontend/assets/images/our_brands/product_demo_2.png" alt="Product">
                </a>
                <span class="percentage">20%</span>
                <!-- <a href="#" class="quickview" data-link-action="quickview" title="Quick view" data-bs-toggle="modal" data-bs-target="#ec_quickview_modal"><img src="" class="svg_img pro_svg" alt=""></a> -->
                <!-- <div class="ec-pro-actions">
                    <button title="Add To Cart" class=" add-to-cart"><img src="" class="svg_img pro_svg" alt=""> Add To Cart</button>
                </div> -->
            <div class="ec-pro-loader"></div></div>
        </div>
        <div class="ec-pro-content">
            <h5 class="ec-pro-title"><a href="{{route('product_details')}}">{{ $product->product_name }}</a></h5>
            <div class="ec-pro-rating">
                <i class="ecicon eci-star fill"></i>
                <i class="ecicon eci-star fill"></i>
                <i class="ecicon eci-star fill"></i>
                <i class="ecicon eci-star fill"></i>
                <i class="ecicon eci-star"></i>
            </div>
            <div class="ec-pro-list-desc">Lorem Ipsum is simply dummy text.</div>
            <span class="ec-price">
                <span class="old-price">$5,625.00</span>
                <span class="new-price">$4500.00</span>
            </span>
            <div class="text-center add-to-cart my-2">
                <a href="" class="custom-btn">Add To Cart</a>
            </div>
            <!-- <div class="ec-pro-option ">
                add components here
            </div> -->
        </div>
    </div>
</div>
