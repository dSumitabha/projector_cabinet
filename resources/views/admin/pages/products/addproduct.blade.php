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
                <h1>Add Product</h1>
                <p class="breadcrumbs"><span><a href="{{ route('admin.dashboard') }}">Home</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span>Product
                </p>
            </div>
            <div>
                <a href="{{ route('admin.products.index') }}" class="btn btn-primary"> View All Products
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="ec-cat-list card card-default mb-24px">
                    <div class="card-body">
                        <div class="ec-cat-form" id="productImportForm">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4>Add New Products - By Import</h4>
                                <!-- Button to download Excel format -->
                                <a href="{{ route('admin.products.download-format') }}" class="btn btn-outline-success">
                                    <i class="mdi mdi-download"></i> Download Excel Format
                                </a>
                            </div>
                            <div class="instruction-box">
                                <ul>
                                    <li style="color:#04064d"><b>Please Note :</b></li>
                                    <li><strong>Product Id </strong> must be <span
                                            class="text-danger">unique</span>.</li>

                                            <li><strong>Product Id, Parent Product Id, Product Name,Product Frontend Name, Product Type, Profit %  </strong> - all fields must be <span class="text-danger">mandatory</span>.</li>

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
                            <form action="{{ route('admin.products.import') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="file" class="col-form-label">Import Excel File</label>
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
                        <h2>Add Product</h2>
                    </div>
                    <div class="card-body">
                        <div class="row ec-vendor-uploads">
                            <div class="col-lg-12">
                                <div class="ec-vendor-upload-detail">
                                    <form id="addProductForm" class="row g-3">
                                        <div class="col-md-6">
                                            <label for="parent_product_id" class="form-label">Parent Product Id <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="parent_product_id" name="parent_product_id">
                                            <div class="invalid-feedback mb-3"></div>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="product_id" class="form-label">Product Id <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="product_id" name="product_id">
                                            <div class="invalid-feedback mb-3"></div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="product_frontend_name" class="form-label">Product Front-End name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="product_frontend_name" name="product_frontend_name">
                                            <div class="invalid-feedback mb-3"></div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="product_frontend_description" class="form-label">Product Front-End Description <span class="text-danger">*</span></label>
                                            <textarea class="form-control" id="product_frontend_description" name="product_frontend_description" rows="4"></textarea>
                                            <div class="invalid-feedback mb-3"></div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="product_name" class="form-label">Product Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="product_name" name="product_name">
                                            <div class="invalid-feedback mb-3"></div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="product_type" class="form-label">Product Type <span class="text-danger">*</span></label>
                                            <select name="product_type" id="product_type" class="form-select">
                                                <optgroup label="Select Product Type">
                                                    <option value="Parent Product">Parent Product</option>
                                                    <option value="Child Product">Child Product</option>

                                                </optgroup>
                                            </select>
                                            <div class="invalid-feedback mb-3"></div>
                                        </div>

                                        <div class="col-md-3">
                                            <label for="gs1" class="form-label">GS1</label>
                                            <input type="text" class="form-control" id="gs1" name="gs1">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="gs1_type" class="form-label">GS1 Type</label>
                                            <input type="text" class="form-control" id="gs1_type" name="gs1_type">
                                        </div>

                                        <div class="col-md-4">
                                            <label for="length_of_cabinet" class="form-label">Length of the Cabinet (inches)</label>
                                            <input type="text" class="form-control" id="length_of_cabinet" name="length_of_cabinet">
                                            <div class="invalid-feedback mb-3"></div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="height_of_cabinet" class="form-label">Height of the Cabinet (inches)</label>
                                            <input type="text" class="form-control" id="height_of_cabinet" name="height_of_cabinet">
                                            <div class="invalid-feedback mb-3"></div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="depth_of_cabinet" class="form-label">Depth of the Cabinet (inches)</label>
                                            <input type="text" class="form-control" id="depth_of_cabinet" name="depth_of_cabinet">
                                            <div class="invalid-feedback mb-3"></div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="diy" class="form-label">DIY</label>
                                            <select class="form-select" id="diy" name="diy">
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                            <div class="invalid-feedback mb-3">Please select Yes or No.</div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="has_doors" class="form-label">Has Door</label>
                                            <select class="form-select" id="has_doors" name="has_doors">
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                            <div class="invalid-feedback mb-3">Please select Yes or No.</div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="color" class="form-label">Profile</label>
                                            <input type="text" class="form-control" id="profile" name="profile">
                                            <div class="invalid-feedback mb-3"></div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="color" class="form-label">Size</label>
                                            <input type="text" class="form-control" id="size" name="size">
                                            <div class="invalid-feedback mb-3"></div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="color" class="form-label">Color</label>
                                            <input type="text" class="form-control" id="color" name="color">
                                            <div class="invalid-feedback mb-3">Please provide a valid color.</div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="packaging_product_id" class="form-label">Packaging Product ID</label>
                                            <input type="text" class="form-control" id="packaging_product_id" name="packaging_product_id">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="layout_id" class="form-label">Layout ID</label>
                                            <input type="text" class="form-control" id="layout_id" name="layout_id">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="fusion_id" class="form-label">Fusion ID</label>
                                            <input type="text" class="form-control" id="fusion_id" name="fusion_id">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="render_id" class="form-label">Render ID</label>
                                            <input type="text" class="form-control" id="render_id" name="render_id">
                                        </div>

                                        <div class="col-md-4">
                                            <label for="product_center_channel_placement" class="form-label">Product Center Channel Placement</label>
                                            <input type="text" class="form-control" id="product_center_channel_placement" name="product_center_channel_placement">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="off_wall" class="form-label">Off Wall</label>
                                            <select class="form-select" id="off_wall" name="off_wall">
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="floor_raising_screen" class="form-label">Floor Raising Screen</label>
                                            <select class="form-select" id="floor_raising_screen" name="floor_raising_screen">
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="depth_of_middle_section" class="form-label">Depth of Middle Section</label>
                                            <input type="text" class="form-control" id="depth_of_middle_section" name="depth_of_middle_section">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="depth_of_side_sections" class="form-label">Depth of Side Sections</label>
                                            <input type="text" class="form-control" id="depth_of_side_sections" name="depth_of_side_sections">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="center_channel_chamber_length" class="form-label">Center Channel Chamber Length</label>
                                            <input type="text" class="form-control" id="center_channel_chamber_length" name="center_channel_chamber_length">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="center_channel_chamber_depth" class="form-label">Center Channel Chamber Depth</label>
                                            <input type="text" class="form-control" id="center_channel_chamber_depth" name="center_channel_chamber_depth">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="center_channel_chamber_height" class="form-label">Center Channel Chamber Height</label>
                                            <input type="text" class="form-control" id="center_channel_chamber_height" name="center_channel_chamber_height">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="compatable_with_projectors" class="form-label">Compatible with Projectors</label>
                                            <select class="form-select" id="compatable_with_projectors" name="compatable_with_projectors">
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="compatable_with_center_channels" class="form-label">Compatible with Center Channels</label>
                                            <select class="form-select" id="compatable_with_center_channels" name="compatable_with_center_channels">
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="center_channel_placement" class="form-label">Center Channel Placement</label>
                                            <input type="text" class="form-control" id="center_channel_placement" name="center_channel_placement">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="variable_height_projector_platform" class="form-label">Variable Height Projector Platform</label>
                                            <input type="text" class="form-control" id="variable_height_projector_platform" name="variable_height_projector_platform">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="variable_height_center_channel_platform" class="form-label">Variable Height Center Channel Platform</label>
                                            <input type="text" class="form-control" id="variable_height_center_channel_platform" name="variable_height_center_channel_platform">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="variable_depth_center_channel_platform" class="form-label">Variable Depth Center Channel Platform</label>
                                            <input type="text" class="form-control" id="variable_depth_center_channel_platform" name="variable_depth_center_channel_platform">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="angling_mechanism_for_center_channel" class="form-label">Angling Mechanism for Center Channel</label>
                                            <input type="text" class="form-control" id="angling_mechanism_for_center_channel" name="angling_mechanism_for_center_channel">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="enclosed_ust_projector" class="form-label">Enclosed UST Projector</label>
                                            <input type="text" class="form-control" id="enclosed_ust_projector" name="enclosed_ust_projector">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="enclosed_center_channel" class="form-label">Enclosed Center Channel</label>
                                            <input type="text" class="form-control" id="enclosed_center_channel" name="enclosed_center_channel">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="open_back_design" class="form-label">Open Back Design</label>
                                            <input type="text" class="form-control" id="open_back_design" name="open_back_design">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="silent_fan_for_flushing_heat_from_avr" class="form-label">Silent Fan for Flushing Heat from AVR</label>
                                            <input type="text" class="form-control" id="silent_fan_for_flushing_heat_from_avr" name="silent_fan_for_flushing_heat_from_avr">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="adjustable_height_legs" class="form-label">Adjustable Height Legs</label>
                                            <input type="text" class="form-control" id="adjustable_height_legs" name="adjustable_height_legs">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="remote_friendly" class="form-label">Remote Friendly</label>
                                            <input type="text" class="form-control" id="remote_friendly" name="remote_friendly">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="off_wall_cabinet" class="form-label">Off Wall Cabinet</label>
                                            <input type="text" class="form-control" id="off_wall_cabinet" name="off_wall_cabinet">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="is_floor_raising_screen_embedded_within_cabinet" class="form-label">Floor Raising Screen Embedded Within Cabinet</label>
                                            <input type="text" class="form-control" id="is_floor_raising_screen_embedded_within_cabinet" name="is_floor_raising_screen_embedded_within_cabinet">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="material" class="form-label">Material</label>
                                            <input type="text" class="form-control" id="material" name="material">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="installation_required" class="form-label">Installation Required</label>
                                            <input type="text" class="form-control" id="installation_required" name="installation_required">
                                        </div>


                                        <div class="col-md-6">
                                            <label for="profit_percentage" class="form-label">Profit %  <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="profit_percentage" name="profit_percentage"
                                                pattern="^\d+(\.\d{1,2})?$" title="Please enter a valid profit percentage (e.g., 10 or 10.5)">
                                            <div class="invalid-feedback mb-3">Enter a valid percentage (e.g., 10 or 10.5).</div>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="profit_margin" class="form-label">Profit Margin  <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="profit_margin" name="profit_percentage"
                                                pattern="^\d+(\.\d{1,2})?$" title="Please enter a valid profit margin ">
                                            <div class="invalid-feedback mb-3">If Profit margin present , we will not considered the Profit %.</div>
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
        $(document).ready(function() {
            $('#addProductForm').submit(function(event) {
                event.preventDefault();
                $('.invalid-feedback').text('');
                $('.form-control').removeClass('is-invalid');

                var formData = $(this).serialize();
                var csrfToken = '{{ csrf_token() }}';
                $.ajax({
                    url: '{{ route('admin.products.store') }}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    data: formData,
                    success: function(response) {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Product added successfully!',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href =
                                    "{{ route('admin.products.index') }}";
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
                                var $field = $('#' + field.replace(/\./g, '_'));
                                console.log('Field:', $field);
                                $field.addClass(
                                    'is-invalid'
                                ); // Add is-invalid class to form-control
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
