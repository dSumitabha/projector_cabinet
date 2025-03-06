<style>
    .form-label {
        color: #6466e8;
    }
</style>
<style>
    #product-data {
        position: relative;
    }
</style>
<style>
    /* Style the select box */
    select {
        appearance: none;
        /* Remove default arrow */
        -webkit-appearance: none;
        -moz-appearance: none;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding-right: 30px;
        /* Space for the dropdown arrow */
        cursor: pointer;
        position: relative;
        background-image: url("data:image/svg+xml;charset=UTF-8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='18' height='18' fill='%23777777'%3E%3Cpath d='M7 10l5 5 5-5H7z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 10px center;
        background-size: 18px;
    }

    /* Hover and Focus Effect */
    select:hover,
    select:focus {
        border-color: #007bff;
        outline: none;
    }

    /* Ensure it works for all screen sizes */
    @media (max-width: 768px) {
        select {
            font-size: 14px;
            background-size: 14px;
        }
    }
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">
@extends('frontend.layouts.master')

@section('content')

    <!-- Ec breadcrumb end -->

    <!-- Page detail section -->

    <!-- End detail section -->

    <!-- Ec Shop page -->
    <section class="ec-page-content-bnr section-space-pb ">
        <div class="container">

            <div class="row">
                <div class="ec-shop-rightside col-lg-9 order-lg-last col-md-12 order-md-first margin-b-30">

                    <!-- Shop Top Start -->

                    <!-- Shop Top End -->

                    <!-- Shop content Start -->
                    <div class="shop-pro-content ">
                        <div class="shop-pro-inner">
                            <div class="head-text mb-4">

                                <x-advanced_search />
                                <x-shop_nav_bar />
                            </div>

                            @include('frontend.products.product_data')


                        </div>

                    </div>
                    <!--Shop content End -->
                </div>
                <!-- Sidebar Area Start -->
                <div class="ec-shop-leftside col-lg-3 order-lg-first col-md-12 order-md-last ">
                    <style>
                        #shop_sidebar {
                            height: auto !important;
                            /* Forces auto height */
                            min-height: unset !important;
                            /* Optional: In case min-height is also set */
                            max-height: unset !important;
                            /* Optional: If max-height is applied */
                            overflow: visible !important;
                            /* Ensures content is visible */
                        }

                        .inner-wrapper-sticky {
                            position: static !important;
                            transform: none !important;
                        }
                    </style>
                    <div id="shop_sidebar">
                        <div class="ec-sidebar-heading">
                            <h1>Filter Products By</h1>
                        </div>
                        <div class="ec-sidebar-wrap">
                            <!-- Sidebar Projector Brand Block -->
                            <x-sidebar_filter_block :title="'UST Projector Brand'" :specifications="$projectorBrands" />
                            <!-- Sidebar Ceiling Height Block -->
                            <x-sidebar_filter_block :title="'Ceiling Height'" :specifications="$ceilingHeights" />
                            <!-- Sidebar Screen Size Block -->
                            <x-sidebar_filter_block :title="'Screen Size'" :specifications="$screenSizes" />
                            <!-- Sidebar Screen Type Block -->
                            <x-sidebar_filter_block :title="'Screen Type'" :specifications="$screenTypes" />




                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            function toggleRequired(inputField, isVisible) {
                if (isVisible) {
                    inputField.attr('required', 'required');
                } else {
                    inputField.removeAttr('required');
                }
            }

            $('#brandSelect').change(function() {
                if ($(this).val() === 'others') {
                    $('#otherBrandInput').removeClass('d-none').attr('name', 'projector_make').focus();
                    toggleRequired($('#otherBrandInput'), true);
                } else {
                    $('#otherBrandInput').addClass('d-none').removeAttr('name').val('');
                    toggleRequired($('#otherBrandInput'), false);
                }
            });

            $('#projectorModelSelect').change(function() {
                if ($(this).val() === 'others') {
                    $('#otherModelInput').removeClass('d-none').attr('name', 'projector_model').focus();
                    toggleRequired($('#otherModelInput'), true);
                } else {
                    $('#otherModelInput').addClass('d-none').removeAttr('name').val('');
                    toggleRequired($('#otherModelInput'), false);
                }
            });

            $('#heightSelect').change(function() {
                if ($(this).val() === 'others') {
                    $('#customHeightInput').removeClass('d-none').attr('name', 'height').focus();
                    toggleRequired($('#customHeightInput'), true);
                } else {
                    $('#customHeightInput').addClass('d-none').removeAttr('name').val('');
                    toggleRequired($('#customHeightInput'), false);
                }
            });

            // Fetch data from the server
            $.getJSON('{{ route('projector.data') }}', function(data) {
                const uniqueMakes = [...new Set(data.map(item => item.make))];

                uniqueMakes.forEach(make => {
                    $('#brandSelect').append(new Option(make, make));
                });

                $('#brandSelect').append(new Option('Others', 'others'));
                $('#projectorModelSelect').append(new Option('Others', 'others'));

                $('#brandSelect').change(function() {
                    const selectedMake = $(this).val();
                    $('#projectorModelSelect').empty().append(new Option('Select Model', ''));

                    if (selectedMake === 'others') {
                        $('#otherBrandInput').removeClass('d-none').focus();
                        toggleRequired($('#otherBrandInput'), true);
                        $('#projectorModelSelect').append(new Option('Others', 'others'));
                    } else {
                        $('#otherBrandInput').addClass('d-none').val('');
                        toggleRequired($('#otherBrandInput'), false);

                        if (selectedMake) {
                            const filteredModels = data.filter(item => item.make === selectedMake);
                            filteredModels.forEach(item => {
                                $('#projectorModelSelect').append(new Option(item.model,
                                    item.model));
                            });

                            $('#projectorModelSelect').append(new Option('Others', 'others'));
                            $('#modelMessage').hide();
                        } else {
                            $('#modelMessage').show();
                        }
                    }
                });

                $('#projectorModelSelect').change(function() {
                    if ($(this).val() === 'others') {
                        $('#otherModelInput').removeClass('d-none').focus();
                        toggleRequired($('#otherModelInput'), true);
                    } else {
                        $('#otherModelInput').addClass('d-none').val('');
                        toggleRequired($('#otherModelInput'), false);
                    }
                });

                $('#projectorModelSelect').click(function() {
                    if (!$('#brandSelect').val()) {
                        $('#modelMessage').show();
                    } else {
                        $('#modelMessage').hide();
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Fetch data from the server
            $.getJSON('{{ route('speaker.data') }}', function(data) {
                const uniqueBrands = [...new Set(data.map(item => item.brand))];

                // Populate Brand dropdown
                uniqueBrands.forEach(brand => {
                    $('#channelBrandSelect').append(new Option(brand, brand));
                });

                // ✅ Add "Others" option to Brand dropdown
                $('#channelBrandSelect').append(new Option('Others', 'others'));

                // Brand dropdown change event
                $('#channelBrandSelect').change(function() {
                    var selectedBrand = $(this).val();
                    $('#channelModelSelect').empty().append(new Option('Select Model', ''));

                    if (selectedBrand === 'others') {
                        // ✅ Hide Model dropdown and show custom fields
                        $('#modelContainer').addClass('d-none');
                        $('#customFields').removeClass('d-none');
                    } else {
                        // ✅ Show Model dropdown and hide custom fields
                        $('#modelContainer').removeClass('d-none');
                        $('#customFields').addClass('d-none');

                        // Populate models for the selected brand
                        data.forEach(item => {
                            if (item.brand === selectedBrand) {
                                $('#channelModelSelect').append($('<option>', {
                                    value: item.model,
                                    text: item.model
                                }));
                            }
                        });
                    }
                });

                // Height dropdown change event
                $('#heightSelect').change(function() {
                    if ($(this).val() === 'others') {
                        $('#customHeightInput').removeClass('d-none').focus();
                    } else {
                        $('#customHeightInput').addClass('d-none').val('');
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $(document).on("click", ".ec-pro-pagination-inner .page-link", function(e) {
                e.preventDefault();
                var url = $(this).attr("href");
                if (url) {
                    fetchProducts(url);
                }
            });

            function fetchProducts(url) {
                $.ajax({
                    url: url,
                    type: "GET",
                    dataType: "html",
                    beforeSend: function() {
                        $("#loader").show();
                    },
                    success: function(response) {
                        $("#product-data").html(response); // Update only product data
                        $("#loader").hide();
                        window.history.pushState(null, "", url);

                        // Scroll to the top of #product-data
                        $("html, body").animate({
                            scrollTop: $("#product-data").offset().top
                        }, 500);
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                        alert("Something went wrong!");
                        $("#loader").hide();
                    },
                });
            }
        });
    </script>


    <script>
        $(document).ready(function() {


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#advancedSearch').on('submit', function(e) {
                e.preventDefault(); // Prevent the form from submitting the traditional way
                let selectedBrand = $('#brandSelect').val();
                let selectedCeilingHeight = $('#ceilingHeightSelect').val();
                let selectedscreenSize = $('#screenSizeSelect').val();
                let screenType = $('input[name="radio-group"]:checked').val();

                // Check and mark UST Projector Brand checkboxes
                if (screenType) {
                    $('.ec-sidebar-block:contains("Screen Type") .filter-checkbox').each(
                function() {

                        if ($(this).data('value') === screenType) {
                            $(this).prop('checked', true);
                        } else {
                            $(this).prop('checked', false);
                        }
                    });
                }
                if (selectedBrand) {
                    $('.ec-sidebar-block:contains("UST Projector Brand") .filter-checkbox').each(
                function() {
                        if ($(this).data('name') === selectedBrand) {
                            $(this).prop('checked', true);
                        } else {
                            $(this).prop('checked', false);
                        }
                    });
                }

                // Check and mark Ceiling Height checkboxes
                if (selectedscreenSize) {
                    $('.ec-sidebar-block:contains("Screen Size") .filter-checkbox').each(function() {

                        if ($(this).data('value') == selectedscreenSize) {
                            console.log($(this).data('value'));
                            $(this).prop('checked', true);
                        } else {
                            $(this).prop('checked', false);
                        }
                    });
                }
                if (selectedCeilingHeight) {
                    $('.ec-sidebar-block:contains("Ceiling Height") .filter-checkbox').each(function() {

                        if ($(this).data('value') == selectedCeilingHeight) {
                            console.log($(this).data('value'));
                            $(this).prop('checked', true);
                        } else {
                            $(this).prop('checked', false);
                        }
                    });
                }

                // Show loading SweetAlert
                Swal.fire({
                    title: 'Loading...',
                    text: 'Please wait while we fetch the products.',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                // Serialize the form data to send with the AJAX request
                var formData = $(this).serialize();
                $.ajax({
                    url: "{{ route('product.search') }}",
                    method: "GET",
                    data: formData, // Serialize the form data
                    success: function(response) {
                        if (response.status === 'no_filters') {
                            Swal.fire({
                                icon: 'warning',
                                title: 'No filters applied.',
                                text: response.message,
                                confirmButtonText: 'OK'
                            });
                            return false;
                        } else if (response.status === 'projector_make_required') {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Projector Brand Required',
                                text: response.message,
                                confirmButtonText: 'OK'
                            });
                            return false;
                        } else if (response.status === 'length_exceeded') {

                            Swal.fire({
                                icon: 'info',
                                title: 'UST Projector Not Simulated',
                                text: response.message,
                                confirmButtonText: 'Proceed'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = response.redirect_url;
                                }
                            });

                            return false; // Prevents the redirection from happening instantly
                        } else if (response.status === 'projector_not_found') {
                            console.log('hitted');
                            Swal.fire({
                                icon: 'info',
                                title: 'UST Projector Not Simulated',
                                text: response.message,
                                confirmButtonText: 'Proceed'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = response.redirect_url;
                                }
                            });

                            return false; // Prevents the redirection from happening instantly
                        } else if (response.status === 'projector_model_not_found') {
                            console.log('hitted');
                            Swal.fire({
                                icon: 'info',
                                title: 'UST Projector Model Not Simulated',
                                text: response.message,
                                confirmButtonText: 'Proceed'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = response.redirect_url;
                                }
                            });

                            return false; // Prevents the redirection from happening instantly
                        } else if (response.status === 'no_products') {
                            // Correctly encode query parameters
                            var queryParams = formData.split('&').map(function(param) {
                                var pair = param.split('=');
                                return encodeURIComponent(pair[0]) + '=' +
                                    encodeURIComponent(pair[1]);
                            }).join('&');

                            Swal.fire({
                                title: 'No Products Found',
                                text: 'No products found based on your query. You will be redirected to the free quote page to make an enquiry about your customized product.',
                                icon: 'warning',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = response.redirect_url + '?' +
                                        queryParams;
                                }
                            });
                            return false;
                        } else {

                            // Handle the response here
                            $('#product-data').html(response);
                        }
                        Swal.close(); // Close the loading SweetAlert
                    },
                    error: function(xhr) {
                        // Handle errors here
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'An error occurred. Please try again.'
                        });
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.filter-checkbox').change(function() {
                let selectedFilters = {};

                $('.filter-checkbox:checked').each(function() {
                    let type = $(this).data('type');
                    let name = $(this).data('name');
                    let value = $(this).data('value');

                    if (!selectedFilters[type]) {
                        selectedFilters[type] = [];
                    }

                    if (value) {
                        selectedFilters[type].push(value);
                    } else {
                        selectedFilters[type].push(name);
                    }
                });
                // Show loading SweetAlert
                Swal.fire({
                    title: 'Loading...',
                    text: 'Please wait while we fetch the products.',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                $.ajax({
                    url: '{{ route('filter.projector.list') }}',
                    method: 'GET',
                    data: {

                        filters: selectedFilters
                    },
                    success: function(response) {

                        $('#product-data').html(response);
                        Swal.close(); // Close the loading SweetAlert

                    },
                    error: function(xhr) {
                        // Handle errors here
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'An error occurred. Please try again.'
                        });
                    }
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Select all Add to Cart buttons
            let addToCartButtons = document.querySelectorAll('.add-to-cart-btn');

            addToCartButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Get the closest form for the clicked button
                    let form = this.closest('form');

                    // Create FormData object
                    let formData = new FormData(form);

                    // Send AJAX request
                    fetch("{{ route('cart.add') }}", {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]')
                                    .value,
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
                                        window.location.href =
                                            '{{ route('cart.view') }}';
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
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#ec-select').change(function() {
                let sortBy = $(this).val();

                $.ajax({
                    url: "{{ route('all_products') }}",
                    type: "GET",
                    data: {
                        sort_by: sortBy
                    },
                    success: function(data) {
                        console.log("hh");
                        $('#product-data').html(data); // Update the product list
                    }
                });
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const channelBrandSelect = document.getElementById("channelBrandSelect");
            const customFields = document.getElementById("customFields");

            channelBrandSelect.addEventListener("change", function() {
                if (this.value.toLowerCase() === "others") {
                    customFields.classList.remove("d-none"); // Show the fields
                    customFields.classList.add("custom-fields-highlight"); // Add highlight
                } else {
                    customFields.classList.add("d-none"); // Hide the fields
                    customFields.classList.remove("custom-fields-highlight"); // Remove highlight
                }
            });
        });
    </script>
    <script>
        document.getElementById("brandSelect").addEventListener("change", function() {
            this.classList.remove("semi-transparent"); // Remove transparency


        });
        document.getElementById("projectorModelSelect").addEventListener("change", function() {
            this.classList.remove("semi-transparent"); // Remove transparency


        });
        document.getElementById("ceilingHeightSelect").addEventListener("change", function() {
            this.classList.remove("semi-transparent"); // Remove transparency


        });
        document.getElementById("channelBrandSelect").addEventListener("change", function() {
            this.classList.remove("semi-transparent"); // Remove transparency


        });
        document.getElementById("channelModelSelect").addEventListener("change", function() {
            this.classList.remove("semi-transparent"); // Remove transparency


        });
        document.getElementById("screenSizeSelect").addEventListener("change", function() {
            this.classList.remove("semi-transparent"); // Remove transparency


        });
        document.getElementById('clearFilters').addEventListener('click', function() {
            document.getElementById('advancedSearch').reset();
            location.reload(); // Refresh the page
        });
    </script>
    <script>
        function redirectToProduct(url) {

            window.location.href = url;
        }
    </script>
@endpush
