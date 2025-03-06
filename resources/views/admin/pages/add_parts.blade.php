@extends('admin.layouts.master')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .text-danger {
            color: red;
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

        ul {

            padding-left: 20px;
        }

        li {
            margin-bottom: 5px;
        }
    </style>
    <!-- CONTENT WRAPPER -->
    <div class="ec-content-wrapper">
        <div class="content">
            <div class="breadcrumb-wrapper breadcrumb-wrapper-2 breadcrumb-contacts">
                <h1>Parts</h1>
                <p class="breadcrumbs"><span><a href="{{ route('admin.dashboard') }}">Home</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span>Parts
                </p>
            </div>
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="ec-cat-list card card-default mb-24px">
                        <div class="card-body">
                            <div class="ec-cat-form" id="projectorForm">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h4>Add New Parts - By Import</h4>
                                    <!-- Button to download Excel format -->
                                    <a href="{{ route('admin.parts.download-format') }}" class="btn btn-outline-success">
                                        <i class="mdi mdi-download"></i> Download Excel Format
                                    </a>
                                </div>

                                <div class="instruction-box">
                                    <ul>
                                        <li style="color:#04064d"><b>Please Note :</b></li>
                                        <li>Ensure that the <strong>Part ID</strong> is <span
                                                class="text-danger">unique</span>.</li>
                                        <li>For parts with the <strong>Part Type</strong> labeled as
                                            <strong>Service</strong>, the <strong>Rate</strong> field is <span
                                                class="text-danger">mandatory.</span>
                                        </li>
                                        <li>Similarly, for parts with the <strong>Service Type</strong>, the <strong>Per
                                                Unit Cost</strong> field is <span class="text-danger"> mandatory</span>.
                                        </li>

                                        <li>Maintain the proper format of the Excel sheet, and <span
                                                class="text-danger">never alter the column
                                                headers</span>.</li>
                                    </ul>
                                </div>
                                <hr />
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form action="{{ route('admin.parts.import') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="file" class="col-form-label">Import Parts</label>
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
                <div class="col-xl-12 col-lg-12">
                    <div class="ec-cat-list card card-default mb-24px">
                        <div class="card-body">
                            <div class="ec-cat-form" id="projectorForm">
                                <h4>Add New Parts - Dynamically</h4>
                                <form id="addPartForm" method="POST" action="{{ route('admin.parts.store') }}">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <label for="part_id" class="col-form-label">Part ID</label>
                                            <input id="part_id" name="part_id" class="form-control here" type="text"
                                                value="{{ old('part_id') }}">
                                            @error('part_id')
                                                <span class="text-danger">*{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="part_category" class="col-form-label">Part Category</label>
                                            <input id="part_category" name="part_category" class="form-control here" type="text"
                                                value="{{ old('part_category') }}">
                                            @error('part_category')
                                                <span class="text-danger">*{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="part_or_service_name" class="col-form-label">Part or Service Name</label>
                                            <input id="part_or_service_name" name="part_or_service_name" class="form-control here" type="text"
                                                value="{{ old('part_or_service_name') }}">
                                            @error('part_or_service_name')
                                                <span class="text-danger">*{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="source_company" class="col-form-label">Source Company</label>
                                            <input id="source_company" name="source_company" class="form-control here"
                                                type="text" value="{{ old('source_company') }}">
                                            @error('source_company')
                                                <span class="text-danger">*{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="lead_time" class="col-form-label">Delivery Time (days)</label>
                                            <input id="lead_time" name="lead_time" class="form-control here" type="number"
                                                value="{{ old('lead_time') }}">
                                            @error('lead_time')
                                                <span class="text-danger">*{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="part_type" class="col-form-label">Part Type</label>
                                            <input id="part_type" name="part_type" class="form-control here" type="text"
                                                value="{{ old('part_type') }}">
                                            @error('part_type')
                                                <span class="text-danger">*{{ $message }}</span>
                                            @enderror
                                        </div>
                                      
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <label for="source" class="col-form-label">Source</label>
                                            <input id="source" name="source" class="form-control here" type="text"
                                                value="{{ old('source') }}">
                                            @error('source')
                                                <span class="text-danger">*{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="batch_cost" class="col-form-label">Batch Cost</label>
                                            <input id="batch_cost" name="batch_cost" class="form-control here" type="text"
                                                value="{{ old('batch_cost') }}">
                                            @error('batch_cost')
                                                <span class="text-danger">*{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="sales_tax" class="col-form-label">Sales Tax</label>
                                            <input id="sales_tax" name="sales_tax" class="form-control here" type="text"
                                                value="{{ old('sales_tax') }}">
                                            @error('sales_tax')
                                                <span class="text-danger">*{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4" id="rateField" style="display:none">
                                            <label for="rate" class="col-form-label">Rate</label>
                                            <input id="rate" name="rate" class="form-control here"
                                                type="number"  value="{{ old('rate') }}">
                                            @error('rate')
                                                <span class="text-danger">*{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4" id="unitCostField" style="display:none">
                                            <label for="unit_cost" class="col-form-label">Unit Cost</label>
                                            <input id="unit_cost" name="unit_cost" class="form-control here"
                                                type="number"  value="{{ old('unit_cost') }}">
                                            @error('unit_cost')
                                                <span class="text-danger">*{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <label for="qty" class="col-form-label">Quantity</label>
                                            <input id="qty" name="qty" class="form-control here"
                                                type="number" value="{{ old('qty') }}">
                                            @error('qty')
                                                <span class="text-danger">*{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <label for="units_available" class="col-form-label">Available Qty</label>
                                            <input id="units_available" name="units_available" class="form-control here"
                                                type="number" value="{{ old('units_available') }}">
                                            @error('units_available')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-12">
                                            <label for="url" class="col-form-label">URL</label>
                                            <input id="url" name="url" class="form-control here"
                                                type="text" value="{{ old('url') }}">
                                            @error('url')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="part_dimensions_length" class="col-form-label">Part Dimension Length</label>
                                            <input id="part_dimensions_length" name="part_dimensions_length" class="form-control here"
                                                type="text" value="{{ old('part_dimensions_length') }}">
                                            @error('part_dimensions_length')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="part_dimensions_width" class="col-form-label">Part Dimension Width</label>
                                            <input id="part_dimensions_width" name="part_dimensions_width" class="form-control here"
                                                type="text" value="{{ old('part_dimensions_width') }}">
                                            @error('part_dimensions_width')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="part_dimensions_depth" class="col-form-label">Part Dimension Depth</label>
                                            <input id="part_dimensions_depth" name="part_dimensions_depth" class="form-control here"
                                                type="text" value="{{ old('part_dimensions_depth') }}">
                                            @error('part_dimensions_depth')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="part_dimension_weight" class="col-form-label">Part Dimension Weight</label>
                                            <input id="part_dimension_weight" name="part_dimension_weight" class="form-control here"
                                                type="text" value="{{ old('part_dimension_weight') }}">
                                            @error('part_dimension_weight')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="edge_banding_lf" class="col-form-label">Edge Banding LF</label>
                                            <input id="edge_banding_lf" name="edge_banding_lf" class="form-control here"
                                                type="text" value="{{ old('edge_banding_lf') }}">
                                            @error('edge_banding_lf')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>



                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <button name="submit" type="submit" class="btn btn-primary btn-lg"
                                                style="background-color:#6466e8;width:100%">Submit</button>
                                        </div>
                                    </div>
                                </form>



                                <div id="responseMessage" style="margin-top: 10px;"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div> <!-- End Content -->
    </div> <!-- End Content Wrapper -->

    <!-- Edit Modal -->

@endsection
@push('script')
    <script>
        $(document).ready(function() {
            // Function to toggle fields based on the selected part type
            function addtoggleFields() {
                var selectedPartType = $('#part_type').val();

                if (selectedPartType === 'Service') {
                    $('#rateField').show();
                    $('#unitCostField').hide();
                } else if (selectedPartType === 'Physical') {
                    $('#rateField').hide();
                    $('#unitCostField').show();
                } else {
                    $('#rateField').hide();
                    $('#unitCostField').hide();
                }
            }

            // Call the function on page load in case there's a pre-selected value
            addtoggleFields();

            // Bind the function to the change event of the part_type dropdown
            $('#part_type').change(function() {
                addtoggleFields();
            });
        });
    </script>




@endpush
