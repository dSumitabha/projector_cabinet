@extends('frontend.layouts.master')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .modal-dialog.modal-xl {
            max-width: 90%;
            /* Adjust the width */
        }

        .modal-footer {
            justify-content: space-between;
        }

        .single-product-cover {
    visibility: hidden;
    opacity: 0;
    transition: opacity 0.5s ease-in-out;
}
.slider-loaded .single-product-cover {
    visibility: visible;
    opacity: 1;
}
    </style>
    <!-- Ec breadcrumb start -->
    <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row ec_breadcrumb_inner">
                        <div class="col-md-6 col-sm-12">
                            <h2 class="ec-breadcrumb-title">{{ $product->product_id }} - {{ $product->product_name }}</h2>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <!-- ec-breadcrumb-list start -->
                            <ul class="ec-breadcrumb-list">
                                <li class="ec-breadcrumb-item"><a href="{{ route('all_products') }}">Home</a></li>
                                <li class="ec-breadcrumb-item active">Products</li>
                            </ul>
                            <!-- ec-breadcrumb-list end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec breadcrumb end -->

    <!-- Sart Single product -->
    <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row">
                <div class="ec-pro-rightside ec-common-rightside col-lg-12 order-lg-last col-md-12 order-md-first">

                    <!-- Single product content Start -->
                    <div class="single-pro-block">
                        <div class="single-pro-inner">
                            <div class="row">
                                <div class="single-pro-img">
                                    <div class="single-product-scroll">
                                        <div class="single-product-cover">
                                            @php
                                                $productImages = $product->productImages;
                                            @endphp

                                            @if ($productImages->isNotEmpty())
                                                @foreach ($productImages as $index => $image)
                                                    <div class="single-slide" id="main-image-{{ $index }}">
                                                        @if (in_array(pathinfo($image->image, PATHINFO_EXTENSION), ['mp4', 'mkv', 'avi']))
                                                            <!-- Display video if file extension is mp4, mkv, or avi -->
                                                            <video class="img-responsive open-modal" id="main-video"
                                                                data-src="{{ asset('user/uploads/products/images/' . $image->image) }}"
                                                                height="300px" controls>
                                                                <source
                                                                    src="{{ asset('user/uploads/products/images/' . $image->image) }}"
                                                                    type="video/{{ pathinfo($image->image, PATHINFO_EXTENSION) }}">
                                                                Your browser does not support the video tag.
                                                            </video>
                                                        @else
                                                            <img class="img-responsive open-modal" height="300px"
                                                                src="{{ asset('user/uploads/products/images/' . $image->image) }}"
                                                                alt="{{ $product->product_name }}"
                                                                data-src="{{ asset('user/uploads/products/images/' . $image->image) }}">
                                                        @endif
                                                    </div>
                                                @endforeach
                                            @else
                                                {{-- Default image if no product images are available --}}
                                                <div class="single-slide">
                                                    <img class="img-responsive open-modal"
                                                        src="{{ asset('frontend/assets/images/our_brands/product_demo_1_xl.png') }}"
                                                        alt="Default Image"
                                                        data-src="{{ asset('frontend/assets/images/our_brands/product_demo_1_xl.png') }}">
                                                </div>
                                            @endif
                                        </div>

                                        {{-- Thumbnails: Only show if more than one image is present --}}
                                        @if ($productImages->count() > 1)
                                            <div class="single-nav-thumb">
                                                @foreach ($productImages as $index => $image)
                                                    <div class="single-slide">
                                                        @php
                                                            $extension = pathinfo($image->image, PATHINFO_EXTENSION);
                                                            $isVideo = in_array($extension, ['mp4', 'mkv', 'avi']);
                                                        @endphp
                                                        @if ($isVideo)
                                                            <img class="img-responsive thumbnail-image"
                                                                data-index="{{ $index }}"
                                                                src="{{ asset('frontend/video.jpg') }}"
                                                                alt="{{ $product->product_name }}"
                                                                data-src="{{ asset('user/uploads/products/images/' . $image->image) }}">

                                                            {{-- <video class="img-responsive thumbnail-video" data-index="{{ $index }}" controls style="max-width: 100%;">
                                                                <source
                                                                    src="{{ asset('user/uploads/products/images/' . $image->image) }}"
                                                                    type="video/{{ $extension }}">
                                                                Your browser does not support the video tag.
                                                            </video> --}}
                                                        @else
                                                            <img class="img-responsive thumbnail-image"
                                                                data-index="{{ $index }}"
                                                                src="{{ asset('user/uploads/products/images/' . $image->image) }}"
                                                                alt="{{ $product->product_name }}"
                                                                data-src="{{ asset('user/uploads/products/images/' . $image->image) }}">
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>



                                <div class="single-pro-desc">
                                    <div class="single-pro-content">
                                        <h5 class="ec-single-title">

                                            <span
                                                style="color:rgba(51, 28, 28, 0.726);font-size:17.5px;!important">{{ $product->product_frontend_name ? $product->product_frontend_name : $product->product_id }}</span>
                                        </h5>
                                        <div class="ec-single-price-stoke">

                                            <div class="ec-single-stoke">
                                                <span class="ec-single-ps-title fw-bold" style="color:rgb(43, 179, 43)">IN
                                                    STOCK</span>
                                                <span class="ec-single-sku">Model#: {{ $product->product_id }}</span>
                                            </div>
                                        </div>
                                        {{-- <h6 class="ec-single-title" style="color:rgba(51, 28, 28, 0.726)">
                                            {{ $product->product_frontend_name ? $product->product_frontend_name : $product->product_id }}
                                        </h6> --}}
                                         <p>{{ $product->product_frontend_description ?? '' }}</p>
                                        <div class="ec-single-desc">

                                        </div>


                                        <div class="ec-single-price-stoke">
                                            <div class="ec-single-price">
                                                <span class="ec-single-ps-title">As low as</span>
                                                <span
                                                    class="new-price">${{ number_format($product->selling_price, 2) }}</span>
                                            </div>

                                        </div>

                                        <div class="ec-single-qty">

                                            <div class="ec-single-cart">
                                                <form id="add-to-cart-form" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="product_id"
                                                        value="{{ $product->product_id }}">
                                                    <input type="hidden" name="quantity" value="1">
                                                    <button type="button" class="btn btn-primary" id="add-to-cart-btn">Add
                                                        To Cart</button>
                                                </form>
                                            </div>
                                            <div class="ec-single-cart ">
                                                <a href="{{ route('free_quote') }}" class="btn btn-primary">
                                                    Request Quote
                                                </a>
                                                <!-- Button trigger modal -->
                                                {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal">Request Quote</button> --}}

                                                <!-- Modal -->
                                                <x-quote_modal />
                                            </div>
                                        </div>

                                        <div class="ec-single-social">
                                            <ul class="mb-0">
                                                <li class="list-inline-item">
                                                    <a class="hdr-facebook"
                                                        href="{{ get_setting('facebook', 'https://facebook.com') }}"
                                                        target="_blank">
                                                        <i class="ecicon eci-facebook"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a class="hdr-youtube"
                                                        href="{{ get_setting('youtube', 'https://youtube.com') }}"
                                                        target="_blank">
                                                        <i class="ecicon eci-youtube"></i>
                                                    </a>
                                                </li>
                                            </ul>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Single product content End -->
                    <!-- Single product tab start -->
                    <div class="ec-single-pro-tab mt-4">
                        <p style="font-size:17px;font-weight:600">
                            Kindly provide info in
                            <a href="{{ route('all_products') }}"
                                style="color:blue; text-decoration: underline;">advanced search</a> to see
                            if this is the right fit for your case. Do not forget to
                            look into <span class="simulation-link"
                                style="color:blue;text-decoration:underline;font-weight:600">
                                Simulation Tab</span> for finding your closest match.
                        </p>
                        <div class="ec-single-pro-tab-wrapper">
                            <div class="ec-single-pro-tab-nav">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#ec-tab-info"
                                            role="tablist">Description</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#ec-tab-simulation"
                                            role="tablist">Simulation</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab"
                                            data-bs-target="#ec-tab-highlights" role="tablist">Key Information</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#ec-tab-installation"
                                            role="tablist">Installation Manual</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#ec-tab-reviews"
                                            role="tablist">Customer Reviews</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#ec-tab-articles"
                                            role="tablist">Articles &amp; Videos</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#ec-tab-faq"
                                            role="tablist">FAQ</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content ec-single-pro-tab-content">
                                <!-- Simulation Tab -->
                                <div id="ec-tab-highlights" class="tab-pane fade active show">
                                    <style>
                                        /* Target only the table with the unique ID */
                                        #fixed-header-table {
                                            max-height: 600px;
                                            /* Adjust height as needed */
                                            overflow-y: auto;
                                            border: 1px solid #ddd;
                                        }

                                        #fixed-header-table thead th {
                                            position: sticky;
                                            top: 0;
                                            background: #f8f9fa;
                                            /* Header background color */
                                            z-index: 2;
                                        }

                                        #fixed-header-table th,
                                        #fixed-header-table td {
                                            text-align: left;
                                            padding: 8px;
                                        }

                                        #fixed-header-table th {
                                            font-weight: bold;
                                            border-bottom: 2px solid #dee2e6;
                                        }

                                        #fixed-header-table tbody tr:nth-child(even) {
                                            background-color: #f2f2f2;
                                        }
                                    </style>
                                    <table border="1" style="width: 100%; border-collapse: collapse;">
                                        <thead>
                                            <tr style="background-color: #fbffc0;">
                                                <th style="padding: 10px; text-align: left; color:#3a0b55">Key
                                                    Highlights :</th>
                                                <th style="padding: 10px; text-align: left;">Value</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>
                                                <td style="padding: 10px;color:#252424; font-weight:600">Variable
                                                    Height Projector platform:</td>
                                                <td style="padding: 10px;">
                                                    {{ $product->variable_height_projector_platform ? $product->variable_height_projector_platform : 'N/A' }}
                                                </td>
                                            </tr>


                                            <tr>
                                                <td style="padding: 10px;color:#252424; font-weight:600">Can
                                                    Accommodate Extremely Large Center Channel:</td>
                                                <td style="padding: 10px;">
                                                </td>
                                            </tr>




                                            <tr>
                                                <td style="padding: 10px;color:#252424; font-weight:600">Center
                                                    Channel Chamber Length</td>
                                                <td style="padding: 10px;">
                                                    {{ $product->center_channel_chamber_length ? $product->center_channel_chamber_length : 'N/A' }}
                                                </td>
                                            </tr>


                                            <tr>
                                                <td style="padding: 10px;color:#252424; font-weight:600">Center
                                                    Channel Chamber Depth</td>
                                                <td style="padding: 10px;">
                                                    {{ $product->center_channel_chamber_depth ? $product->center_channel_chamber_depth : 'N/A' }}
                                                </td>
                                            </tr>


                                            <tr>
                                                <td style="padding: 10px;color:#252424; font-weight:600">Center
                                                    Channel Chamber Height</td>
                                                <td style="padding: 10px;">
                                                    {{ $product->center_channel_chamber_height ? $product->center_channel_chamber_height : 'N/A' }}
                                                </td>
                                            </tr>



                                            <tr>
                                                <td style="padding: 10px;color:#252424; font-weight:600">Variable
                                                    Height Center Channel Platform:</td>
                                                <td style="padding: 10px;">
                                                    {{ $product->variable_height_center_channel_platform ? $product->variable_height_center_channel_platform : 'N/A' }}
                                                </td>
                                            </tr>

                                            <tr>
                                                <td style="padding: 10px;color:#252424; font-weight:600">Variable
                                                    Depth Center Channel Platform:</td>
                                                <td style="padding: 10px;">
                                                    {{ $product->variable_depth_center_channel_platform ? $product->variable_depth_center_channel_platform : 'N/A' }}
                                                </td>
                                            </tr>


                                            <tr>
                                                <td style="padding: 10px;color:#252424; font-weight:600">Angling
                                                    mechanism for Center Channel:</td>
                                                <td style="padding: 10px;">
                                                    {{ $product->angling_mechanism_for_center_channel ? $product->angling_mechanism_for_center_channel : 'N/A' }}
                                                </td>
                                            </tr>


                                            <tr>
                                                <td style="padding: 10px;color:#252424; font-weight:600">Enclosed
                                                    UST Projector:
                                                </td>
                                                <td style="padding: 10px;">
                                                    {{ $product->enclosed_ust_projector ? $product->enclosed_ust_projector : 'N/A' }}
                                                </td>
                                            </tr>


                                            <tr>
                                                <td style="padding: 10px;color:#252424; font-weight:600">Enclosed
                                                    Center Channel:
                                                </td>
                                                <td style="padding: 10px;">
                                                    {{ $product->enclosed_center_channel ? $product->enclosed_center_channel : 'N/A' }}
                                                </td>
                                            </tr>


                                            <tr>
                                                <td style="padding: 10px;color:#252424; font-weight:600">Open Back
                                                    Design:
                                                </td>
                                                <td style="padding: 10px;">
                                                    {{ $product->open_back_design ? $product->open_back_design : 'N/A' }}
                                                </td>
                                            </tr>


                                            <tr>
                                                <td style="padding: 10px;color:#252424; font-weight:600">Silent Fan
                                                    For Flushing Heat From AVR:</td>
                                                <td style="padding: 10px;">
                                                    {{ $product->silent_fan_for_flushing_heat_from_avr ? $product->silent_fan_for_flushing_heat_from_avr : 'N/A' }}
                                                </td>
                                            </tr>



                                            <tr>
                                                <td style="padding: 10px;color:#252424; font-weight:600">Adjustable
                                                    Height Legs:</td>
                                                <td style="padding: 10px;">
                                                    {{ $product->adjustable_height_legs ? $product->adjustable_height_legs : 'N/A' }}
                                                </td>
                                            </tr>



                                            <tr>
                                                <td style="padding: 10px;color:#252424; font-weight:600">Remote
                                                    Friendly</td>
                                                <td style="padding: 10px;">
                                                    {{ $product->remote_friendly ? $product->remote_friendly : 'N/A' }}
                                                </td>
                                            </tr>



                                            <tr>
                                                <td style="padding: 10px;color:#252424; font-weight:600">Cabinet
                                                    Dimensions: Length Of The Cabinet</td>
                                                <td style="padding: 10px;">
                                                    {{ $product->length_of_cabinet ? $product->length_of_cabinet : 'N/A' }}
                                                </td>
                                            </tr>



                                            <tr>
                                                <td style="padding: 10px;color:#252424; font-weight:600">Cabinet
                                                    Dimensions: Height Of The Cabinet</td>
                                                <td style="padding: 10px;">
                                                    {{ $product->height_of_cabinet ? $product->height_of_cabinet : 'N/A' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 10px;color:#252424; font-weight:600">Cabinet
                                                    Dimensions: Depth Of The Cabinet</td>
                                                <td style="padding: 10px;">
                                                    {{ $product->depth_of_cabinet ? $product->depth_of_cabinet : 'N/A' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 10px;color:#252424; font-weight:600">Size</td>
                                                <td style="padding: 10px;">
                                                    {{ $product->size ? $product->size : 'N/A' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 10px;color:#252424; font-weight:600">Has Doors
                                                </td>
                                                <td style="padding: 10px;">
                                                    {{ $product->has_doors ? $product->has_doors : 'N/A' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 10px;color:#252424; font-weight:600">Color</td>
                                                <td style="padding: 10px;">
                                                    {{ $product->color ? $product->color : 'N/A' }}

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 10px;color:#252424; font-weight:600">DIY</td>
                                                <td style="padding: 10px;">
                                                    {{ $product->diy ? $product->diy : 'N/A' }}

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 10px;color:#252424; font-weight:600">Off Wall
                                                    Cabinet</td>
                                                <td style="padding: 10px;">
                                                    {{ $product->off_wall_cabinet ? $product->off_wall_cabinet : 'N/A' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 10px;color:#252424; font-weight:600">Is floor
                                                    raising screen embedded within cabinet</td>
                                                <td style="padding: 10px;">
                                                    {{ $product->is_floor_raising_screen_embedded_within_cabinet ? $product->is_floor_raising_screen_embedded_within_cabinet : 'N/A' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 10px;color:#252424; font-weight:600">Profile
                                                </td>
                                                <td style="padding: 10px;">
                                                    {{ $product->profile ? $product->profile : 'N/A' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 10px;color:#252424; font-weight:600">Material
                                                </td>
                                                <td style="padding: 10px;">
                                                    {{ $product->material ? $product->material : 'N/A' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 10px; color:#252424; font-weight:600">Projector
                                                    and Center Channel Placement Guidance</td>
                                                <td style="padding: 10px;">
                                                    Please refer to <span class="simulation-link"
                                                        style="color:blue;text-decoration:underline;font-weight:600">
                                                        Simulation Tab</span>.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 10px;color:#252424; font-weight:600">
                                                    Installation Required</td>
                                                <td style="padding: 10px;">
                                                    {{ $product->installation_required ? $product->installation_required : 'N/A' }}
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>



                                </div>
                                <div id="ec-tab-simulation" class="tab-pane fade">
                                    <style>
                                        #fixed-header-table th {
                                            min-width: 200px;
                                            /* Adjust based on requirement */
                                        }

                                        #fixed-header-table td {
                                            min-width: 200px;
                                            /* Adjust based on requirement */
                                        }

                                        /* Target only the table with the unique ID */
                                        #fixed-header-table {
                                            max-height: 500px;
                                            /* Adjust height as needed */
                                            overflow-y: auto;
                                            border: 1px solid #ddd;
                                        }

                                        #fixed-header-table thead th {
                                            position: sticky;
                                            top: 0;
                                            background: #f8f9fa;
                                            /* Header background color */
                                            z-index: 2;
                                        }

                                        #fixed-header-table th,
                                        #fixed-header-table td {
                                            text-align: left;
                                            padding: 8px;
                                        }

                                        #fixed-header-table th {
                                            font-weight: bold;
                                            border-bottom: 2px solid #dee2e6;
                                        }

                                        #fixed-header-table tbody tr:nth-child(even) {
                                            background-color: #f2f2f2;
                                        }
                                    </style>
                                    <h2 class="text-center mb-4">Simulation Results</h2>

                                    <div class="row justify-content-center text-center mb-3">
                                        <div class="col-auto">
                                            <label for="filter-projector-make" class="form-label"><strong>UST
                                                    Projector Brand:</strong></label>
                                            <select id="filter-projector-make" class="form-select">
                                                <option value="all">All</option>
                                                @foreach ($associatedProducts->pluck('projector_make')->unique() as $make)
                                                    <option value="{{ $make }}">{{ $make }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-auto">
                                            <label for="filter-projector-model" class="form-label"><strong>UST Projector
                                                    Model:</strong></label>
                                            <select id="filter-projector-model" class="form-select">
                                                <option value="">Select Model</option>
                                            </select>
                                        </div>

                                        <div class="col-auto">
                                            <label for="filter-centerchannel-brand" class="form-label"><strong>
                                                    Center Channel Brand:</strong></label>
                                            <select id="filter-centerchannel-brand" class="form-select">
                                                <option value="all">All</option>
                                                @foreach ($speakers->pluck('brand')->unique() as $brand)
                                                    <option value="{{ $brand }}">{{ $brand }}</option>
                                                @endforeach
                                                <option value="others">Others</option>
                                            </select>
                                        </div>

                                        <div class="col-auto" id="modelDropdownContainer">
                                            <label for="filter-centerchannel-model" class="form-label"><strong>Center
                                                    Channel Model:</strong></label>
                                            <select id="filter-centerchannel-model" class="form-select">
                                                <option value="">Select Model</option>
                                            </select>
                                        </div>
                                        <div class="col-auto">
                                            <label for="filter-ceiling-height" class="form-label"><strong>
                                                    Ceiling Height:</strong></label>
                                            <select id="filter-ceiling-height" class="form-select">
                                                <option value="all">All</option>
                                                <!-- Dynamic ceiling height options will be added here -->
                                            </select>
                                        </div>
                                        <div class="col-auto">
                                            <label for="filter-screen-size" class="form-label"><strong>Screen
                                                    Size:</strong></label>
                                            <select id="filter-screen-size" class="form-select">
                                                <option value="all">All</option>
                                            </select>
                                        </div>

                                    </div>
                                    <div id="additionalDropdowns" class="row justify-content-center text-center mt-2 mb-3"
                                        style="display: none;">
                                        <div class="col-auto">
                                            <label for="lengthSelect" class="form-label ">Center Channel Length</label>
                                            <select class="form-control form-select" id="lengthSelect" name="length">
                                                <option value="">Select Length</option>
                                                <option value=">45 inches">Greater than 45 inches</option>
                                                <option value="<45 inches">Less than 45 inches</option>
                                            </select>
                                        </div>

                                        <div class="col-auto">
                                            <label for="depthSelect" class="form-label">Center Channel Depth</label>
                                            <select class="form-control form-select" id="depthSelect" name="depth">
                                                <option value="">Select Depth</option>
                                                <script>
                                                    for (let i = 5; i <= 20; i++) {
                                                        document.write(`<option value="${i} inches">${i} inches</option>`);
                                                    }
                                                </script>
                                            </select>
                                        </div>

                                        <div class="col-auto">
                                            <label for="heightSelect" class="form-label ">Center Channel Height</label>
                                            <select class="form-control form-select" id="heightSelect" name="height">
                                                <option value="">Select Height</option>
                                                <option value="4 inches">4 inches or Between 4 and 5 inches</option>
                                                <option value="5 inches">5 inches or Between 5 and 6 inches</option>
                                                <option value="6 inches">6 inches or Between 6 and 7 inches</option>
                                                <option value="7 inches">7 inches or Between 7 and 8 inches</option>
                                                <option value="8 inches">8 inches or Between 8 and 9 inches</option>
                                                <option value="9 inches">9 inches or Between 9 and 10 inches</option>

                                            </select>
                                        </div>
                                    </div>
                                    <!-- Table -->
                                    <div id="fixed-header-table" class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Simulation ID</th>
                                                    <th>Simulation Images</th>
                                                    <th>Projector Make</th>
                                                    <th>Projector Model</th>
                                                    <th>Screen Size</th>
                                                    <th>Ceiling Height</th>
                                                    <th>Center Channel Height</th>
                                                    <th>Simulated Center Channel</th>
                                                    <th>Slot from Bottom (Center Channel)</th>
                                                    <th>Slot from Bottom (Projector)</th>

                                                    <th>Center Channel Tilt Slot</th>
                                                    <th>Center Channel Tilt Rod Length</th>
                                                    <th>Center Channel L Clamp Position</th>

                                                    <th>Distance of Cabinet from Screen</th>
                                                    <th>Slot from Bottom (Floor Raising)</th>
                                                    <th>Distance of Projector from Screen</th>
                                                    <th>Viewing Angle (Sitting)</th>
                                                    <th>Viewing Angle (Reclining)</th>
                                                    <th>Hearing Angle</th>
                                                    <th>Hearing Angle (Reclining)</th>
                                                    <th>Distance of Top Section of the Screen from Ceiling</th>
                                                    <th>Distance of Bottom Section of the Screen from Floor</th>
                                                    <th>Distance of Cabinet from Wall</th>

                                                    <th>Max Center Channel Height</th>
                                                    <th>Max Center Channel Length</th>
                                                    <th>Max Allowed Center Channel Depth</th>
                                                    <th>Center Channel Independent Flag</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($associatedProducts as $key => $productAssociate)
                                                    @php
                                                        $images = \App\Models\SimulationImage::where([
                                                            'parent_product_id' => $productAssociate->parent_product_id,
                                                            'projector_make' => $productAssociate->projector_make,
                                                            'screen_size' => $productAssociate->screen_size,
                                                            'ceiling_height' => $productAssociate->ceiling_height,
                                                            'center_channel_height' =>
                                                                $productAssociate->center_channel_height,
                                                        ])->get();
                                                    @endphp
                                                    <tr class="projector-row"
                                                        data-projector-make="{{ $productAssociate->projector_make }}"
                                                        data-screen-size="{{ $productAssociate->screen_size }}">
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $productAssociate->parent_product_id ?? 'NULL' }}</td>
                                                        <td>
                                                            @if ($images->count() > 0)
                                                            <a style="font-weight:600;color:blue;font-size:15px; cursor:pointer;"
                                                               class="view-images" data-id="{{ $productAssociate->id }}">
                                                                <img src="{{ asset('uploads/simulation_images/' . $images->first()->image_name) }}"
                                                                     style="width: 11rem; height: 6rem; border:1px solid #ddd;"
                                                                     alt="Thumbnail">
                                                             
                                                                @if ($images->count() > 1)
                                                                    + more
                                                                @endif
                                                            </a>
                                                        @else
                                                                No Images
                                                            @endif
                                                        </td>
                                                        <td>{{ $productAssociate->projector_make ?? 'NULL' }}</td>
                                                        <td>{{ $productAssociate->projector_model ?? 'NULL' }}</td>
                                                        <td>{{ $productAssociate->screen_size ?? 'NULL' }}</td>
                                                        <td>{{ $productAssociate->ceiling_height ?? 'NULL' }}</td>
                                                        <td>{{ $productAssociate->center_channel_height ?? 'NULL' }}</td>
                                                        <td>{{ $productAssociate->simulated_center_channel ?? 'NULL' }}
                                                        </td>
                                                        <td>{{ $productAssociate->center_channel_slot_from_bottom ?? 'NULL' }}
                                                        </td>
                                                        <td>{{ $productAssociate->projector_platform_slot_from_bottom ?? 'NULL' }}
                                                        </td>


                                                        <td>{{ $productAssociate->center_channel_tilt_slot ?? 'NULL' }}
                                                        </td>
                                                        <td>{{ $productAssociate->center_channel_tilt_rod_lenth ?? 'NULL' }}
                                                        </td>
                                                        <td>{{ $productAssociate->center_channel_l_clamp_position ?? 'NULL' }}
                                                        </td>


                                                        <td>{{ $productAssociate->distance_of_cabinet_from_screen ?? 'NULL' }}
                                                        </td>
                                                        <td>{{ $productAssociate->floor_raising_slot_from_bottom ?? 'NULL' }}
                                                        </td>
                                                        <td>{{ $productAssociate->distance_of_projector_from_screen ?? 'NULL' }}
                                                        </td>
                                                        <td>{{ $productAssociate->viewing_angle_sitting ?? 'NULL' }}</td>
                                                        <td>{{ $productAssociate->viewing_angle_reclining ?? 'NULL' }}</td>
                                                        <td>{{ $productAssociate->hearing_angle ?? 'NULL' }}</td>
                                                        <td>{{ $productAssociate->hearing_angle_reclining ?? 'NULL' }}</td>
                                                        <td>{{ $productAssociate->distance_of_top_section_of_screen_from_ceiling ?? 'NULL' }}
                                                        </td>
                                                        <td>{{ $productAssociate->distance_of_bottom_section_of_the_screen_from_floor ?? 'NULL' }}
                                                        </td>
                                                        <td>{{ $productAssociate->distance_of_floor_raising_screen_from_wall ?? 'NULL' }}
                                                        </td>
                                                        <td>{{ $productAssociate->max_center_channel_height ?? 'NULL' }}
                                                        </td>
                                                        <td>{{ $productAssociate->max_center_channel_length ?? 'NULL' }}
                                                        </td>
                                                        <td>{{ $productAssociate->max_allowed_center_channel_depth ?? 'NULL' }}
                                                        </td>
                                                        <td>{{ $productAssociate->center_channel_flag ?? 'NULL' }}</td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="60" class="text-center">No associated products
                                                            found.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                                <!-- Installation Manual Tab -->
                                <div id="ec-tab-installation" class="tab-pane fade">
                                    <div class="ec-single-pro-tab-desc">
                                        @if ($product_manual)
                                            <embed src="{{ asset($product_manual->pdf) }}" type="application/pdf"
                                                width="100%" height="600px" />
                                            <p>If the PDF does not load, <a href="{{ asset($product_manual->pdf) }}"
                                                    target="_blank">click here to download it</a>.</p>
                                        @else
                                            <!-- Embed the PDF here -->
                                            <p>No manual added yet.</p>
                                        @endif
                                    </div>
                                </div>
                                <!-- Customer Reviews Tab -->
                                <div id="ec-tab-reviews" class="tab-pane fade">
                                    <div class="row">
                                        <div class="ec-t-review-wrapper">
                                            <p>This is the Customer Reviews tab.
                                                Add customer reviews and ratings here.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Articles & Videos Tab -->
                                <div id="ec-tab-articles" class="tab-pane fade">
                                    <div class="ec-single-pro-tab-desc">
                                        <p>This is the Articles &amp; Videos tab. Add helpful articles and embedded videos
                                            here.</p>
                                    </div>
                                </div>
                                <!-- Additional Info Tab -->
                                <div id="ec-tab-info" class="tab-pane fade">
                                    <div class="ec-single-pro-tab-desc">
                                        @if ($product_description_manual)
                                            <embed src="{{ asset($product_description_manual->pdf) }}"
                                                type="application/pdf" width="100%" height="600px" />
                                            <p>If the PDF does not load, <a
                                                    href="{{ asset($product_description_manual->pdf) }}"
                                                    target="_blank">click here to download it</a>.</p>
                                        @else
                                            <!-- Embed the PDF here -->
                                            <p>No manual added yet.</p>
                                        @endif
                                    </div>
                                </div>
                                <!-- FAQ Tab -->
                                <style>
                                    .faq-section {
                                        max-width: 800px;
                                        margin: 0 auto;
                                        font-family: Arial, sans-serif;
                                        padding: 20px;
                                        border: 1px solid #ddd;
                                        border-radius: 10px;
                                        background-color: #f9f9f9;
                                    }

                                    .faq-title {
                                        text-align: center;
                                        font-size: 24px;
                                        margin-bottom: 20px;
                                        color: #333;
                                    }

                                    .faq-item {
                                        margin-bottom: 10px;
                                    }

                                    .faq-question {
                                        width: 100%;
                                        text-align: left;
                                        background-color: #3474D4;
                                        color: #fff;
                                        padding: 10px 15px;
                                        border: none;
                                        border-radius: 5px;
                                        font-size: 16px;
                                        cursor: pointer;
                                    }

                                    .faq-question:focus {
                                        outline: none;
                                    }

                                    .faq-answer {
                                        display: none;
                                        background-color: #fff;
                                        padding: 10px 15px;
                                        border: 1px solid #ddd;
                                        border-radius: 5px;
                                        margin-top: 5px;
                                        font-size: 15px;
                                        font-weight: 600;
                                        color: #252424;
                                    }

                                    .faq-answer p {
                                        margin: 0;
                                    }

                                    .faq-question.active+.faq-answer {
                                        display: block;
                                    }
                                </style>
                                <div id="ec-tab-faq" class="tab-pane fade">
                                    <div class="ec-single-pro-tab-desc">
                                        <div class="faq-section">
                                            <h2 class="faq-title">Frequently Asked Questions</h2>
                                            @foreach ($faqs as $item)
                                                <div class="faq-item">
                                                    <button class="faq-question">{{ $item->question }}</button>
                                                    <div class="faq-answer">
                                                        <p>{!! $item->answer !!}</p> <!-- Display formatted answer -->
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- product details description area end -->
                </div>
            </div>
        </div>
    </section>

    <!-- End Single product -->

    <!-- Related Product Start -->
    <section class="section ec-releted-product section-space-p">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="section-title">
                        <h2 class="ec-bg-title">Related products</h2>
                        <h2 class="ec-title">Related products</h2>
                        <p class="sub-title">Browse The Collection of Related {{ $product->parent_product_id }} Products
                        </p>
                    </div>
                </div>
            </div>
            <div class="row margin-minus-b-30">
                <!-- Related Product Content -->
                <div class="owl-carousel owl-theme">
                    @foreach ($related_products as $product)
                        @php
                            $slug = Str::slug($product->product_frontend_name ?? $product->product_name); // Generate slug dynamically
                        @endphp
                        <div class="item">

                            <div class="ec-product-inner">
                                <div class="ec-pro-image-outer">
                                    <div class="ec-pro-image" onclick="redirectToProduct('{{ route('product_details', ['slug' => $slug, 'id' => $product->product_id]) }}')">
                                        <a href="{{ route('all_products') }}" class="image">
                                            <img class="main-image"
                                                @php
$productImage = $product->productImages()->first(); @endphp
                                                @if ($productImage) <img class="main-image"
                                                src="{{ asset('user/uploads/products/images/' . $productImage->image) }}"
                                                alt="{{ $product->product_name }}" height="220px">
                                            <img class="hover-image"
                                                src="{{ asset('user/uploads/products/images/' . $productImage->image) }}"
                                                height="220px" alt="{{ $product->product_name }}">
                                        @else
                                            <img class="main-image"
                                                src="{{ asset('frontend/assets/images/our_brands/product_demo_2_xl.png') }}"
                                                alt="Default Product">
                                            <img class="hover-image"
                                                src="{{ asset('frontend/assets/images/our_brands/product_demo_2.png') }}"
                                                alt="Default Product"> @endif
                                                </a>
                                            {{-- <a href="#" class="quickview" data-link-action="quickview"
                                           title="Quick view" data-bs-toggle="modal"
                                           data-bs-target="#ec_quickview_modal"><img
                                                src="{{url('/')}}/frontend/assets/images/icons/quickview.svg" class="svg_img pro_svg"
                                                alt="" /></a> --}}
                                    </div>
                                </div>
                                <div class="ec-pro-content">
                                    <h5 style="font-size:18px"><a
                                            href="{{ route('product_details', ['slug' => $slug, 'id' => $product->product_id]) }}">{{ $product->product_frontend_name ? $product->product_frontend_name : $product->product_id }}</a>
                                    </h5>
                                    <h5 class="ec-pro-title"><a
                                            href="{{ route('product_details', ['slug' => $slug, 'id' => $product->product_id]) }}">{{ $product->product_name }}</a>
                                    </h5>
                                    <div class="ec-pro-rating">
                                        <i class="ecicon eci-star fill"></i>
                                        <i class="ecicon eci-star fill"></i>
                                        <i class="ecicon eci-star fill"></i>
                                        <i class="ecicon eci-star fill"></i>
                                        <i class="ecicon eci-star"></i>
                                    </div>
                                    <span class="ec-price">
                                        {{-- <span class="old-price">$40.00</span> --}}
                                        <span class="new-price">${{ $product->selling_price ?? '0.00' }}</span>
                                    </span>
                                    {{-- <div class="ec-pro-option">
                                        <div class="ec-pro-size">
                                            <span class="ec-pro-opt-label">Size</span>
                                            <ul class="ec-opt-size">
                                                <li class="active"><a href="#" class="ec-opt-sz"
                                                                      data-old="$40.00" data-new="$30.00"
                                                                      data-tooltip="Small">A</a></li>
                                                <li><a href="#" class="ec-opt-sz" data-old="$5010.00"
                                                       data-new="$4320.00" data-tooltip="Medium">B</a></li>
                                            </ul>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>


            </div>
        </div>
    </section>
    <style>
        .custom-modal-size {
            max-width: 95vw !important;
            width: 95vw !important;
            margin: 0 auto;
        }
    </style>
    <div class="modal fade" id="imageModalSimulation" tabindex="-1" aria-labelledby="imageModalSimulationLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl custom-modal-size"> <!-- XL size -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalSimulationLabel">Simulation Images</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="imageContainer" class="d-flex flex-wrap justify-content-center gap-3">
                        <!-- Images will be appended here dynamically -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Related Product end -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl custom-modal-size" role="document"> <!-- Use modal-xl for extra large modal -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <!-- Modal content (image or video) will be replaced dynamically -->
                    <div id="modalContent">
                        <!-- Image or video will be inserted here -->
                        <img id="modalImage" class="img-fluid" src="" alt="Product Image">
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <!-- Previous button with arrow icon -->
                    <button type="button" class="btn btn-secondary" id="prevBtn">
                        <i class="bi bi-arrow-left"></i> <!-- Bootstrap Arrow Icon -->
                    </button>
                    <!-- Next button with arrow icon -->
                    <button type="button" class="btn btn-secondary" id="nextBtn">
                        <i class="bi bi-arrow-right"></i> <!-- Bootstrap Arrow Icon -->
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
<script>
 document.addEventListener("DOMContentLoaded", function () {
    let images = document.querySelectorAll(".single-product-cover img, .single-product-cover video");
    let loadedImages = 0;

    images.forEach((media) => {
        if (media.complete || media.readyState === 4) {
            loadedImages++;
        } else {
            media.addEventListener("load", () => {
                loadedImages++;
                checkAllLoaded();
            });
            media.addEventListener("error", () => {
                loadedImages++; // Ignore errors, prevent blocking
                checkAllLoaded();
            });
        }
    });

    function checkAllLoaded() {
        if (loadedImages === images.length) {
            document.body.classList.add("slider-loaded");
        }
    }

    checkAllLoaded(); // Run initially in case all images are cached
});

</script>
    <script>
        document.getElementById("filter-centerchannel-brand").addEventListener("change", function() {
            let selectedValue = this.value;
            let modelDropdown = document.getElementById("modelDropdownContainer");
            let additionalDropdowns = document.getElementById("additionalDropdowns");

            if (selectedValue === "others") {
                modelDropdown.style.display = "none"; // Hide model dropdown
                additionalDropdowns.style.display = "flex"; // Show additional dropdowns
            } else {
                modelDropdown.style.display = "block"; // Show model dropdown
                additionalDropdowns.style.display = "none"; // Hide additional dropdowns
            }
        });
    </script>
    <script>
        // JavaScript to toggle FAQ answers
        const faqQuestions = document.querySelectorAll(".faq-question");
        faqQuestions.forEach((question) => {
            question.addEventListener("click", () => {
                question.classList.toggle("active");
                const answer = question.nextElementSibling;
                answer.style.display = answer.style.display === "block" ? "none" : "block";
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $(".owl-carousel").owlCarousel({
                items: 3, // Number of items to show at a time
                loop: true, // Enable infinite loop
                margin: 30, // Space between items
                nav: false, // Enable navigation buttons (prev/next)
                dots: true, // Disable dots navigation
                autoplay: true, // Enable autoplay
                autoplayTimeout: 3000, // Time between slides (in ms)
                responsive: {
                    0: {
                        items: 1 // 1 item on small screens
                    },
                    600: {
                        items: 2 // 2 items on medium screens
                    },
                    1000: {
                        items: 3 // 3 items on large screens
                    }
                }
            });
        });
    </script>
    <script>
        document.querySelectorAll(".simulation-link").forEach(function(element) {
            element.addEventListener("click", function(event) {
                event.preventDefault(); // Prevent default behavior

                // Activate the Simulation tab
                const simulationTab = document.querySelector('[data-bs-target="#ec-tab-simulation"]');
                if (simulationTab) {
                    simulationTab.click(); // Open the tab

                    // Wait for the tab to become visible, then scroll to it
                    setTimeout(() => {
                        const simulationTabContent = document.querySelector("#ec-tab-simulation");
                        if (simulationTabContent) {
                            simulationTabContent.scrollIntoView({
                                behavior: "smooth",
                                block: "start"
                            });
                        }
                    }, 300); // Delay ensures the tab is visible before scrolling
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            let currentIndex = 0;
            const images = @json(
                $productImages->pluck('image')->map(function ($image) {
                    return asset('user/uploads/products/images/' . $image);
                }));

            // Open modal when an image is clicked
            $('.open-modal').click(function() {
                const src = $(this).data(
                    'src'); // Get the image or video source from the data-src attribute
                console.log('Source:', src); // Log the source to make sure it's set correctly

                if (!src) {
                    console.error('Data-src attribute is missing or undefined!');
                    return; // Exit if src is undefined or missing
                }

                const extension = src.split('.').pop()
                    .toLowerCase(); // Get the file extension to check if it's a video or image

                // Set the current index based on the clicked media (image or video)
                currentIndex = images.indexOf(src);

                // Check if the source is a video (based on extension)
                if (['mp4', 'mkv', 'avi'].includes(extension)) {
                    // If it's a video, replace the image with a video player
                    $('#modalImage').replaceWith(
                        '<video id="modalImage" class="img-fluid" controls><source src="' + src +
                        '" type="video/' + extension +
                        '">Your browser does not support the video tag.</video>');
                } else {
                    // If it's an image, set the src for the image
                    $('#modalImage').replaceWith('<img id="modalImage" class="img-fluid" src="' + src +
                        '" alt="Product Image">');
                }

                // Open the modal
                $('#imageModal').modal('show');
            });

            // Previous button functionality
            $('#prevBtn').click(function() {
                currentIndex = (currentIndex === 0) ? images.length - 1 : currentIndex -
                    1; // Loop back to the last image/video if at the beginning
                const src = images[currentIndex];
                updateModalContent(src);
            });

            // Next button functionality
            $('#nextBtn').click(function() {
                currentIndex = (currentIndex === images.length - 1) ? 0 : currentIndex +
                    1; // Loop back to the first image/video if at the end
                const src = images[currentIndex];
                updateModalContent(src);
            });

            // Update modal content based on the new index
            function updateModalContent(src) {
                const extension = src.split('.').pop().toLowerCase();
                if (['mp4', 'mkv', 'avi'].includes(extension)) {
                    $('#modalImage').replaceWith('<video id="modalImage" class="img-fluid" controls><source src="' +
                        src + '" type="video/' + extension +
                        '">Your browser does not support the video tag.</video>');
                } else {
                    $('#modalImage').replaceWith('<img id="modalImage" class="img-fluid" src="' + src +
                        '" alt="Product Image">');
                }
            }



        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ceilingHeightFilter = document.getElementById('filter-ceiling-height');
            const screenSizeFilter = document.getElementById('filter-screen-size');
            const rows = document.querySelectorAll('.projector-row');
            const brandFilter = document.getElementById("filter-centerchannel-brand");
            const modelFilter = document.getElementById("filter-centerchannel-model");
            const lengthFilter = document.getElementById("lengthSelect");
            const depthSelect = document.getElementById("depthSelect");
            const heightSelect = document.getElementById("heightSelect");
            const ceilingHeights = new Set();
            const screenSizes = new Set();

            rows.forEach(row => {
                const ceilingHeight = row.querySelector('td:nth-child(7)').textContent.trim();

                const screenSize = row.querySelector('td:nth-child(6)').textContent.trim();

                if (ceilingHeight && ceilingHeight !== 'N/A') {
                    ceilingHeights.add(ceilingHeight);
                }
                if (screenSize && screenSize !== 'N/A') {
                    screenSizes.add(screenSize);
                }
            });

            ceilingHeights.forEach(height => {
                const option = document.createElement('option');
                option.value = height.toLowerCase();
                option.textContent = height;
                ceilingHeightFilter.appendChild(option);
            });

            screenSizes.forEach(size => {
                const option = document.createElement('option');
                option.value = size.toLowerCase();
                option.textContent = size;
                screenSizeFilter.appendChild(option);
            });

            document.getElementById('filter-projector-make').addEventListener('change', filterTable);
            ceilingHeightFilter.addEventListener('change', filterTable);
            screenSizeFilter.addEventListener('change', filterTable);
            brandFilter.addEventListener("change", filterTable);
            modelFilter.addEventListener("change", filterTable);
            lengthFilter.addEventListener("change", filterTable);
            depthSelect.addEventListener("change", filterTable);
            heightSelect.addEventListener("change", filterTable);
            async function getSpeakerDimensions(brand, model) {
                if (!brand || brand === "all" || !model || model === "all") return null;

                const response = await fetch("{{ route('get.speaker.dimensions') }}?brand=" + brand +
                    "&model=" + model);
                const data = await response.json();

                return data;
            }
            async function filterTable() {
                const selectedLength = lengthFilter.value;
                const selectedDepth = depthSelect.value ? parseFloat(depthSelect.value) :
                    null; // Get numeric value
                const selectedHeight = heightSelect.value ? parseFloat(heightSelect.value) :
                    null; // Numeric height value


                const selectedMake = document.getElementById('filter-projector-make').value.toLowerCase();
                const selectedCeilingHeight = ceilingHeightFilter.value.toLowerCase();
                const selectedScreenSize = screenSizeFilter.value.toLowerCase();
                const selectedBrand = brandFilter.value.toLowerCase();
                const selectedModel = modelFilter.value.toLowerCase();

                let speakerDimensions = null;

                if (selectedBrand !== "all" && selectedModel !== "all") {
                    speakerDimensions = await getSpeakerDimensions(selectedBrand, selectedModel);
                }
                rows.forEach(row => {
                    const projectorMake = row.getAttribute('data-projector-make').toLowerCase();
                    const ceilingHeight = row.querySelector('td:nth-child(7)').textContent
                        .toLowerCase();
                    const screenSize = row.getAttribute('data-screen-size').toLowerCase();

                    let maxHeight = row.querySelector("td:nth-child(25)").textContent.trim();
                    let maxLength = row.querySelector("td:nth-child(26)").textContent.trim();
                    let maxDepth = row.querySelector("td:nth-child(27)").textContent.trim();
                    let centerChannelHeight = row.querySelector("td:nth-child(8)").textContent.trim();
                    maxHeight = maxHeight && !isNaN(maxHeight) ? parseFloat(maxHeight) : null;
                    maxLength = maxLength && !isNaN(maxLength) ? parseFloat(maxLength) : null;
                    maxDepth = maxDepth && !isNaN(maxDepth) ? parseFloat(maxDepth) : null;

                    console.log("Row Data:", {
                        maxHeight,
                        maxLength,
                        maxDepth
                    });

                    let passesBrandModelFilter = true;
                    let passesHeightFilter = true;
                    let passesLengthFilter = true;
                    let passesDepthFilter = true;

                    // **Declare centerChannelValues before using it**
                    let centerChannelValues = [];

                    if (centerChannelHeight) {
                        centerChannelValues = centerChannelHeight
                            .split(',')
                            .map(value => parseFloat(value.trim()))
                            .filter(value => !isNaN(value)); // Remove invalid numbers
                    }

                    console.log("Extracted Center Channel Heights:", centerChannelValues);

                    if (speakerDimensions) {
                        const {
                            height
                        } = speakerDimensions;
                        console.log("Speaker Height:", height);

                        // Find the nearest lower or equal center channel height
                        let nearestCenterHeight = Math.max(...centerChannelValues.filter(value =>
                            value <= height), -Infinity);

                        console.log("Nearest Center Channel Height:", nearestCenterHeight);

                        // Show row ONLY if the center channel height matches exactly
                        if (nearestCenterHeight !== -Infinity && nearestCenterHeight === Math.floor(
                                height)) {
                            passesBrandModelFilter = true;
                        }else{
                            passesBrandModelFilter = false;
                        }
                    }

                    // Apply additional filters
                    if (selectedHeight !== null) {
                        let nextHigherValue = Math.min(...centerChannelValues.filter(value => value >
                            selectedHeight));

                        // Updated logic: valid if it matches selectedHeight OR next higher value
                        let validHeight = (centerChannelValues.includes(selectedHeight) ||
                                nextHigherValue === selectedHeight + 1) &&
                            (maxHeight === null || selectedHeight <= maxHeight);

                        if (!validHeight) {
                            passesHeightFilter = false;
                        }
                    }

                    if (selectedLength === ">45 inches" && maxLength !== null && maxLength <= 45) {
                        passesLengthFilter = false;
                    } else if (selectedLength === "<45 inches" && maxLength !== null && maxLength >=
                        45) {
                        passesLengthFilter = false;
                    }
                    if (maxLength === null) {
                        passesLengthFilter = true;
                    }
                    if (selectedDepth !== null && maxDepth !== null && selectedDepth > maxDepth) {
                        passesDepthFilter = false;
                    }


                    if (
                        (selectedMake === 'all' || projectorMake === selectedMake) &&
                        (selectedCeilingHeight === 'all' || ceilingHeight.includes(
                            selectedCeilingHeight)) &&
                        (selectedScreenSize === 'all' || screenSize.includes(selectedScreenSize)) && passesHeightFilter &&
                        passesDepthFilter&&
                        passesLengthFilter&&
                        passesBrandModelFilter

                    ) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }
        });
    </script>
    <script>
        document.getElementById('add-to-cart-btn').addEventListener('click', function(e) {
            e.preventDefault();

            // Get the form data
            const formData = new FormData(document.getElementById('add-to-cart-form'));
            console.log(formData)
            // Send AJAX request
            fetch("{{ route('cart.add') }}", {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            title: 'Success!',
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Redirect to the cart view route
                                window.location.href = '{{ route('cart.view') }}';
                            }
                        });
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Failed to add product to cart.',
                            icon: 'error',
                            confirmButtonText: 'Try Again'
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Something went wrong.',
                        icon: 'error',
                        confirmButtonText: 'Try Again'
                    });
                });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#filter-projector-make').on('change', function() {

                var make = $(this).val();

                $('#filter-projector-model').html(
                    '<option value="">Select Model</option>'); // Reset model dropdown

                if (make !== '') {
                    $.ajax({
                        url: '{{ route('getProjectorModels') }}', // Define route
                        type: 'GET',
                        data: {
                            make: make
                        },
                        success: function(data) {
                            console.log(data);
                            $.each(data, function(key, value) {
                                $('#filter-projector-model').append('<option value="' +
                                    value + '">' + value + '</option>');
                            });
                        }
                    });
                }
            });

            $('#filter-centerchannel-brand').on('change', function() {
                var brand = $(this).val();
                $('#filter-centerchannel-model').html(
                    '<option value="">Select Model</option>'); // Reset model dropdown

                if (brand !== '') {
                    $.ajax({
                        url: '{{ route('getCenterChannelModels') }}',
                        type: 'GET',
                        data: {
                            brand: brand
                        },
                        success: function(data) {
                            $.each(data, function(key, value) {
                                $('#filter-centerchannel-model').append(
                                    '<option value="' + value + '">' + value +
                                    '</option>');
                            });
                        }
                    });
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $(".view-images").on("click", function() {
                let productId = $(this).data("id");

                $.ajax({
                    url: "{{ route('simulation_images.view') }}", // New route for AJAX
                    type: "GET",
                    data: {
                        id: productId
                    },
                    success: function(response) {
                        let imagesHtml = "";
                        if (response.images.length > 0) {
                            response.images.forEach(image => {
                                imagesHtml +=
                                    `<img src="{{ asset('uploads/simulation_images/') }}/${image.image_name}"
                                           class="img-fluid" style="max-width: 100%; height: auto; border:1px solid #ddd;">`;
                            });
                        } else {
                            imagesHtml = "<p>No Images Available</p>";
                        }
                        $("#imageContainer").html(imagesHtml);
                        $("#imageModalSimulation").modal("show"); // Open the modal
                    }
                });
            });
        });
    </script>
     <script>
        function redirectToProduct(url) {

            window.location.href = url;
        }
    </script>
@endpush
