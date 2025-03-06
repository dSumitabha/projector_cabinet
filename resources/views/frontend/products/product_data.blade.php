
<div class="row" id="product-data">

@if ($products->count() > 0)

    @foreach ($products as $product)
    @php
            $slug = Str::slug($product->product_frontend_name ?? $product->product_name); // Generate slug dynamically
        @endphp
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 mb-6 pro-gl-content p-3">
            <div class="ec-product-inner border p-2">
                <div class="ec-pro-image-outer">
                    <div class="ec-pro-image" onclick="redirectToProduct('{{ route('product_details', ['slug' => $slug, 'id' => $product->product_id]) }}')">
                        <a href="{{ route('product_details',['slug' => $slug,'id'=>$product->product_id]) }}" class="image">
                            @php
                            $productImage = $product->productImages()->first();
                        @endphp
                        @if ($productImage)
                            <img class="main-image"
                                src="{{ asset('user/uploads/products/images/' . $productImage->image) }}"
                                alt="{{ $product->product_name }}" height="240px">
                            <img class="hover-image" 
                                src="{{ asset('user/uploads/products/images/' . $productImage->image) }}"
                                height="240px" alt="{{ $product->product_name }}">
                        @else
                            <img class="main-image"
                                src="{{ asset('frontend/assets/images/our_brands/product_demo_2_xl.png') }}"
                                alt="Default Product">
                            <img class="hover-image"
                                src="{{ asset('frontend/assets/images/our_brands/product_demo_2.png') }}"
                                alt="Default Product">
                        @endif
                        </a>
                        {{-- <span class="percentage">20%</span> --}}
                        <div class="ec-pro-loader"></div>
                    </div>
                </div>
                <div class="ec-pro-content">
                    <h5 class="ec-pro-titlee" style="font-size:16px;font-weight:600;margin-bottom:10px;color:rgb(83, 21, 102)!important"><a
                        href="{{ route('product_details',['slug' => $slug,'id'=>$product->product_id]) }}">Model : {{ $product->product_id }}</a></h5>

                    <h5 class="ec-pro-titlee" style="font-size:16px;font-weight:600;margin-bottom:10px"><a
                            href="{{ route('product_details',['slug' => $slug,'id'=>$product->product_id]) }}">{{ $product->product_frontend_name }}</a></h5>
                    <div class="ec-pro-rating">
                        <i class="ecicon eci-star fill"></i>
                        <i class="ecicon eci-star fill"></i>
                        <i class="ecicon eci-star fill"></i>
                        <i class="ecicon eci-star fill"></i>
                        <i class="ecicon eci-star"></i>
                    </div>
                    <div class="ec-pro-list-desc">Lorem Ipsum is simply dummy text.</div>
                    <span class="ec-price">
                        {{-- <span class="old-price">$5,625.00</span> --}}
                        <span class="new-price">${{ number_format($product->selling_price, 2) }}</span>
                    </span>
                    <div class="text-center add-to-cart my-2">
                        <form id="add-to-cart-form" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="button" class="btn btn-primary add-to-cart-btn">Add To Cart</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @if ($products instanceof \Illuminate\Pagination\LengthAwarePaginator)
        <div class="ec-pro-pagination">
            <span>Showing {{ $products->firstItem() }}-{{ $products->lastItem() }} of {{ $products->total() }}
                item(s)</span>
            <ul class="ec-pro-pagination-inner">
                {{ $products->appends(request()->query())->links() }}
            </ul>
        </div>
    @endif
    @else
    <div id="no-products-section" class="col-12 text-center d-flex flex-column justify-content-center align-items-center" style="min-height:300vh;">
        <div id="no-products-alert" class="alert alert-warning" style="color:red;font-weight:600;" role="alert">
            Based on your filter, we did not find any products. Please request a free quote, and we will be happy to guide you!
        </div>
        <a class="btn btn-primary zoomIn mt-3" href="{{ route('free_quote') }}" data-animation="zoomIn" data-animated="true">
            Request a Free Quote
        </a>
    </div>




@endif
</div>
