@extends('frontend.layouts.master')
@section('content')
    <style>
        .select2-selection__clear {
            display: none !important;
        }
    </style>
    <!-- Include Select2 CSS & jQuery -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />


    <!-- State Selection Dropdown -->


    <!-- Loader Overlay -->
    <div id="loader-overlay">
        <div class="loader"></div>
        <p>Please wait...</p>
    </div>

    <style>
        #loader-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            z-index: 9999;
            text-align: center;
            padding-top: 20%;
        }

        .loader {
            border: 6px solid #f3f3f3;
            border-top: 6px solid #3498db;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
            display: inline-block;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>

    <!-- Ec breadcrumb start -->
    <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row ec_breadcrumb_inner">
                        <div class="col-md-6 col-sm-12">
                            <h2 class="ec-breadcrumb-title">Checkout</h2>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <!-- ec-breadcrumb-list start -->
                            <ul class="ec-breadcrumb-list">
                                <li class="ec-breadcrumb-item"><a href="{{ route('all_products') }}">Home</a></li>
                                <li class="ec-breadcrumb-item active">Checkout</li>
                            </ul>
                            <!-- ec-breadcrumb-list end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec breadcrumb end -->

    <section class="ec-page-content section-space-p checkout_page">
        <div class="container">
            <div class="row">

                <div class="ec-checkout-leftside col-lg-8 col-md-12 " style="max-height: 100vh; overflow-y: auto;">
                    <!-- checkout content Start -->
                    <div class="ec-checkout-content">
                        <div class="ec-checkout-inner">

                            @if (!Auth::check())
                                <!-- Default Contact Form -->
                                <div id="contact-form" class="ec-checkout-wrap margin-bottom-30">
                                    <div class="ec-checkout-block ec-check-login border p-4 rounded">
                                        <h3 class="ec-checkout-title d-flex justify-content-between align-items-center">
                                            Contact
                                            <a href="javascript:void(0);" id="show-login-form"
                                                style="font-weight:600; color:blue; text-decoration: underline;">Login</a>
                                        </h3>
                                        <div class="ec-check-login-form">
                                            <form action="#" method="post">
                                                <div class="mb-3">
                                                    <label>Email Address</label>
                                                    <input type="email" name="email" id="contact-email"
                                                        class="form-control" placeholder="Enter your email" required>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Login Form (Initially hidden) -->
                                <div id="login-form" style="display: none;" class="ec-checkout-wrap margin-bottom-30">
                                    <div class="ec-checkout-block ec-check-login border p-4 rounded">
                                        <h3 class="ec-checkout-title">Log In</h3>
                                        <div class="ec-check-login-form">
                                            <form action="{{ route('login.submit') }}" method="post">
                                                @csrf
                                                <div class="mb-3">
                                                    <label>Email Address</label>
                                                    <input type="email" name="email" class="form-control"
                                                        placeholder="Enter your email" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Password</label>
                                                    <input type="password" name="password" class="form-control"
                                                        placeholder="Enter your password" required>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <button class="btn btn-primary" type="submit">Login</button>
                                                    <a class="text-decoration-none" style="font-weight:600"
                                                        href="{{ route('register') }}">Create Account</a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    document.getElementById("show-login-form").addEventListener("click", function() {
                                        // Hide contact form and show login form
                                        document.getElementById("contact-form").style.display = "none";
                                        document.getElementById("login-form").style.display = "block";
                                    });
                                </script>
                            @else
                                <!-- Display Account Information if Logged In -->
                                <div class="border p-4 rounded">
                                    <h3 class="mb-3">Account</h3>
                                    <p><strong>Email:</strong> {{ Auth::user()->email }}</p>

                                    <div class="accordion" id="accountAccordion">
                                        <div class="accordion-item" style="margin-bottom:20px">
                                            <h2 class="accordion-header" id="headingOne">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapseOne">
                                                    Account Options
                                                </button>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse"
                                                data-bs-parent="#accountAccordion">
                                                <div class="accordion-body">
                                                    <form action="{{ route('logout') }}" method="post">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger">Logout</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <style>
                                            .address-card {
                                                border: 1px solid #ccc;
                                                padding: 10px;
                                                border-radius: 5px;
                                                width: 250px;
                                                cursor: pointer;
                                                transition: 0.3s;
                                                font-size: 14px;
                                                background: #f9f9f9;
                                            }

                                            .address-card:hover {
                                                border-color: blue;
                                            }

                                            .address-card.selected {
                                                border-color: green;
                                                background: #e0ffe0;
                                            }

                                            .select-btn {
                                                margin-top: 10px;
                                                background: blue;
                                                color: white;
                                                padding: 5px 10px;
                                                border: none;
                                                cursor: pointer;
                                            }
                                        </style>
                                        <a href="javascript:void(0);" id="show-addresses"
                                            style="font-weight:600; color:blue; text-decoration: underline;">Use a Saved
                                            Address</a>
                                        <div id="address-container" style="display: none; margin-top: 10px; padding: 10px;">
                                            <div id="address-list" class="address-tabs"
                                                style="display: flex; flex-wrap: wrap; gap: 10px;"></div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="ec-checkout-wrap margin-bottom-30 padding-bottom-3">
                                <div class="ec-checkout-block ec-check-bill">
                                    <h3 class="ec-checkout-title">Billing Details</h3>
                                    <div class="ec-bl-block-content">
                                        <div class="ec-check-bill-form">
                                            <form id="billing-form" action="#" method="post">
                                                <span class="ec-bill-wrap ec-bill-half">
                                                    <label>First Name <span class="text-danger">*</span></label>
                                                    <input type="text" name="firstname"
                                                        placeholder="Enter your first name" required />
                                                </span>
                                                <span class="ec-bill-wrap ec-bill-half">
                                                    <label>Last Name <span class="text-danger">*</span></label>
                                                    <input type="text" name="lastname"
                                                        placeholder="Enter your last name" required />
                                                </span>
                                                <span class="ec-bill-wrap">
                                                    <label>Address <span class="text-danger">*</span></label>
                                                    <input type="text" name="address" placeholder="Address Line 1" />
                                                </span>
                                                <span class="ec-bill-wrap">
                                                    <label>Email</label>
                                                    <input type="email" name="email" id="recipient_mail"
                                                        laceholder="Email" />
                                                </span>
                                                <span class="ec-bill-wrap ec-bill-half">
                                                    <label>City <span class="text-danger">*</span></label>
                                                    <input type="text" name="city" placeholder="City" />
                                                </span>

                                                <span class="ec-bill-wrap ec-bill-half">
                                                    <label>Post Code <span class="text-danger">*</span></label>
                                                    <input type="text" name="postalcode" placeholder="Post Code" />
                                                </span>
                                                <span class="ec-bill-wrap ec-bill-half">
                                                    <label>Country <span class="text-danger">*</span></label>
                                                    <span class="">
                                                        <select name="ec_select_country" id="ec-select-country"
                                                            class="form-control rounded-0 mt-1 mb-3">
                                                            <option value="US">United States</option>
                                                        </select>
                                                    </span>
                                                </span>
                                                <style>
                                                    /* Adjust Select2 box styling */
                                                    .select2-container--default .select2-selection--single {
                                                        height: 50px !important;
                                                        /* Adjust height */
                                                        font-size: 18px !important;
                                                        /* Adjust font size */
                                                        border: 1px solid grey !important;
                                                        /* Set border color */
                                                        display: flex !important;
                                                        align-items: center !important;
                                                        justify-content: center !important;
                                                        text-align: center !important;
                                                    }

                                                    /* Ensure full width if needed */
                                                    .select2-container {
                                                        width: 100% !important;
                                                        /* Adjust width */
                                                    }
                                                </style>
                                                <span class="ec-bill-wrap ec-bill-half">
                                                    <label> State <span class="text-danger">*</span></label>
                                                    <span class="">
                                                        <select name="ec_select_state" id="ec-select-state"
                                                            class="form-control rounded-0 mt-1 mb-3">
                                                            <option selected disabled>Select State &nbsp;</option>
                                                            <option value="Alabama">Alabama</option>
                                                            <option value="Alaska">Alaska</option>
                                                            <option value="Arizona">Arizona</option>
                                                            <option value="Arkansas">Arkansas</option>
                                                            <option value="California">California</option>
                                                            <option value="Colorado">Colorado</option>
                                                            <option value="Connecticut">Connecticut</option>
                                                            <option value="Delaware">Delaware</option>
                                                            <option value="Florida">Florida</option>
                                                            <option value="Georgia">Georgia</option>
                                                            <option value="Hawaii">Hawaii</option>
                                                            <option value="Idaho">Idaho</option>
                                                            <option value="Illinois">Illinois</option>
                                                            <option value="Indiana">Indiana</option>
                                                            <option value="Iowa">Iowa</option>
                                                            <option value="Kansas">Kansas</option>
                                                            <option value="Kentucky">Kentucky</option>
                                                            <option value="Louisiana">Louisiana</option>
                                                            <option value="Maine">Maine</option>
                                                            <option value="Maryland">Maryland</option>
                                                            <option value="Massachusetts">Massachusetts</option>
                                                            <option value="Michigan">Michigan</option>
                                                            <option value="Minnesota">Minnesota</option>
                                                            <option value="Mississippi">Mississippi</option>
                                                            <option value="Missouri">Missouri</option>
                                                            <option value="Montana">Montana</option>
                                                            <option value="Nebraska">Nebraska</option>
                                                            <option value="Nevada">Nevada</option>
                                                            <option value="New Hampshire">New Hampshire</option>
                                                            <option value="New Jersey">New Jersey</option>
                                                            <option value="New Mexico">New Mexico</option>
                                                            <option value="New York">New York</option>
                                                            <option value="North Carolina">North Carolina</option>
                                                            <option value="North Dakota">North Dakota</option>
                                                            <option value="Ohio">Ohio</option>
                                                            <option value="Oklahoma">Oklahoma</option>
                                                            <option value="Oregon">Oregon</option>
                                                            <option value="Pennsylvania">Pennsylvania</option>
                                                            <option value="Rhode Island">Rhode Island</option>
                                                            <option value="South Carolina">South Carolina</option>
                                                            <option value="South Dakota">South Dakota</option>
                                                            <option value="Tennessee">Tennessee</option>
                                                            <option value="Texas">Texas</option>
                                                            <option value="Utah">Utah</option>
                                                            <option value="Vermont">Vermont</option>
                                                            <option value="Virginia">Virginia</option>
                                                            <option value="Washington">Washington</option>
                                                            <option value="West Virginia">West Virginia</option>
                                                            <option value="Wisconsin">Wisconsin</option>
                                                            <option value="Wyoming">Wyoming</option>
                                                        </select>
                                                    </span>
                                                </span>
                                            </form>
                                        </div>
                                        <button type="button" class="btn btn-primary mt-5 mb-5"
                                            id="continue_button">Continue</button>
                                        <button id="edit-delivery-address" class="btn btn-warning mt-5 mb-5"
                                            style="display: none;">Edit Delivery Address</button>
                                        <p id="order-disabled-message"
                                            style="color: red; font-size: 14px; display: none;">

                                    </div>
                                </div>
                                <style>
                                    .loader {
                                        text-align: center;
                                        font-size: 16px;
                                        color: #666;
                                        padding: 10px;
                                    }
                                </style>
                                <div class="shipping-method mb-2" id="payment_method_section" style="display: none;">
                                    <h3 class="ec-checkout-title ">Select Payment Method</h3>
                                    <form action="">
                                        <div class="form-group radio-group">
                                            <input type="radio" id="stripe" name="payment_method" value="stripe"
                                                class="my-4"checked />
                                            <label for="stripe" class="d-block custom-label one mb-0 py-2 border mb-3">
                                                Credit Card
                                            </label>
                                            <!-- PayPal Option -->
                                            <input type="radio" id="paypal" name="payment_method" value="paypal"
                                                class="my-4" />
                                            <label for="paypal" class="d-block custom-label one mb-0 py-2 border mb-3">
                                                PayPal
                                                <span id="delivery-time" class="mt-2 d-block"></span>
                                            </label>




                                            <!-- Stripe Card Form  -->
                                            <div id="stripe-container" style="display: none;">
                                                <form id="payment-form">
                                                    <label for="cardholder-name">Cardholder Name</label>
                                                    <input type="text" id="cardholder-name" placeholder="Enter Cardholder Name" required>

                                                    <label for="card-number-element " style="margin-top:20px">Card Number</label>
                                                    <div class="card-input">
                                                        <span id="card-brand-icon"></span>
                                                        <div id="card-number-element" class="stripe-input"></div>
                                                    </div>

                                                    <div class="card-flex">
                                                        <div id="card-expiry-element" class="stripe-input"></div>
                                                        <div id="card-cvc-element" class="stripe-input"></div>
                                                    </div>

                                                    <div id="card-errors" role="alert"></div>
                                                </form>
                                            </div>

                                            <style>
                                                .stripe-input {
                                                    border: 1px solid #ccc;
                                                    padding: 10px;
                                                    border-radius: 5px;
                                                    margin-bottom: 10px;
                                                    background-color: white;
                                                    width: 100%;
                                                }

                                                .card-input {
                                                    display: flex;
                                                    align-items: center;
                                                    border: 1px solid #ccc;
                                                    padding: 10px;
                                                    border-radius: 5px;
                                                    background-color: white;
                                                    margin-bottom: 10px;
                                                }

                                                #card-brand-icon {
                                                    width: 40px;
                                                    height: 25px;
                                                    background-size: contain;
                                                    background-repeat: no-repeat;
                                                    background-position: center;
                                                    margin-right: 10px;
                                                }

                                                .card-flex {
                                                    display: flex;
                                                    gap: 10px;
                                                }

                                                #card-expiry-element,
                                                #card-cvc-element {
                                                    flex: 1;
                                                }
                                            </style>
                                        </div>
                                    </form>
                                    <span class="ec-check-order-btn" id="place-order-button">
                                        <a class="btn btn-primary disabled" href="javascript:void(0);">Place Order</a>
                                    </span>
                                    {{-- <p id="order-disabled-message" style="color: red; font-size: 14px; display: none;"> --}}
                                    </p>
                                </div>
                            </div>




                        </div>

                    </div>
                    <!--cart content End -->
                </div>

                <!-- Sidebar Area Start -->
                <div class="ec-checkout-rightside col-lg-4 col-md-12" >
                    <div class="ec-sidebar-wrap">
                        <!-- Sidebar Summary Block -->
                        <div class="ec-sidebar-block">
                            <div class="ec-sb-title">
                                <h3 class="ec-sidebar-title">Summary</h3>
                            </div>
                            <div class="ec-sb-block-content">
                                <div class="ec-checkout-pro">
                                    @if ($carts->isEmpty())
                                        @php
                                            $totalPrice = 0;
                                        @endphp
                                        <p class="no-cart-message">Your cart is empty. <a
                                                href="{{ route('all_products') }}">Shop now</a></p>
                                    @else
                                        @php
                                            $subtotal = 0; // Initialize subtotal
                                            $parcels = []; // Initialize parcels array
                                            $totalWeight = 0; // Initialize total weight
                                            $totalVolume = 0; // Initialize total volume
                                        @endphp
                                        @foreach ($carts as $cart)
                                            @php
                                                $quantity = $cart->quantity;
                                                $product = $cart->product;
                                                $productImages = $product->productImages;
                                                $firstImage = $productImages->first();
                                                $price = $product->selling_price ?? 0.0; // Get product price or default to 0
                                                $totalPrice = $price * $quantity; // Calculate total for this item
                                                $subtotal += $totalPrice;

                                                // Fetch all part_ids for the given product_id from ProductPart model
                                                $partIds = \App\Models\ProductPart::where(
                                                    'product_id',
                                                    $product->product_id,
                                                )->pluck('part_id');

                                                // Fetch parts from Part model where part_id is in the list
                                                $parts = \App\Models\Part::whereIn('part_id', $partIds)->get();

                                                // Get max delivery time for each part_type (Service and Physical)
                                                $maxServiceTime = $parts
                                                    ->where('part_type', 'Service')
                                                    ->max('delivery_time');
                                                $maxPhysicalTime = $parts
                                                    ->where('part_type', 'Physical')
                                                    ->max('delivery_time');

                                                // Sum the max delivery times
                                                $totalMaxDeliveryTime =
                                                    ($maxServiceTime ?? 0) + ($maxPhysicalTime ?? 0) + 7;

                                                // Convert total delivery time to weeks (rounded to 2 decimal places)
                                                $totalMaxDeliveryTimeInWeeks = round($totalMaxDeliveryTime / 7, 2);
                                                $products[] = [
                                                    'id' => $product->product_id,
                                                    'name' => $product->product_frontend_name,
                                                    'delivery_time_in_week' => $totalMaxDeliveryTimeInWeeks,
                                                ];

                                                $packagingProductId = $product->packaging_product_id;

                                                // Fetch package details from PackageProduct model
                                                $packages = \App\Models\PackageProduct::where(
                                                    'packaging_product_id',
                                                    $packagingProductId,
                                                )->get();

                                                foreach ($packages as $package) {
                                                    $parcels[] = [
                                                        'length' => $package->length_of_package,
                                                        'width' => $package->width_of_package,
                                                        'height' => $package->depth_of_package,
                                                        'distance_unit' => 'in',
                                                        'weight' => $package->weight_of_package,
                                                        'mass_unit' => 'lb',
                                                    ];
                                                }
                                            @endphp

                                            @php
                                                $slug = Str::slug(
                                                    $product->product_frontend_name ?? $product->product_name,
                                                ); // Generate slug dynamically
                                            @endphp
                                            <div class="col-sm-12 mb-6">
                                                <div class="ec-product-inner">
                                                    <div class="ec-pro-image-outer">
                                                        <div class="ec-pro-image">
                                                            <a href="{{ route('product_details', ['slug' => $slug, 'id' => $product->product_id]) }}"
                                                                class="image">
                                                                <img class="main-image"
                                                                    src="{{ $firstImage ? asset('user/uploads/products/images/' . $firstImage->image) : url('/') . '/frontend/assets/images/our_brands/product_demo_1.png' }}"
                                                                    alt="{{ $product->product_name }}" />
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="ec-pro-content">
                                                        <h5 class="ec-pro-title">
                                                            <a
                                                                href="{{ route('product_details', ['slug' => $slug, 'id' => $product->product_id]) }}">{{ $product->product_id }}</a>
                                                        </h5>
                                                        <span class="ec-price">
                                                            <span class="new-price">${{ number_format($price, 2) }}</span>
                                                        </span>
                                                        <p>Quantity: {{ $cart->quantity }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>

                                <div class="ec-checkout-summary">
                                    @php
                                        // Calculate sales tax

                                        $totalSalesTax = $subtotal * ($rate->rate / 100);
                                    @endphp

                                    <div>
                                        <span class="text-left">Sub-Total</span>
                                        <span class="text-right" id="sub-total"
                                            data-value="{{ $subtotal }}">${{ number_format($subtotal, 2) }}</span>
                                    </div>
                                    <div>
                                        <span class="text-left" >Sales Tax ({{ $rate->rate }}%)</span>
                                        <span class="text-right" id="sales-tax" data-value="{{ $totalSalesTax }}">${{ number_format($totalSalesTax, 2) }}</span>
                                    </div>




                                    <div>
                                        <span class="text-left">Shipping Charges</span>
                                        <span id="shipping-charge" style="font-weight: bold; color: blue;"
                                            class="text-right">Enter full address</span>
                                    </div>
                                    <div>
                                        <span class="text-left">Total Amount</span>
                                        <span id="total-amount"
                                            class="text-right">${{ number_format($subtotal + $totalSalesTax, 2) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Sidebar Summary Block -->
                    </div>

                    <!-- Sidebar Payment Block -->
                    <div class="ec-sidebar-wrap ec-check-pay-img-wrap">
                        <!-- Sidebar Payment Block -->
                        <div class="ec-sidebar-block">
                            <div class="ec-sb-title">
                                <h3 class="ec-sidebar-title">Payment Method</h3>
                            </div>
                            <div class="ec-sb-block-content">
                                <div class="ec-check-pay-img-inner w-100">
                                    <div class="ec-check-pay-img mt-0">
                                        <img id="card-brand-icon" src="{{ asset('images/card-icons/visa.png') }}"
                                            alt="Card Brand">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Sidebar Payment Block -->
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Ec checkout page Start-->
    <!-- Ec checkout page End -->
@endsection
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="https://js.stripe.com/v3/"></script>

    <!-- Initialize Select2 -->
    <script>
        $(document).ready(function() {
            $('#ec-select-state').select2({
                placeholder: "Search for a state...",
                allowClear: true
            });
        });
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
    <script>
        $(document).ready(function() {
            // When the user types in the contact email input field, transfer the value to recipient_mail
            $('#contact-email').on('input', function() {
                var email = $(this).val();

                // Set the value of the recipient_mail field to the entered email
                $('#recipient_mail').val(email);
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#stripe-container").slideDown();

            $('input[name="payment_method"]').change(function() {
                if ($(this).val() === "stripe") {
                    $("#stripe-container").slideDown();

                } else {
                    $("#stripe-container").slideUp();
                }
            });
        });
    </script>
   <script>
    var stripe = Stripe("pk_test_51QxW6jRfXKkfl1pNbuwaElTrV7w9XEOonIySxudK0kJZPjvZkWxIeUhDCIl2y9887LTPTrx97iaHtV5ozhwR0EEs00axmltXQn");
    var elements = stripe.elements();

    var cardNumber = elements.create("cardNumber");
    var cardExpiry = elements.create("cardExpiry");
    var cardCvc = elements.create("cardCvc");

    cardNumber.mount("#card-number-element");
    cardExpiry.mount("#card-expiry-element");
    cardCvc.mount("#card-cvc-element");
    let totalAmount = $("#total-amount").text().replace("$", "").trim(); // Extract price

// Check if totalAmount is empty or not a number
if (!totalAmount || isNaN(totalAmount)) {
    totalAmount = "100.00"; // Set default value (e.g., $100.00)
}

let amountInCents = Math.round(parseFloat(totalAmount) * 100); // Convert to cents
    // Payment Request Button for Apple Pay, Google Pay, and Pay Later Options
    var paymentRequest = stripe.paymentRequest({
        country: 'US',
        currency: 'usd',
        total: {
            amount: amountInCents, // Set dynamic amount
            label: 'Total Payment'
        },
        requestPayerName: true,
        requestPayerEmail: true,
        paymentMethodTypes: ['card', 'apple_pay', 'google_pay', 'afterpay_clearpay', 'klarna', 'affirm'], // Add payment options
    });

    var prButton = elements.create('paymentRequestButton', { paymentRequest: paymentRequest });

    paymentRequest.canMakePayment().then(function(result) {
        if (result) {
            prButton.mount('#payment-request-button');
        } else {
            console.warn("Payment Request Button not available.");
            document.getElementById('payment-request-button').style.display = 'none';
        }
    });

    // Detect Card Brand
    cardNumber.on("change", function(event) {
        var brand = event.brand;
        var cardBrandIcon = document.getElementById("card-brand-icon");
        var brandIcons = {
            visa: "/images/card-icons/visa.png",
            mastercard: "/images/card-icons/master.png",
            amex: "/images/card-icons/america.png",
            discover: "/images/card-icons/discover.png",
            diners: "/images/card-icons/diners.png",
            jcb: "/images/card-icons/jcb.png",
            unionpay: "/images/card-icons/union.png"
        };

        cardBrandIcon.style.backgroundImage = brandIcons[brand] ? `url(${brandIcons[brand]})` : "none";
    });
</script>
    <script>
        document.getElementById('show-addresses').addEventListener('click', function() {
            let userId = "{{ auth()->id() }}"; // Get logged-in user ID

            fetch("{{ route('user.addresses') }}?user_id=" + userId)
                .then(response => response.json())
                .then(data => {
                    let addressList = document.getElementById('address-list');
                    addressList.innerHTML = ""; // Clear previous data

                    if (data.length > 0) {
                        data.forEach(address => {
                            let addressCard = document.createElement('div');
                            addressCard.classList.add('address-card');
                            addressCard.innerHTML = `
                            <b>${address.first_name}&nbsp;${address.last_name}</b><br>
                            <strong>${address.street1}</strong><br>
                            ${address.city}, ${address.state} - ${address.zip}<br>
                            ${address.country}<br>
                            <small>Phone: ${address.phone}</small>
                            <button class="select-btn" onclick="selectAddress(${address.id})">Deliver Here</button>
                        `;
                            addressList.appendChild(addressCard);
                        });
                    } else {
                        // Show "No Address Found" message
                        addressList.innerHTML =
                            `<p style="color:red; font-weight:600;">You did not add any address.</p>`;
                    }

                    document.getElementById('address-container').style.display = 'block';
                })
                .catch(error => console.error('Error fetching addresses:', error));
        });

        function selectAddress(addressId) {
            alert("Address selected!");
            document.getElementById('address-container').style.display = 'none';
            fetch("{{ route('user.address.details') }}?address_id=" + addressId)
                .then(response => response.json())
                .then(data => {
                    if (data) {
                        console.log(data);
                        document.querySelector('input[name="firstname"]').value = data.first_name;
                        document.querySelector('input[name="lastname"]').value = data.last_name;
                        document.querySelector('input[name="address"]').value = data.street1;
                        document.querySelector('input[name="city"]').value = data.city;
                        document.querySelector('input[name="postalcode"]').value = data.zip;
                        document.querySelector('input[name="email"]').value = data.email;
                        document.getElementById('ec-select-country').value = data.country;
                        $('#ec-select-state').select2(); // Initialize Select2

                        let selectedState = data.state; // Change this dynamically

                        setTimeout(() => {
                            $('#ec-select-state').val(selectedState).trigger('change');
                        }, 500); // Delay to ensure Select2 initializes

                    }

                })
                .catch(error => console.error('Error fetching address details:', error));
        }
    </script>
    <script>
        $("#edit-delivery-address").click(function() {
            // Enable all input fields in the billing form
            $("#billing-form :input").prop("disabled", false);

            // Hide "Edit Delivery Address" button and show "Continue" button
            $(this).hide();
            $("#continue_button").show();

            // Hide the payment method section again
            $("#payment_method_section").hide();
        });
    </script>
    <script>
        var parcels = @json($parcels);
        var products = @json($products);
    </script>
    <script>
        $(document).ready(function() {
            function fetchShippingCharge() {


                let state = $("#ec-select-state").val();
                let pinCode = $('input[name="postalcode"]').val();
                let city = $('input[name="city"]').val();
                let address = $('input[name="address"]').val();
                let email = $('#recipient_mail').val();



                if (!state || !pinCode || !city || !address) {
                    $("#shipping-charge").html('<span style="color: red;">Enter full address</span>');
                    $("#total-amount").html(`$${parseFloat($("#total-amount").data("value")).toFixed(2)}`);
                    disablePlaceOrder("Please provide a complete address to calculate shipping.");

                    return;
                }

                // Show loader before fetching
                $("#shipping-charge").html('<span style="color: orange;">Loading...</span>');
                $("#total-amount").html('<span style="color: orange;">Calculating...</span>');
                disablePlaceOrder("Calculating shipping charges, please wait...");


                $.ajax({
                    url: route_get_shipping_rate, // Using the route variable
                    type: "GET",
                    data: {
                        state: state,
                        pincode: pinCode,
                        city: city,
                        address: address,
                        parcels: parcels,

                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.shipping_charge) {
                            let shippingCharge = parseFloat(response.shipping_charge);
                            let subTotal = parseFloat($("#sub-total").data("value"));
                            let salesTax = parseFloat($("#sales-tax").data("value"));

                            let totalAmount = subTotal + shippingCharge + salesTax ;

                            $("#shipping-charge").html(
                                `<span style="color: green;">$${shippingCharge.toFixed(2)}</span>`);
                            $("#total-amount").html(
                                `<span style="color: green;">$${totalAmount.toFixed(2)}</span>`);

                            enablePlaceOrder();
                        } else {
                            $("#shipping-charge").html(
                                '<span style="color: red;">Shipping not available</span>');
                            $("#total-amount").html('<span style="color: red;">N/A</span>');
                            disablePlaceOrder("Shipping is not available for this location.");
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error("AJAX Error:", textStatus, errorThrown, jqXHR.responseText);

                        let errorMessage = `Error: ${textStatus} - ${errorThrown}`;

                        if (jqXHR.responseJSON && jqXHR.responseJSON.message) {
                            errorMessage = jqXHR.responseJSON
                                .message; // Extract Laravel API error message if available
                        } else if (jqXHR.responseText) {
                            errorMessage = jqXHR.responseText; // Fallback to full response text
                        }

                        $("#shipping-charge").html(
                            '<span style="color: red;">Shipping not available</span>');
                        $("#total-amount").html('<span style="color: red;">N/A</span>');

                        disablePlaceOrder(errorMessage);
                    }
                });
            }

            function disablePlaceOrder(message) {

                $("#place-order-button a").addClass("disabled").attr("href", "javascript:void(0);");
                $("#order-disabled-message").html(`<span style="color: red;">${message}</span>`).show();
            }




            function enablePlaceOrder() {
                let totalAmount = $("#total-amount").text().replace("$", "").trim(); // Extract price
                console.log('final payment'.totalAmount);
                let selectedPaymentMethod = $('input[name="payment_method"]:checked')
                    .val(); // Get selected payment method

                console.log("Total Amount:", totalAmount);
                console.log("Selected Payment Method:", selectedPaymentMethod);

                // If total amount is missing, disable button
                if (!totalAmount || totalAmount === "0" || isNaN(totalAmount)) {
                    $("#place-order-button a")
                        .addClass("disabled")
                        .attr("href", "javascript:void(0);");
                    $("#order-disabled-message").text("Total amount is required to place an order.").show();
                    return;
                } else {
                    $("#place-order-button a").removeClass("disabled");
                    $("#order-disabled-message").hide();
                    $("#payment_method_section").show(); // Show Payment Method section
                    $("#billing-form :input").prop("disabled", true);
                    $("#edit-delivery-address").show();
                    $("#continue_button").hide();

                }

                // Store amount in session via AJAX
                $.ajax({
                    url: "{{ route('store.totalAmount') }}",
                    type: "POST",
                    data: {
                        address: {
                            name: $('input[name="firstname"]').val() + " " + $('input[name="lastname"]').val(),
                            street1: $('input[name="address"]').val(),
                            city: $('input[name="city"]').val(),
                            state: $("#ec-select-state").val(),
                            zip: $('input[name="postalcode"]').val(),
                            country: "US"
                        },
                        email: $('#recipient_mail').val(),
                        parcels: parcels,
                        products: products,
                        total_amount: totalAmount,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        console.log("Total amount stored in session:", response.total_amount);
                    }
                });
            }

            function processStripePayment(paymentMethodId, amount) {
                $.ajax({
                    url: "{{ route('stripe.payment') }}",
                    type: "POST",
                    data: {
                        payment_method_id: paymentMethodId,
                        total_amount: amount,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.success) {
                            window.location.href = "{{ route('stripe.success') }}?session_id=" + response.session_id;
                        } else {
                            alert("Payment failed: " + response.message);
                        }
                    }
                });
            }
            $("#place-order-button").on("click", function(event) {
                let totalAmount = $("#total-amount").text().replace("$", "").trim();
                let selectedPaymentMethod = $('input[name="payment_method"]:checked').val();
                let email = $('#recipient_mail').val();
                if (!email) {
                    alert("Please Provide Email Id in Billing Details ");
                    return false;
                }
                console.log(totalAmount);
                if (!totalAmount || totalAmount === "0.00" || isNaN(totalAmount)) {
                    alert("Total amount is required to place an order.");
                    return false;
                }

                if (!selectedPaymentMethod) {
                    alert("Please select a payment method.");
                    return false;
                }

                if (selectedPaymentMethod === "paypal") {
                    window.location.href = "{{ route('paypal.payment') }}"; // Redirect to PayPal
                } else if (selectedPaymentMethod === "stripe") {

                    stripe.createPaymentMethod({
                        type: 'card',
                        card: cardNumber,
                        billing_details: {
                            email: email
                        }
                    }).then(function(result) {
                        if (result.error) {
                            $("#loader-overlay").fadeOut();
                            alert(result.error.message);
                        } else {
                          $("#loader-overlay").fadeIn();
                            processStripePayment(result.paymentMethod.id, totalAmount);
                        }
                    });
                }
            });
            $("#continue_button").on("click", function() {
                fetchShippingCharge(); // Trigger shipping charge calculation
            });

            // Trigger AJAX on state change or pin code input


            // Also trigger when a saved address is selected
            $(".saved-address").change(function() {
                let selectedAddress = $(this).val(); // Assume this contains JSON with state & pin
                let addressData = JSON.parse(selectedAddress);
                $("#ec-select-state").val(addressData.state).trigger("change");
                $('input[name="city"]').val(addressData.city).trigger("input");
                $('input[name="postalcode"]').val(addressData.pincode).trigger("input");
            });
        });

        // Define route in JavaScript
        var route_get_shipping_rate = @json(route('shipping.rate'));
    </script>
@endpush
