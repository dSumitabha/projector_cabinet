<!-- contact_us.blade.php -->
@extends('frontend.layouts.master')

@section('content')

<style>
    /* Style the select box */
    select {
        appearance: none; /* Remove default arrow */
        -webkit-appearance: none;
        -moz-appearance: none;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding-right: 30px; /* Space for the dropdown arrow */
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

<!-- Ec breadcrumb end -->

<!-- Ec Contact Us page -->
<section class="container-fluid py-1 " style="background-color: #ffffff; color: #000000;">
    <div class="container">
        <h1 class="text-center mb-4" style="color: #003366; font-weight: bold;">Free Quote</h1>

        <div class="row custom-section shadow-lg p-4 rounded bg-white">
            <div class="col-md-6 p-4">
                <div id="contact-us-form">
                    <h4 class="fw-bold my-4" style="color: #003366;">Existing Model Check</h4>
                    <p class="pb-3 mb-4 border-bottom" style="color: #666;">This form will help us check if there are pre-existing models matching your requirement. This can at times lower the price if the model is existing.</p>
                </div>

                <div id="request-quote-form">
                    <h4 class="fw-bold my-4" style="color: #003366;">Contact Information</h4>
                    <p class="pb-3 mb-4 border-bottom" style="color: #666;">In order to reach out to you, we would like to know a bit more about you.</p>
                </div>

                <form action="{{ route('free_quote_submit') }}" method="post" class="row g-4" id="freeeQuotee">
                    @csrf

                    <div class="col-12 mt-2">
                        <label for="email" class="form-label fw-bold" style="color: #003366;">Email*</label>
                        <input type="text" id="email" name="email" class="form-control rounded-2" placeholder="Enter your email address">
                        <span class="text-danger error-text email_error"></span>
                    </div>

                    <div class="col-md-6 mt-2">
                        <label for="firstName" class="form-label fw-bold" style="color: #003366;">First Name*</label>
                        <input type="text" id="firstName" name="firstName" class="form-control rounded-2" placeholder="First Name">
                        <span class="text-danger error-text firstName_error"></span>
                    </div>

                    <div class="col-md-6 mt-2">
                        <label for="lastName" class="form-label fw-bold" style="color: #003366;">Last Name*</label>
                        <input type="text" id="lastName" name="lastName" class="form-control rounded-2" placeholder="Last Name">
                        <span class="text-danger error-text lastName_error"></span>
                    </div>

                    <div class="col-md-6 mt-2">
                        <label for="brandSelect" class="form-label fw-bold" style="color: #003366;">UST Projector Brand*</label>
                        <select class="form-control rounded-2" id="brandSelect" name="projector_make">
                            <option value="">Select Brand</option>
                            <option value="Other">Other</option>
                        </select>
                        <input type="text" class="form-control d-none mt-2 rounded-2" id="otherBrandInput" name="projector_make_other" placeholder="Enter other brand">
                        <span class="text-danger error-text projector_make_error"></span>
                    </div>

                    <div class="col-md-6 mt-2">
                        <label for="projectorModelSelect" class="form-label fw-bold" style="color: #003366;">UST Projector Model*</label>
                        <select class="form-control rounded-2" id="projectorModelSelect" name="projector_model">
                            <option value="">Select Model</option>
                            <option value="Other">Other</option>
                        </select>
                        <input type="text" class="form-control d-none mt-2 rounded-2" id="projectorModelInput" name="projector_model_other" placeholder="Enter Model">
                        <span class="text-danger error-text projector_model_error"></span>
                    </div>
                    <div class="col-md-6 mt-2">
                        <label for="channelBrandSelect" class="form-label fw-bold" style="color: #003366;">Center Channel Brand*</label>
                        <select class="form-control px-2 py-0" id="channelBrandSelect" name="channel_brand" style="min-height: 30px;">
                            <option value="">Select Center Channel Brand</option>
                            <option value="Other">Other</option>
                        </select>
                        <input type="text" class="form-control d-none mt-2 rounded-2" id="channelBrandInput" name="channel_brand_other" placeholder="Enter Model">

                        <span class="text-danger error-text channel_brand_error"></span>
                    </div>

                    <div class="col-md-6 mt-2">
                        <label for="channelModelSelect" class="form-label fw-bold" style="color: #003366;">Center Channel Model*</label>
                        <select class="form-control px-2 py-0" id="channelModelSelect" name="channel_model" style="min-height: 30px;">
                            <option value="">Select Center Channel Model</option>
                            <option value="Other">Other</option>
                        </select>
                        <input type="text" class="form-control d-none mt-2 rounded-2" id="channelModelInput" name="channel_model_other" placeholder="Enter Model">

                        <span class="text-danger error-text channel_model_error"></span>
                    </div>
                    <div class="col-md-6 mt-2">
                        <label for="ceilingHeightSelect" class="form-label fw-bold" style="color: #003366;">Ceiling Height</label>
                        <select class="form-control rounded-2" id="ceilingHeightSelect" name="ceiling_height">
                            <option value="">Select Ceiling Height</option>
                            <option value="7">7 Feet</option>
                            <option value="8">8 Feet</option>
                            <option value="9">9 Feet</option>
                            <option value="10">10 Feet</option>
                            <option value="custom">Custom</option>
                        </select>
                        <input type="text" class="form-control d-none mt-2 rounded-2" id="ceilingHeightInput" name="ceiling_height_other" placeholder="Enter Ceiling Height">
                        <span class="text-danger error-text ceiling_height_error"></span>
                    </div>

                    <div class="col-md-6 mt-2">
                        <label for="screenSizeSelect" class="form-label fw-bold" style="color: #003366;">Screen Size</label>
                        <select class="form-control rounded-2" name="screen_size" id="screenSizeSelect">
                            <option value="">Select Screen Size</option>
                            <option value="100">100 inches</option>
                            <option value="120">120 inches</option>
                            <option value="132">132 inches</option>
                            <option value="150">150 inches</option>
                            <option value="custom">Custom</option>
                        </select>
                        <input type="text" class="form-control d-none mt-2 rounded-2" id="screenSizeInput" name="screen_size_other" placeholder="Enter Screen Size">
                        <span class="text-danger error-text screen_size_error"></span>
                    </div>

                    <div class="custom-form-group col-12 mt-2 mb-3">
                        <label class="form-label fw-bold m-0" style="color: #003366;">Screen Type* </label>
                        <span class="ec-new-option">
                            <span class="radio-option">
                                <input type="radio" id="fixed_screen" name="screen_type" value="fixed_screen" >
                                <label for="fixed_screen">Fixed Screen</label>
                            </span>
                            <span class="radio-option">
                                <input type="radio" id="floor_raising" name="screen_type" value="floor_raising">
                                <label for="floor_raising">Floor Raising</label>
                            </span>
                            <span class="radio-option">
                                <input type="radio" id="either_floor_raising_or_fixed_screen" name="screen_type" value="either_floor_raising_or_fixed_screen">
                                <label for="either_floor_raising_or_fixed_screen">Either Floor Raising Or Fixed Screen</label>
                            </span>
                        </span>
                        <span class="text-danger error-text screen_type_error"></span>
                    </div>

                    <div class="col-12 text-center">
                        <button class="btn btn-primary  fw-bold" type="submit">Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</section>


@endsection
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@push('script')
<script>
    $(document).ready(function() {
        function toggleFields(selectId, inputId) {
            $(selectId).change(function() {
                if ($(this).val() === "Other" || $(this).val() === "other" || $(this).val() === "custom") {
                    $(this).hide();
                    $(inputId).removeClass("d-none").focus();
                }
            });

            $(inputId).blur(function() {
                if ($(this).val().trim() === "") {
                    $(this).addClass("d-none");
                    $(selectId).val("").show();
                }
            });
        }

        // Apply function to all relevant fields
        toggleFields("#brandSelect", "#otherBrandInput");
        toggleFields("#projectorModelSelect", "#projectorModelInput");
        toggleFields("#channelBrandSelect", "#channelBrandInput");
        toggleFields("#channelModelSelect", "#channelModelInput");
        toggleFields("#ceilingHeightSelect", "#ceilingHeightInput");
        toggleFields("#screenSizeSelect", "#screenSizeInput");
    });





    $(document).ready(function() {
        // Helper function to get and decode query parameters
        function getQueryParams() {
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            let params = {};
            urlParams.forEach((value, key) => {
                params[key] = decodeURIComponent(value); // Decode the parameter values
            });
            return params;
        }

        // Retrieve query parameters
        var queryParams = getQueryParams();
        var selectedMake = queryParams.projector_make;
        var selectedModel = queryParams.projector_model;

        // Fetch data from the server
        $.getJSON("{{ route('projector.data') }}",
            function(data) {
                const uniqueMakes = [...new Set(data.map(item => item.make))];
                uniqueMakes.forEach(make => {
                    $('#brandSelect').append(new Option(make, make));
                });

                // Event listener for brand dropdown
                $('#brandSelect').change(function() {
                    const selectedMake = $(this).val();
                    $('#projectorModelSelect').empty().append(new Option('Select Model', ''));

                    if (selectedMake) {
                        const filteredModels = data.filter(item => item.make === selectedMake);

                        filteredModels.forEach(item => {
                            $('#projectorModelSelect').append(new Option(item.model, item.model));
                        });

                        // Add "Other" option at the end
                        $('#projectorModelSelect').append(new Option('Other', 'Other'));

                        $('#modelMessage').hide();
                    } else {
                        $('#modelMessage').show();
                    }

                    // Set the selected model after options are populated
                    if (selectedModel) {
                        $('#projectorModelSelect').val(selectedModel).change(); // Ensure change event is triggered
                    }
                });


                // Set the selected make after options are populated
                if (selectedMake) {
                    $('#brandSelect').val(selectedMake).change(); // Trigger change to populate models
                } else {
                    $('#projectorModelSelect').empty().append(new Option('Select Model', ''));
                }

                // Event listener for model dropdown
                $('#projectorModelSelect').change(function() {
                    if (!$('#brandSelect').val()) {
                        $('#modelMessage').show();
                    } else {
                        $('#modelMessage').hide();
                    }
                });
            });



        function fetchCeilingHeight(projectorMake) {
            if (!projectorMake) {
                $('#ceilingHeightSelect').empty().append(new Option('Select Ceiling Height', ''));
                return;
            }

            $.getJSON("{{ route('ceiling.height') }}", {
                projector_make: projectorMake
            }, function(data) {
                $('#ceilingHeightSelect').empty().append(new Option('Select Ceiling Height', ''));
                if (data.length > 0) {
                    data.forEach(height => {
                        $('#ceilingHeightSelect').append(new Option(height, height));
                    });
                } else {
                    $('#ceilingHeightSelect').append(new Option('No Data Available', ''));
                }
            });
        }


        function fetchScreenSize(projectorMake) {
            if (!projectorMake) {
                $('#screenSizeSelect').empty().append(new Option('Select Screen Size', ''));
                return;
            }

            $.getJSON("{{ route('screen.size') }}", {
                projector_make: projectorMake
            }, function(data) {
                $('#screenSizeSelect').empty().append(new Option('Select Screen Size', ''));
                if (data.length > 0) {
                    data.forEach(height => {
                        $('#screenSizeSelect').append(new Option(height, height));
                    });
                } else {
                    $('#screenSizeSelect').append(new Option('No Data Available', ''));
                }
            });
        }




    });






















    $(document).ready(function() {
        $('#freeeQuotee').on('submit', function(e) {

            e.preventDefault();
            let submitBtn = $('.submit-btn');
            submitBtn.prop('disabled', true).text('Loading...');

            let form = $(this);
            let formData = new FormData(this);

            $.ajax({
                url: form.attr('action'),
                method: form.attr('method'),
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                beforeSend: function() {
                    $('.error-text').text('');
                },
                success: function(data) {
                    if (data.status === 400) {
                        $.each(data.error, function(key, value) {
                            $('.' + key + '_error').text(value[0]);
                        });
                        submitBtn.prop('disabled', false).text('Submit');
                    } else if (data.status === 200) {
                        resetForm();

                        // Show SweetAlert Success Message
                        Swal.fire({
                            title: 'Thank You!',
                            text: 'We have received your request. We will contact you as soon as possible.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            location.reload(); // Reload after user clicks OK
                        });
                    }
                },
                complete: function() {
                    submitBtn.prop('disabled', false).text('Submit');
                }
            });
        });

        function resetForm() {
            $('#freeeQuotee')[0].reset();
            $('.error-text').text('');
        }
    });
</script>
<script>
    $(document).ready(function() {
        // Helper function to get and decode query parameters
        function getQueryParams() {
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            let params = {};
            urlParams.forEach((value, key) => {
                params[key] = decodeURIComponent(value); // Decode the parameter values
            });
            return params;
        }

        // Retrieve query parameters
        var queryParams = getQueryParams();
        var selectedBrand = queryParams.channel_brand;
        var selectedModel = queryParams.channel_model;

        // Fetch data from the server
        $.getJSON("{{ route('speaker.data') }}",
            function(data) {
                const uniqueBrands = [...new Set(data.map(item => item.brand))];
                uniqueBrands.forEach(brand => {
                    $('#channelBrandSelect').append(new Option(brand, brand));
                });

                // Event listener for brand dropdown
                $('#channelBrandSelect').change(function() {
                    var selectedBrand = $(this).val();
                    $('#channelModelSelect').empty().append(new Option('Select Model', ''));

                    if (selectedBrand) {
                        $('#modelMessageSpeaker').hide();
                        const filteredModels = data.filter(item => item.brand === selectedBrand);

                        filteredModels.forEach(item => {
                            $('#channelModelSelect').append($('<option>', {
                                value: item.model,
                                text: item.model
                            }));
                        });

                        // Add "Other" option at the end
                        $('#channelModelSelect').append(new Option('Other', 'Other'));

                        // Set the selected model after options are populated
                        if (selectedModel) {
                            $('#channelModelSelect').val(selectedModel).change(); // Ensure change event is triggered
                        }
                    } else {
                        $('#modelMessageSpeaker').show();
                    }
                });


                // Set the selected brand after options are populated
                if (selectedBrand) {
                    $('#channelBrandSelect').val(selectedBrand).change(); // Trigger change to populate models
                } else {
                    $('#channelModelSelect').empty().append(new Option('Select Model', ''));
                }

                // Model dropdown change event
                $('#channelModelSelect').change(function() {
                    var selectedModel = $(this).val();
                    if (selectedModel === '') {
                        $('#modelMessageSpeaker').show();
                    } else {
                        $('#modelMessageSpeaker').hide();
                    }
                });
            });
    });
</script>



<script>
    function getQueryParams() {
        var queryParams = {};
        var queryString = window.location.search.substring(1);
        console.log("Query String:", queryString); // Debugging line
        var queryArr = queryString.split("&");
        for (var i = 0; i < queryArr.length; i++) {
            var pair = queryArr[i].split("=");
            queryParams[decodeURIComponent(pair[0])] = decodeURIComponent(pair[1] || "");
        }
        console.log("Parsed Query Params:", queryParams); // Debugging line
        return queryParams;
    }

    // Use the parsed query params to set form values
    $(document).ready(function() {
        var params = getQueryParams();
        $('#email').val(params.email || '');
        $('#firstName').val(params.firstName || '');
        $('#lastName').val(params.lastName || '');
        $('#brandSelect').val(params.projector_make || '');
        $('#projectorModelSelect').val(params.projector_model || '');
        $('#channelBrandSelect').val(params.channel_brand || '');
        $('#channelModelSelect').val(params.channel_model || '');
        $('#ceilingHeightSelect').val(params.ceiling_height || '');
        $('#screenSizeSelect').val(params.screen_size || '');
        $('input[name="radio-group"][value="' + (params['radio-group'] || '') + '"]').prop('checked', true);
    });
</script>
@endpush
