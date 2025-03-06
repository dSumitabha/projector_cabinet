@extends('admin.layouts.master')
@section('content')
    <style>
        .text-danger {
            color: red !important;
        }
        .instruction-box {
            border: 2px solid #007BFF;
            /* Blue border */
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            /* Shadow effect */
            max-width: 400px;
            /* Set a max width */
            margin: 20px auto;
            /* Center the box on the page */
            background-color: #f9f9f9;
            /* Light background color */
        }
    </style>
    <!-- PAGE WRAPPER -->


    <div class="content">
        <div class="breadcrumb-wrapper d-flex align-items-center justify-content-between">
            <div>
                <h1>Add Product Association</h1>
                <p class="breadcrumbs"><span><a href="{{ route('admin.dashboard') }}">Home</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span>Product Association
                </p>
            </div>
            <div>
                <a href="{{ route('admin.products_associated.index') }}" class="btn btn-primary"> View All
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="ec-cat-list card card-default mb-24px">
                    <div class="card-body">
                        <div class="ec-cat-form" id="projectorForm">

                            <div class="d-flex justify-content-between align-items-center">
                                <h4>Add Product Associateds - By Import</h4>
                                <!-- Button to download Excel format -->
                                <a href="{{ route('admin.associated_parts.download-format') }}" class="btn btn-outline-success">
                                    <i class="mdi mdi-download"></i> Download Excel Format
                                </a>
                            </div>
                            <div class="instruction-box">
                                <ul>
                                    <li style="color:#04064d"><b>Please Note :</b></li>
                                    <li>Parent Product Id <strong></strong> is <span
                                            class="text-danger">mandatory and must exist in the products table.</span></li>


                                    <li>Maintain the proper format of the Excel sheet, and <span
                                            class="text-danger">never alter the column
                                            headers</span>.</li>
                                </ul>
                            </div>
                            <hr />
                            {{-- Display Import Failures --}}
                            @if (session()->has('failures'))
                                <div class="alert alert-danger">
                                    <h4>Import Failures:</h4>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Row</th>
                                                <th>Errors</th>
                                                <th>Values</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach (session()->get('failures') as $failure)
                                                <tr>
                                                    <td>{{ $failure->row() }}</td>
                                                    <td>
                                                        <ul>
                                                            @foreach ($failure->errors() as $error)
                                                                <li>{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </td>
                                                    <td>
                                                        <ul>
                                                            @foreach ($failure->values() as $value)
                                                                <li>{{ $value }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif

                            {{-- Display General Validation Errors (e.g., file validation) --}}
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <h4>Errors:</h4>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ route('admin.associated_parts.import') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="file" class="col-form-label">Import Excel File </label>
                                    <input type="file" name="file" class="form-control">
                                </div>
                                <button class="btn btn-primary">Import</button>
                            </form>



                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom">
                        <h2>Add Product - Dynamically</h2>
                    </div>
                    <div class="card-body">
                        <div class="row ec-vendor-uploads">
                            <div class="col-lg-12">
                                <div class="ec-vendor-upload-detail">
                                    <form id="addProductForm" class="row g-3">
                                        <div class="col-md-6">
                                            <label for="parent_product_id" class="form-label">Parent Product Id <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="parent_product_id"
                                                name="parent_product_id">
                                            <div class="invalid-feedback mb-3"></div>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="projector_make" class="form-label">Projector Brand <span
                                                    class="text-danger">*</span></label>
                                            <select name="projector_make" id="projector_make" class="form-select">
                                                <option value="" selected disabled>Select Projector Brand</option>


                                                @foreach ($uniqueMakes as $make)
                                                    <option value="{{ $make->make }}">{{ $make->make }}</option>
                                                @endforeach





                                            </select>
                                            <div class="invalid-feedback mb-3"></div>
                                        </div>
                                        {{-- <div class="col-md-6">
                                            <label for="projector_model" class="form-label">Projector Model <span class="text-danger">*</span></label>
                                            <select name="projector_model" id="projector_model" class="form-select">


                                            </select>
                                            <div class="invalid-feedback mb-3"></div>
                                        </div> --}}
                                        <div class="col-md-6">
                                            <label for="projector_model" class="form-label">Projector Model <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="projector_model"
                                                name="projector_model">
                                            <div class="invalid-feedback mb-3"></div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label for="projector_platform_slot_from_bottom" class="form-label">Slot from
                                                Bottom (Projector Platform)</label>
                                            <input type="text" class="form-control"
                                                id="projector_platform_slot_from_bottom"
                                                name="projector_platform_slot_from_bottom">
                                            <div class="invalid-feedback mb-3"></div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label for="center_channel_tilt_slot" class="form-label">Center Channel Tilt Slot</label>
                                            <input type="text" class="form-control"
                                                id="center_channel_tilt_slot"
                                                name="center_channel_tilt_slot">
                                            <div class="invalid-feedback mb-3"></div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label for="center_channel_tilt_rod_lenth" class="form-label">Center Channel Tilt Rod Length</label>
                                            <input type="text" class="form-control"
                                                id="center_channel_tilt_rod_lenth"
                                                name="center_channel_tilt_rod_lenth">
                                            <div class="invalid-feedback mb-3"></div>
                                        </div>
                                        <div class="col-md-6 mt-3 mb-3">
                                            <label for="center_channel_l_clamp_position" class="form-label">Center
                                                Channel L-Clamp Position</label>
                                            <input type="text" class="form-control"
                                                id="center_channel_l_clamp_position"
                                                name="center_channel_l_clamp_position">
                                            <div class="invalid-feedback mb-3"></div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label for="center_channel_slot_from_bottom" class="form-label">Slot from Bottom
                                                (Center Channel)</label>
                                            <input type="text" class="form-control" id="center_channel_slot_from_bottom"
                                                name="center_channel_slot_from_bottom">
                                            <div class="invalid-feedback mb-3"></div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label for="floor_raising_slot_from_bottom" class="form-label">Slot from Bottom
                                                (Floor Raising)</label>
                                            <input type="text" class="form-control" id="floor_raising_slot_from_bottom"
                                                name="floor_raising_slot_from_bottom">
                                            <div class="invalid-feedback mb-3"></div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label for="edit_screen_size" class="form-label">Screen Size <span
                                                    class="text-danger">*</span></label>
                                            <input type="number" class="form-control" id="screen_size"
                                                name="screen_size">
                                            <div class="invalid-feedback mb-3"></div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label for="ceiling_height" class="form-label">Ceiling Height<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="ceiling_height"
                                                name="ceiling_height">
                                            <div class="invalid-feedback mb-3"></div>
                                        </div>
                                        <div class="col-md-6 mt-3 mb-3">
                                            <label for="center_channel_height" class="form-label">Center Channel
                                                Height</label>
                                            <input type="text" class="form-control" id="center_channel_height"
                                                name="center_channel_height">
                                            <div class="invalid-feedback mb-3"></div>
                                        </div>

                                        <div class="col-md-6 mt-3 mb-3">
                                            <label for="simulated_center_channel" class="form-label">Simulated Center
                                                Channel</label>
                                            <input type="text" class="form-control" id="simulated_center_channel"
                                                name="simulated_center_channel">
                                            <div class="invalid-feedback mb-3"></div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label for="distance_of_cabinet_from_screen" class="form-label">Distance of
                                                Cabinet from Screen</label>
                                            <input type="text" class="form-control"
                                                id="distance_of_cabinet_from_screen"
                                                name="distance_of_cabinet_from_screen">
                                            <div class="invalid-feedback mb-3"></div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label for="distance_of_projector_from_screen" class="form-label">Distance of
                                                Projector from Screen</label>
                                            <input type="text" class="form-control"
                                                id="distance_of_projector_from_screen"
                                                name="distance_of_projector_from_screen">
                                            <div class="invalid-feedback mb-3"></div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label for="distance_of_top_section_of_screen_from_ceiling"
                                                class="form-label">Distance of Top Section of the Screen from
                                                Ceiling</label>
                                            <input type="text" class="form-control"
                                                id="distance_of_top_section_of_screen_from_ceiling"
                                                name="distance_of_top_section_of_screen_from_ceiling">
                                            <div class="invalid-feedback mb-3"></div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label for="distance_of_bottom_section_of_the_screen_from_floor"
                                                class="form-label">Distance of Bottom Section of the Screen from
                                                Floor</label>
                                            <input type="text" class="form-control"
                                                id="distance_of_bottom_section_of_the_screen_from_floor"
                                                name="distance_of_bottom_section_of_the_screen_from_floor">
                                            <div class="invalid-feedback mb-3"></div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label for="distance_of_floor_raising_screen_from_wall"
                                                class="form-label">Distance of Cabinet from wall</label>
                                            <input type="text" class="form-control"
                                                id="distance_of_floor_raising_screen_from_wall"
                                                name="distance_of_floor_raising_screen_from_wall">
                                            <div class="invalid-feedback mb-3"></div>
                                        </div>


                                        <div class="col-md-6 mt-3 mb-3">
                                            <label for="max_center_channel_height" class="form-label">Max Center
                                                Channel Height</label>
                                            <input type="text" class="form-control" id="max_center_channel_height"
                                                name="max_center_channel_height">
                                            <div class="invalid-feedback mb-3"></div>
                                        </div>
                                        <div class="col-md-6 mt-3 mb-3">
                                            <label for="max_center_channel_length" class="form-label">Max Center
                                                Channel Length</label>
                                            <input type="text" class="form-control" id="max_center_channel_length"
                                                name="max_center_channel_length">
                                            <div class="invalid-feedback mb-3"></div>
                                        </div>

                                        <div class="col-md-6 mt-3 mb-3">
                                            <label for="max_allowed_center_channel_depth" class="form-label">Max
                                                Allowed Center Channel Depth</label>
                                            <input type="text" class="form-control"
                                                id="max_allowed_center_channel_depth"
                                                name="max_allowed_center_channel_depth">
                                            <div class="invalid-feedback mb-3"></div>
                                        </div>

                                        <div class="col-md-6 mt-3 mb-3">
                                            <label for="center_channel_flag" class="form-label">Center Channel
                                                Flag</label>
                                            <input type="text" class="form-control" id="center_channel_flag"
                                                name="center_channel_flag">
                                            <div class="invalid-feedback mb-3"></div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label for="viewing_angle_sitting" class="form-label">Viewing Angle
                                                (Sitting)</label>
                                            <input type="text" class="form-control" id="viewing_angle_sitting"
                                                name="viewing_angle_sitting">
                                            <div class="invalid-feedback mb-3"></div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label for="viewing_angle_reclining" class="form-label">Viewing Angle
                                                (Reclining)</label>
                                            <input type="text" class="form-control" id="viewing_angle_reclining"
                                                name="viewing_angle_reclining">
                                            <div class="invalid-feedback mb-3"></div>
                                        </div>
                                        <div class="col-md-6 mt-3 mb-3">
                                            <label for="edit_hearing_angle" class="form-label">Hearing Angle</label>
                                            <input type="text" class="form-control" id="hearing_angle"
                                                name="hearing_angle">
                                            <div class="invalid-feedback mb-3"></div>
                                        </div>
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Content -->

    <!-- End Content Wrapper -->



@endsection
@push('script')
    <script>
        // $(document).ready(function() {
        //     $('#projector_model').prop('disabled', true);

        //     $('#projector_make').change(function() {
        //         var make = $(this).val();
        //         var url = '{{ route('admin.products_associated.getModels', ':make') }}';
        //         url = url.replace(':make', make);
        //         if (make) {
        //             $('#projector_model').prop('disabled', false);
        //             $.ajax({
        //                 url: url,
        //                 type: 'GET',
        //                 dataType: 'json',
        //                 success: function(data) {
        //                     $('#projector_model').empty().append('<option value="">Select Projector Model</option>');
        //                     $.each(data, function(key, value) {
        //                         $('#projector_model').append('<option value="' + value.model + '">' + value.model + '</option>');
        //                     });
        //                 }
        //             });
        //         } else {
        //             $('#projector_model').prop('disabled', true).empty().append('<option value="">Select Model</option>');
        //             $('#projector_model').empty().append('<option value="">Select Model</option>');
        //         }
        //     });
        // });
    </script>
    <script>
        $(document).ready(function() {
            $('#addProductForm').submit(function(event) {
                event.preventDefault();
                $('.invalid-feedback').text('');
                $('.form-control').removeClass('is-invalid');

                var formData = $(this).serialize();
                var csrfToken = '{{ csrf_token() }}';
                $.ajax({
                    url: '{{ route('admin.products_associated.store') }}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    data: formData,
                    success: function(response) {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Record added successfully!',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href =
                                    "{{ route('admin.products_associated.index') }}";
                            }
                        });
                        $('#addProductForm')[0].reset();
                    },
                    error: function(xhr) {
                        // If there are validation errors, handle them
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            var errors = xhr.responseJSON.errors;
                            // Log errors for debugging
                            console.log('Validation Errors:', errors);
                            // Iterate over each field with errors
                            $.each(errors, function(field, errorMessage) {
                                // Map field name to corresponding HTML element using name attribute
                                var $field = $('[name="' + field + '"]');
                                console.log('Field:', $field);
                                $field.addClass(
                                'is-invalid'); // Add is-invalid class to form-control
                                $field.next('.invalid-feedback').text(errorMessage[
                                0]); // Display error message
                            });
                        }
                    }
                });
            });
        });
    </script>
@endpush
