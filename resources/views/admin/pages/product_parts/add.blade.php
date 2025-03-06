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

        ul {

            padding-left: 20px;
        }

        li {
            margin-bottom: 5px;
        }
    </style>
    <!-- PAGE WRAPPER -->


    <div class="content">
        <div class="breadcrumb-wrapper d-flex align-items-center justify-content-between">
            <div>
                <h1>Add Product-Parts</h1>
                <p class="breadcrumbs"><span><a href="{{ route('admin.dashboard') }}">Home</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span>Product-Parts
                </p>
            </div>
            <div>
                <a href="{{ route('admin.product_parts.index') }}" class="btn btn-primary"> View All Product-Parts
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="ec-cat-list card card-default mb-24px">
                    <div class="card-body">
                        <div class="ec-cat-form" id="projectorForm">

                            <div class="d-flex justify-content-between align-items-center">
                                <h4>Add Product Parts - By Import</h4>
                                <!-- Button to download Excel format -->
                                <a href="{{ route('admin.product_parts.download-format') }}" class="btn btn-outline-success">
                                    <i class="mdi mdi-download"></i> Download Excel Format
                                </a>
                            </div>
                            <div class="instruction-box">
                                <ul>
                                    <li style="color:#04064d"><b>Please Note :</b></li>
                                    <li>Ensure that the <strong>Product ID</strong> is <span class="text-danger">present in the Product table</span>.</li>
                                    <li>If the <strong>Total Hours/Units</strong> field is left blank, it will default to <span class="text-danger">1</span>.</li>
                                    <li>If the <strong>Percentage Used</strong> field is left blank, it will default to <span class="text-danger">100%</span>.</li>
                                    <li>Maintain the proper format of the Excel sheet, and <span class="text-danger">never alter the column headers</span>.</li>
                                </ul>

                            </div>
                            <hr />
                          
                            @if (session('import_error'))
                                <div class="alert alert-danger">
                                    {{ session('import_error') }}
                                </div>
                            @endif
                            @if (session('validationErrors'))
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach (session('validationErrors') as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @elseif(session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <form action="{{ route('admin.product_parts.import') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="file" class="col-form-label">Import Product Parts</label>
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
                        <h2>Add Product-Parts Dynamically</h2>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @elseif(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <div class="row ec-vendor-uploads">
                            <div class="col-lg-12">
                                <div class="ec-vendor-upload-detail">
                                    <form id="addProductPartForm" action="{{ route('admin.product_parts.store') }}"
                                        method="POST" class="row g-3">
                                        @csrf
                                        <div class="col-md-6">
                                            <label for="product_id" class="form-label">Product ID <span
                                                    class="text-danger">*</span></label>
                                            <select name="product_id" id="product_id" class="form-select">
                                                <option value="">Select Product ID</option>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->product_id }}">{{ $product->product_id }} -
                                                        {{ $product->product_name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback mb-3"></div>
                                        </div>

                                        <table id="partsTable" class="table">
                                            <thead>
                                                <tr>
                                                    <th>Part ID</th>
                                                    <th>Part / Service Name</th>
                                                    <th>Part Type</th>
                                                    <th>Rate</th>
                                                    <th>Unit Cost</th>
                                                    <th>Total No of Hours/Units</th>
                                                    <th>% Used</th>
                                                    <th>Total</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="part-row">
                                                    <td>
                                                        <select name="parts[0][part_id]" class="form-select part_id">
                                                            <option value="">Select Part ID</option>
                                                            @foreach ($parts as $part)
                                                                <option value="{{ $part->part_id }}">{{ $part->part_id }}
                                                                    -
                                                                    {{ $part->part_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td><input type="text" class="form-control"
                                                            name="parts[0][part_name]" readonly></td>
                                                    <td><input type="text" class="form-control"
                                                            name="parts[0][part_type]" readonly></td>
                                                    <td><input type="number" class="form-control rate"
                                                            name="parts[0][rate]" step="1" readonly></td>
                                                    <td><input type="number" class="form-control unit_cost"
                                                            name="parts[0][unit_cost]" step="1" readonly></td>
                                                    <td><input type="number" class="form-control"
                                                            name="parts[0][total_hours_units]" step="1"></td>
                                                    <td><input type="number" class="form-control"
                                                            name="parts[0][percentage_used]" step="1"></td>
                                                    <td><input type="number" class="form-control" name="parts[0][total]"
                                                            step="1" readonly></td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger remove-row"> <i
                                                                class="mdi mdi-delete"></i></button>
                                                    </td>
                                                </tr>

                                            </tbody>

                                        </table>
                                        <div id="form-error-message" class="text-danger mt-3 mb-4"></div>
                                        <div class="col-md-12">
                                            <button type="button" class="btn btn-secondary" id="addMore">Add
                                                More</button>
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
            let rowIndex = 1; // Initialize row index for new rows

            // Function to handle part details fetching
            function fetchPartDetails(partId, row) {
                if (partId) {
                    $.ajax({
                        url: "{{ route('admin.part-details') }}",
                        type: 'GET',
                        data: {
                            part_id: partId
                        },
                        success: function(part) {
                            row.find('input[name$="[part_name]"]').val(part.part_name);
                            row.find('input[name$="[part_type]"]').val(part.part_type);
                            row.find('input[name$="[rate]"]').val(part.rate);
                            row.find('input[name$="[unit_cost]"]').val(part.unit_cost);





                            // Ensure all cells are visible
                            row.find('td').show();
                        },
                        error: function(xhr) {
                            alert('Failed to fetch part details.');
                        }
                    });
                } else {
                    row.find('input').val('');
                    row.find('td').show(); // Show all fields if no part_id
                }
            }

            // Calculate total based on changes in relevant fields
            function calculateTotal(row) {
                const rate = row.find('input[name$="[rate]"]').val();
                const unitCost = row.find('input[name$="[unit_cost]"]').val();
                const totalHoursUnits = parseFloat(row.find('input[name$="[total_hours_units]"]').val()) || 0;
                const percentageUsed = parseFloat(row.find('input[name$="[percentage_used]"]').val()) ||
                    100; // Default to 100 if not provided

                let baseValue = 0;

                // Use rate if present, otherwise use unit cost if present
                if (rate && rate !== 'N/A') {
                    baseValue = parseFloat(rate) * totalHoursUnits;
                } else if (unitCost && unitCost !== 'N/A') {
                    baseValue = parseFloat(unitCost) * totalHoursUnits;
                }

                const total = baseValue * (percentageUsed / 100);
                row.find('input[name$="[total]"]').val(total.toFixed(2));
            }

            // Handle change event for part_id dropdown
            $(document).on('change', '.part_id', function() {
                const partId = $(this).val();
                const row = $(this).closest('tr');
                fetchPartDetails(partId, row);
            });

            // Handle change event for calculation fields
            $(document).on('change',
                'input[name$="[rate]"], input[name$="[unit_cost]"], input[name$="[total_hours_units]"], input[name$="[percentage_used]"]',
                function() {
                    const row = $(this).closest('tr');
                    calculateTotal(row);
                });

            // Add More button click event
            $('#addMore').click(function() {
                let isValid = true;
                $('#partsTable tbody tr').each(function() {
                    const partId = $(this).find('select[name$="[part_id]"]').val();
                    const totalHoursUnits = $(this).find('input[name$="[total_hours_units]"]')
                        .val();
                    if (!partId) {
                        $(this).find('select[name$="[part_id]"]').addClass('is-invalid');
                        isValid = false;
                    } else {
                        $(this).find('select[name$="[part_id]"]').removeClass('is-invalid');
                    }
                    if (!totalHoursUnits) {
                        $(this).find('input[name$="[total_hours_units]"]').addClass('is-invalid');
                        isValid = false;
                    } else {
                        $(this).find('input[name$="[total_hours_units]"]').removeClass(
                            'is-invalid');
                    }
                });

                if (!isValid) {
                    $('#form-error-message').text(
                        'Please fill "Part Id" and  "Total Number of Hours/Units" fields before adding more rows.'
                    );
                    return;
                } else {
                    $('#form-error-message').text('');
                }

                const newRow = $('#partsTable tbody tr:first').clone();
                rowIndex++;
                newRow.find('select').each(function() {
                    const name = $(this).attr('name').replace(/\d+/, rowIndex);
                    $(this).attr('name', name).val('');
                });
                // Modify the inputs to set all as readonly except for 'total_hours_units' and 'percentage_used'
                newRow.find('input').each(function() {
                    const name = $(this).attr('name').replace(/\d+/, rowIndex);
                    $(this).attr('name', name).val('');

                    // Only make fields readonly that aren't 'total_hours_units' or 'percentage_used'
                    if (!name.includes('[total_hours_units]') && !name.includes(
                            '[percentage_used]')) {
                        $(this).prop('readonly', true);
                    }
                });

                newRow.find('td').show(); // Ensure all cells are visible
                newRow.appendTo('#partsTable tbody');
            });

            // Remove row button click event
            $(document).on('click', '.remove-row', function() {
                $(this).closest('tr').remove();
            });
        });
    </script>

    <script>
        // Handle form submission
        $('#addProductPartForm').on('submit', function(event) {
            let isValid = true;

            // Validate Product ID
            const productId = $('#product_id').val();
            if (!productId) {
                $('#product_id').addClass('is-invalid');
                isValid = false;
            } else {
                $('#product_id').removeClass('is-invalid');
            }

            // Validate Part ID and Total Number of Hours/Units
            $('#partsTable tbody tr').each(function() {
                const partId = $(this).find('select[name$="[part_id]"]').val();
                const totalHoursUnits = $(this).find('input[name$="[total_hours_units]"]').val();
                if (!partId) {
                    $(this).find('select[name$="[part_id]"]').addClass('is-invalid');
                    isValid = false;
                } else {
                    $(this).find('select[name$="[part_id]"]').removeClass('is-invalid');
                }
                if (!totalHoursUnits) {
                    $(this).find('input[name$="[total_hours_units]"]').addClass('is-invalid');
                    isValid = false;
                } else {
                    $(this).find('input[name$="[total_hours_units]"]').removeClass('is-invalid');
                }
            });

            if (!isValid) {
                $('#form-error-message').text('Please fill all required fields.');
                event.preventDefault(); // Prevent form submission
            }
        });
    </script>
@endpush
