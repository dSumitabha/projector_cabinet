@extends('frontend.layouts.master')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')
    <!-- Ec breadcrumb start -->
    <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row ec_breadcrumb_inner">
                        <div class="col-md-6 col-sm-12">
                            <h2 class="ec-breadcrumb-title">Cart</h2>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <!-- ec-breadcrumb-list start -->
                            <ul class="ec-breadcrumb-list">
                                <li class="ec-breadcrumb-item"><a href="{{ route('all_products') }}">Home</a></li>
                                <li class="ec-breadcrumb-item active">Cart</li>
                            </ul>
                            <!-- ec-breadcrumb-list end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec breadcrumb end -->
    <!-- Ec cart page -->
    <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row">
                <div class="ec-cart-leftside col-lg-8 col-md-12 ">
                    <!-- cart content Start -->
                    <div class="ec-cart-content">
                        <div class="ec-cart-inner">
                            <div class="row">
                                <form action="#">
                                    <div class="table-content cart-table-content">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Product</th>
                                                    <th>Price</th>
                                                    <th style="text-align: center;">Quantity</th>
                                                    <th>Sales Tax</th> <!-- Add Sales Tax column -->
                                                    {{-- <th>Total</th> --}}
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($carts->isEmpty())
                                                    @php
                                                        $totalPrice = 0;
                                                        $subtotal = 0;
                                                        $totalTax = 0;
                                                    @endphp
                                                    <tr>
                                                        <td colspan="5" class="no-cart-message">
                                                            No cart items added yet.
                                                        </td>
                                                    </tr>
                                                @else
                                                    @php
                                                        $subtotal = 0; // Initialize subtotal
                                                        $totalTax = 0;
                                                    @endphp
                                                    @foreach ($carts as $cart)
                                                        @php
                                                            $product = $cart->product; // Get the product associated with the cart
                                                            $firstImage = null; // Default to null
                                                            $quantity = $cart->quantity ?? 1; // Assume quantity is stored in cart or default to 1
                                                            $price = $product->selling_price ?? 0.0; // Get product price or default to 0
                                                            $totalPrice = $price * $quantity; // Calculate total for this item
                                                            $salesTax = $totalPrice * ($rate->rate / 100); // Calculate sales tax for this product
                                                            $subtotal += $totalPrice; // Add to subtotal
                                                            $totalTax += $salesTax; // Add to total tax

                            $slug = Str::slug($product->product_frontend_name ?? $product->product_name); // Generate slug dynamically

                                                            if ($product) {
                                                                $productImages = $product->productImages;
                                                                if ($productImages && $productImages->isNotEmpty()) {
                                                                    $firstImage = $productImages->first();
                                                                }
                                                            }
                                                        @endphp

                                                        <tr>
                                                            <td data-label="Product" class="ec-cart-pro-name">
                                                                <a
                                                                    href="{{ route('product_details', ['slug' => $slug, 'id' => $product->product_id]) }}">
                                                                    @if ($firstImage)
                                                                        <img class="ec-cart-pro-img mr-4"
                                                                            src="{{ asset('user/uploads/products/images/' . $firstImage->image) }}"
                                                                            alt="{{ $product->product_name }}" />
                                                                    @else
                                                                        <img class="ec-cart-pro-img mr-4"
                                                                            src="{{ url('/') }}/frontend/assets/images/our_brands/product_demo_1.png"
                                                                            alt="Default Image" />
                                                                    @endif
                                                                    {{ $product->product_frontend_name }}
                                                                </a>
                                                            </td>
                                                            <td data-label="Price" class="ec-cart-pro-price"><span
                                                                    class="amount">${{ $product->selling_price ?? '0.00' }}</span>
                                                            </td>
                                                            <td data-label="Quantity" class=""
                                                                style="text-align: center;">
                                                                <input class="cart-plus-minus" type="text"
                                                                    name="cartqtybutton" value="1" readonly />
                                                            </td>
                                                            <td data-label="Sales Tax" class="ec-cart-pro-tax">
                                                                <span class="amount">${{ number_format($salesTax, 2) }}</span>
                                                            </td>
                                                            <td data-label="Remove" class="ec-cart-pro-remove">
                                                                <a href="javascript:void(0);" class="remove-cart-item"
                                                                    data-id="{{ $cart->id }}">
                                                                    <i class="ecicon eci-trash-o"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                            <style>
                                                /* Ensure the input field has proper padding and is centered */
                                                .cart-plus-minus {
                                                    text-align: center;
                                                    /* Center the text inside the input */
                                                    border: 1px solid #ccc;
                                                    /* Optional: Add a border to the input */
                                                    padding: 10px;
                                                    /* Optional: Add padding for a more readable input */
                                                    width: 50px;
                                                    /* Optional: Adjust width for a consistent size */
                                                    background-color: #f1f1f1;
                                                    /* Optional: Light background to indicate readonly state */
                                                    cursor: not-allowed;
                                                    /* Change cursor to indicate the field is read-only */
                                                }

                                                /* Center the input inside the td (this is important if td has dynamic width) */
                                                .ec-cart-pro-qty {
                                                    display: flex;
                                                    justify-content: center;
                                                    align-items: center;
                                                    height: 100%;
                                                    /* Make sure the input is vertically centered */
                                                }
                                            </style>
                                            <style>
                                                /* Style for the no cart message */
                                                .no-cart-message {
                                                    text-align: center;
                                                    font-size: 18px;
                                                    font-weight: bold;
                                                    color: #ff0000;
                                                    /* Red color for emphasis */
                                                    padding: 20px;
                                                    background-color: #f1f1f1;
                                                    border-radius: 10px;
                                                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                                                    width: 100%;
                                                }
                                            </style>
                                        </table>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="ec-cart-update-bottom">
                                                <a href="{{ route('all_products') }}">Continue Shopping</a>
                                                @if ($carts->count() > 0)
                                                    <a href="{{ route('checkout') }}" id="checkout-button"
                                                        class="btn btn-primary text-white">Check
                                                        Out</a>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--cart content End -->
                </div>
                <!-- Sidebar Area Start -->
                <div class="ec-cart-rightside col-lg-4 col-md-12">
                    <div class="ec-sidebar-wrap">
                        <!-- Sidebar Summary Block -->
                        <div class="ec-sidebar-block">
                            <div class="ec-sb-title">
                                <h3 class="ec-sidebar-title">Summary</h3>
                            </div>
                            <div id="loading" style="display:none;">
                                <img src="https://i.gifer.com/4V0b.gif" alt="Loading..." />
                            </div>
                            {{-- <div class="ec-sb-block-content">
                                <h4 class="ec-ship-title">Check Delivery Status</h4>
                                <div class="ec-cart-form">
                                    <p>Enter your postal code to check delivery status</p>
                                    <form action="#" method="post">
                                        <span class="ec-cart-wrap">
                                            <label>Postal Code *</label>
                                            <input type="text" name="postalcode" id="postalcode"
                                                placeholder="Postal Code">
                                        </span>
                                        <span class="ec-cart-wrap">
                                            <label>Country *</label>
                                            <input type="text" name="country" id="country" placeholder="" readonly>
                                        </span>
                                        <span class="ec-cart-wrap">
                                            <label>State/Province *</label>
                                            <input type="text" name="state" id="state" placeholder="" readonly>
                                        </span>
                                    </form>
                                </div>
                            </div> --}}

                            <div class="ec-sb-block-content">
                                <div class="ec-cart-summary-bottom">
                                    <div class="ec-cart-summary">
                                        <div>
                                            <span class="text-left">Sub-Total</span>
                                            <span class="text-right">${{ number_format($subtotal, 2) }}</span>
                                        </div>
                                        <div>
                                            <span class="text-left">Sales Tax Rate ({{ $rate->rate }}%)</span>
                                            @if ($carts->isEmpty())
                                            <span class="text-right">$ 0.00 </span> <!-- Total Sales Tax -->

                                            @else
                                            <span class="text-right">${{ number_format($totalTax, 2) }}</span> <!-- Total Sales Tax -->

                                            @endif
                                        </div>
                                        <div>
                                            <span class="text-left">Coupon Discount</span>
                                            <span class="text-right"><a class="ec-cart-coupan">Apply Coupon</a></span>
                                        </div>
                                        <div class="ec-cart-coupan-content">
                                            <form class="ec-cart-coupan-form">
                                                <input class="ec-coupan" type="text" required placeholder="Enter Your Coupon Code" name="ec-coupan" value="">
                                                <button id="applyCouponBtn" class="ec-coupan-btn button btn-primary" type="button">Apply</button>
                                            </form>
                                        </div>
                                        <div class="ec-cart-summary-total">
                                            <span class="text-left">Total Amount</span>
                                            <span class="text-right">${{ number_format($subtotal + $totalTax, 2) }}</span> <!-- Total Amount with tax -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Sidebar Summary Block -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Ec cart page End -->
