@extends('admin.layouts.master')
@section('content')
    <style>
        .text-danger {
            color: red !important;
        }
    </style>
    <!-- PAGE WRAPPER -->


    <div class="content">
        <div class="breadcrumb-wrapper d-flex align-items-center justify-content-between">
            <div>
                <h1>Edit Product-Parts</h1>
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
            <div class="col-12">
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom">
                        <h2>Edit Product-Parts</h2>
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
                                    <form id="editProductPartForm" class="row g-3"
                                        action="{{ route('admin.product_parts.update', $part->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <!-- Product ID field -->
                                        <div class="mb-3">
                                            <label for="product_id" class="form-label">Product ID</label>
                                            <input type="text" id="product_id" name="product_id" class="form-control"
                                                value="{{ $part->product_id }}" required>
                                            <div class="invalid-feedback">Product ID is required.</div>
                                        </div>

                                        <!-- Part ID field -->
                                        <div class="mb-3">
                                            <label for="part_id" class="form-label">Part ID</label>
                                            <input type="text" id="part_id" name="part_id" class="form-control"
                                                value="{{ $part->part_id }}" required>
                                            <div class="invalid-feedback">Part ID is required.</div>
                                        </div>

                                        <!-- Part Name field -->
                                        <div class="mb-3">
                                            <label for="part_name" class="form-label">Part Name</label>
                                            <input type="text" id="part_name" name="part_name" class="form-control"
                                                value="{{ $part->part_name }}" required>
                                        </div>

                                        <!-- Part Type field -->
                                        <div class="mb-3">
                                            <label for="part_type" class="form-label">Part Type</label>
                                            <input type="text" id="part_type" name="part_type" class="form-control"
                                                value="{{ $part->part_type }}" required>
                                        </div>

                                        <!-- Rate field -->
                                        <div class="mb-3">
                                            <label for="rate" class="form-label">Rate</label>
                                            <input type="number" id="rate" name="rate" class="form-control"
                                                value="{{ $part->rate }}" step="0.01">
                                        </div>

                                        <!-- Unit Cost field -->
                                        <div class="mb-3">
                                            <label for="unit_cost" class="form-label">Unit Cost</label>
                                            <input type="number" id="unit_cost" name="unit_cost" class="form-control"
                                                value="{{ $part->unit_cost }}" step="0.01">
                                        </div>

                                        <!-- Total Hours/Units field -->
                                        <div class="mb-3">
                                            <label for="total_hours_units" class="form-label">Total Hours/Units</label>
                                            <input type="number" id="total_hours_units" name="total_hours_units"
                                                class="form-control" step="0.01" value="{{ $part->total_hours_units }}">
                                        </div>

                                        <!-- Percentage Used field -->
                                        <div class="mb-3">
                                            <label for="percentage_used" class="form-label">Percentage Used</label>
                                            <input type="number" id="percentage_used" name="percentage_used"
                                                class="form-control" step="0.01" alue="{{ $part->percentage_used }}">
                                        </div>

                                        <!-- Total field -->
                                        <div class="mb-3">
                                            <label for="total" class="form-label">Total</label>
                                            <input type="number" id="total" name="total" class="form-control"
                                                step="0.01" alue="{{ $part->total }}">
                                        </div>

                                        <!-- Submit button -->
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary">Update</button>
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
                        url: '/part-details',
                        type: 'GET',
                        data: {
                            part_id: partId
                        },
                        success: function(part) {
                            row.find('input[name$="[part_name]"]').val(part.part_name);
                            row.find('input[name$="[part_type]"]').val(part.part_type);

                            if (part.part_type === 'Physical') {
                                row.find('input[name$="[rate]"]').val('N/A');
                                row.find('input[name$="[unit_cost]"]').val(part.unit_cost);
                            } else if (part.part_type === 'Service') {
                                row.find('input[name$="[rate]"]').val(part.rate);
                                row.find('input[name$="[unit_cost]"]').val('N/A');
                            } else {
                                row.find('input[name$="[rate]"], input[name$="[unit_cost]"]').val('');
                            }

                            // Set read-only status based on part_type
                            row.find('input[name$="[rate]"]').prop('readonly', part.part_type ===
                                'Physical');
                            row.find('input[name$="[unit_cost]"]').prop('readonly', part.part_type ===
                                'Service');

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
                newRow.find('input').each(function() {
                    const name = $(this).attr('name').replace(/\d+/, rowIndex);
                    $(this).attr('name', name).val('').prop('readonly', false);
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