@endsection
@push('script')
    <script>
        // Pass the route URL to JavaScript using Blade's route() helper
        const removeCartRoute = "{{ route('cart.remove', ['id' => '__id__']) }}";
    </script>
    <script>
        document.querySelectorAll('.remove-cart-item').forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();

                // Get the cart item ID
                let cartId = event.target.closest('a').getAttribute('data-id');

                // Show SweetAlert confirmation
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You are about to remove this item from your cart.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, remove it!',
                    cancelButtonText: 'No, keep it'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Replace '__id__' with the actual cart ID in the URL
                        let url = removeCartRoute.replace('__id__', cartId);

                        // Send the AJAX request to remove the cart item using the named route
                        fetch(url, {
                                method: 'GET',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector(
                                        'meta[name="csrf-token"]').content
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                console.log(data.cartCount.original.count);
                                if (data.success) {
                                    // Show success message
                                    Swal.fire('Removed!', data.message, 'success');

                                    // Update the cart count
                                    document.querySelector('.cart-count-lable').innerText = data
                                        .cartCount;

                                    // Optionally, remove the item from the table
                                    event.target.closest('tr').remove();

                                    if (data.cartCount.original.count == 0) {
                                        document.getElementById('checkout-button').style
                                            .display = 'none';
                                    }
                                } else {
                                    // Show specific error message returned from the server
                                    Swal.fire('Error!', data.message ||
                                        'There was an issue removing the item.', 'error');
                                }
                            })
                            .catch(err => {
                                // Handle fetch errors (e.g., network issues)
                                Swal.fire('Error!',
                                    'An error occurred while removing the item. Please try again later.',
                                    'error');
                            });
                    }
                });
            });
        });
    </script>
    <script>
        document.getElementById('postalcode').addEventListener('input', function() {
            const postalcode = this.value;

            // Check if the postal code is at least 5 digits long
            if (postalcode.length >= 5) {
                // Show loading indicator
                document.getElementById('loading').style.display = 'block';
                let url = `{{ route('location.fetch', ['postalcode' => '__POSTALCODE__']) }}`.replace(
                    '__POSTALCODE__', postalcode);
                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        if (data.country && data.state) {
                            document.getElementById('country').value = data.country;
                            document.getElementById('state').value = data.state;
                        } else if (data.error) {
                            // Show SweetAlert error if there's a custom error message
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: data.error || 'Something went wrong. Please try again later.',
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching location:', error);

                        // Show SweetAlert error for other errors (e.g. network issues)
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Could not fetch location data. Please try again later.',
                        });
                    })
                    .finally(() => {
                        // Hide loading indicator once data is fetched or error occurs
                        document.getElementById('loading').style.display = 'none';
                    });
            } else {
                // Hide loading indicator if postal code length is not 6 digits
                document.getElementById('loading').style.display = 'none';
            }
        });
    </script>
   <script>
    $(document).ready(function() {
        $("#applyCouponBtn").click(function() {
            let applyBtn = $(this);
            applyBtn.prop("disabled", true).text("Checking..."); // Change button text

            setTimeout(function() {
                // Show SweetAlert after checking
                Swal.fire({
                    icon: "error",
                    title: "Coupon Not Valid",
                    text: "Sorry, the coupon you entered is not valid.",
                });

                applyBtn.prop("disabled", false).text("Apply"); // Reset button
            }, 2000); // Simulating 2-second delay
        });
    });
    </script>
@endpush
