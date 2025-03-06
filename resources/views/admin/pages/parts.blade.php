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
                    <div class="ec-cat-list card card-default">
                        <div class="card-body">
                            <div style="text-align: right; margin-bottom: 10px;">
                                <form id ="deleteAllForm" action="{{ route('admin.parts.deleteAll') }}"
                                    method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="btn btn-outline-danger alldeletePart"
                                        style="border-top-left-radius: 0; border-bottom-left-radius: 0;">Delete All</button>
                                </form>

                            </div>
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @elseif(session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <div class="table-responsive">
<style>
    .table{
        color:#0f2961;
    }
</style>
                                <table id="responsive-data-table" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sl</th>
                                            <th>Part ID</th>
                                            <th>Part Category</th>
                                            <th>Part/ Service Name</th>
                                            <th>Source Company</th>
                                            <th>Delivery Time</th>
                                            <th>Part Type</th>
                                            <th>Rate</th>
                                            <th>Batch Cost</th>
                                            <th>Sales Tax</th>
                                            <th>Per Unit Cost</th>
                                            <th>Qty</th>
                                            <th>Available Qty</th>

                                            <th>Part Dimensions Length</th>
                                            <th>Part Dimensions Width</th>
                                            <th>Part Dimensions Depth</th>
                                            <th>Part Dimensions Weight</th>
                                            <th>Edge Banding LF</th>

                                            <th>URL</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($parts as $index => $part)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $part->part_id }}</td>
                                                <td>{{ $part->part_category }}</td>
                                                <td>{{ $part->part_or_service_name }}</td>
                                                <td>{{ $part->source_company }}</td> <!-- New -->
                                                <td>{{ $part->delivery_time }}</td> <!-- New -->
                                                <td>{{ $part->part_type }}</td>
                                                <td>{{ $part->rate }}</td>
                                                <td>{{ $part->batch_cost }}</td>
                                                <td>{{ $part->sales_tax }}</td>
                                                <td>{{ $part->unit_cost }}</td>

                                                <td>{{ $part->qty }}</td> <!-- New -->
                                                <td>{{ $part->available_qty }}</td>
                                                <td>{{ $part->part_dimensions_length }}</td>
                                                <td>{{ $part->part_dimensions_width }}</td>
                                                <td>{{ $part->part_dimensions_depth }}</td>
                                                <td>{{ $part->part_dimension_weight }}</td>
                                                <td>{{ $part->edge_banding_lf }}</td>
                                                <td>
                                                    <a href="{{ $part->url }}"
                                                        target="_blank">{{ $part->url }}</a>
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-outline-success editPart"
                                                            data-id="{{ $part->id }}">Edit</button>
                                                        <form action="{{ route('admin.parts.delete', $part->id) }}"
                                                            method="POST" style="display:inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-outline-danger deletePart"
                                                                style="border-top-left-radius: 0; border-bottom-left-radius: 0;">Delete</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- End Content -->
    </div> <!-- End Content Wrapper -->

    <!-- Edit Modal -->
    <div class="modal fade" id="editPartModal" tabindex="-1" role="dialog" aria-labelledby="editPartModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPartModalLabel">Edit Part</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editPartForm">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="edit_part_id" class="col-12 col-form-label">Part ID</label>
                            <div class="col-12">
                                <input id="edit_part_id" name="part_id" class="form-control here" type="text"
                                    required>
                                <span class="text-danger" id="edit_part_id_error"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="edit_part_category" class="col-12 col-form-label">Part Category</label>
                            <div class="col-12">
                                <input id="edit_part_category" name="part_category" class="form-control here" type="text"
                                    required>
                                <span class="text-danger" id="edit_part_category_error"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="edit_part_or_service_name" class="col-12 col-form-label">Part or Service Name</label>
                            <div class="col-12">
                                <input id="edit_part_or_service_name" name="part_or_service_name" class="form-control here" type="text"
                                    required>
                                <span class="text-danger" id="edit_part_or_service_name_error"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="edit_source_company" class="col-12 col-form-label">Source Company</label>
                            <div class="col-12">
                                <input id="edit_source_company" name="source_company" class="form-control here"
                                    type="text">
                                <span class="text-danger" id="edit_source_company_error"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="edit_batch_cost" class="col-12 col-form-label">Batch Cost</label>
                            <div class="col-12">
                                <input id="edit_batch_cost" name="batch_cost" class="form-control here"
                                    type="text">
                                <span class="text-danger" id="edit_batch_cost_error"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="edit_sales_tax" class="col-12 col-form-label">Sales Tax</label>
                            <div class="col-12">
                                <input id="edit_sales_tax" name="sales_tax" class="form-control here"
                                    type="text">
                                <span class="text-danger" id="edit_sales_tax_error"></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="edit_lead_time" class="col-12 col-form-label">Delivery Time</label>
                            <div class="col-12">
                                <input id="edit_lead_time" name="lead_time" class="form-control here" type="number"
                                    step="1">
                                <span class="text-danger" id="edit_lead_time_error"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="edit_part_type" class="col-12 col-form-label">Part Type</label>
                            <div class="col-12">
                                <select id="edit_part_type" name="part_type" class="form-control here" required>
                                    <option value="" disabled>Select Part Type</option>
                                    <option value="Service">Service</option>
                                    <option value="Physical">Physical</option>
                                </select>
                                <span class="text-danger" id="edit_part_type_error"></span>
                            </div>
                        </div>
                        <div class="form-group row" id="edit_rateField">
                            <label for="edit_rate" class="col-12 col-form-label">Rate</label>
                            <div class="col-12">
                                <input id="edit_rate" name="rate" class="form-control here" type="number" step="0.01" min="0">
                                <span class="text-danger" id="edit_rate_error"></span>
                            </div>
                        </div>
                        <div class="form-group row" id="edit_unitCostField">
                            <label for="edit_unit_cost" class="col-12 col-form-label">Unit Cost</label>
                            <div class="col-12">
                                <input id="edit_unit_cost" name="unit_cost" class="form-control here" type="number" step="0.01" min="0">
                                <span class="text-danger" id="edit_unit_cost_error"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="edit_url" class="col-12 col-form-label">url</label>
                            <div class="col-12">
                                <input id="edit_url" name="url" class="form-control here" type="text">
                                <span class="text-danger" id="edit_url_error"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="edit_qty" class="col-12 col-form-label">Quantity</label>
                            <div class="col-12">
                                <input id="edit_qty" name="qty" class="form-control here" type="number"
                                    step="1">
                                <span class="text-danger" id="edit_qty_error"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="edit_available_qty" class="col-12 col-form-label">Available Qty</label>
                            <div class="col-12">
                                <input id="edit_available_qty" name="available_qty" class="form-control here"
                                    type="number">
                                <span class="text-danger" id="edit_available_qty_error"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="edit_part_dimensions_length" class="col-12 col-form-label">Part Dimensions Length</label>
                            <div class="col-12">
                                <input id="edit_part_dimensions_length" name="part_dimensions_length" class="form-control here"
                                    type="text">
                                <span class="text-danger" id="edit_part_dimensions_length_error"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="edit_part_dimensions_width" class="col-12 col-form-label">Part Dimensions Width</label>
                            <div class="col-12">
                                <input id="edit_part_dimensions_width" name="part_dimensions_width" class="form-control here"
                                    type="text">
                                <span class="text-danger" id="edit_part_dimensions_width_error"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="edit_part_dimensions_depth" class="col-12 col-form-label">Part Dimensions Depth</label>
                            <div class="col-12">
                                <input id="edit_part_dimensions_depth" name="part_dimensions_depth" class="form-control here"
                                    type="text">
                                <span class="text-danger" id="edit_part_dimensions_depth_error"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="edit_part_dimension_weight" class="col-12 col-form-label">Part Dimensions Weight</label>
                            <div class="col-12">
                                <input id="edit_part_dimension_weight" name="part_dimension_weight" class="form-control here"
                                    type="text">
                                <span class="text-danger" id="edit_part_dimension_weight_error"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="edit_edge_banding_lf" class="col-12 col-form-label">Edge Banding LF</label>
                            <div class="col-12">
                                <input id="edit_edge_banding_lf" name="edge_banding_lf" class="form-control here"
                                    type="text">
                                <span class="text-danger" id="edit_edge_banding_lf_error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close-modal-btn"
                            data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
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
    <script>
        $(document).ready(function() {
            // Close modal on clicking the close button
            $('.close-modal-btn').on('click', function() {
                $('#editPartModal').modal('hide');
            });

            // Close modal on clicking the close symbol
            $('.modal-header .close').on('click', function() {
                $('#editPartModal').modal('hide');
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            const partTypeSelect = document.getElementById('part_type');
            const rateField = document.getElementById('rateField');
            const unitCostField = document.getElementById('unitCostField');

            function toggleFields() {
                if (partTypeSelect.value === 'Service') {
                    rateField.style.display = 'block';
                    unitCostField.style.display = 'none';
                } else if (partTypeSelect.value === 'Physical') {
                    rateField.style.display = 'none';
                    unitCostField.style.display = 'block';
                } else {
                    rateField.style.display = 'none';
                    unitCostField.style.display = 'none';
                }
            }

            partTypeSelect.addEventListener('change', toggleFields);

            // Call toggleFields initially in case the form is repopulated with old input
            toggleFields();
        });
    </script>
    <script>
        var editPartUrl = "{{ route('admin.parts.edit', ['part' => '__ID__']) }}";
    </script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.editPart', function() {
                let Id = $(this).data('id');

                $('#editPartForm').attr('data-id', Id);
                $.ajax({
                    url: editPartUrl.replace('__ID__', Id), // Replace placeholder with actual ID
                    method: 'GET',
                    success: function(response) {
                        $('#edit_part_id').val(response.part.part_id);
                        $('#edit_part_category').val(response.part.part_category);
                        $('#edit_part_or_service_name').val(response.part.part_or_service_name);
                        $('#edit_part_type').val(response.part.part_type);
                        $('#edit_rate').val(response.part.rate);
                        $('#edit_unit_cost').val(response.part.unit_cost);
                        $('#edit_url').val(response.part.url);
                        $('#edit_sales_tax').val(response.part.sales_tax);
                        $('#edit_batch_cost').val(response.part.batch_cost);
                        $('#edit_available_qty').val(response.part.available_qty);
                        $('#edit_source_company').val(response.part
                            .source_company); // New field
                        $('#edit_lead_time').val(response.part.delivery_time); // New field
                        $('#edit_qty').val(response.part.qty); // New field
                        $('#edit_part_dimensions_length').val(response.part.part_dimensions_length); // New field
                        $('#edit_part_dimensions_width').val(response.part.part_dimensions_width); // New field
                        $('#edit_part_dimensions_depth').val(response.part.part_dimensions_depth); // New field
                        $('#edit_part_dimension_weight').val(response.part.part_dimension_weight); // New field
                        $('#edit_edge_banding_lf').val(response.part.edge_banding_lf); // New field

                        if (response.part.part_type === 'Service') {
                            $('#edit_rateField').show();
                            $('#edit_unitCostField').hide();
                        } else if (response.part.part_type === 'Physical') {
                            $('#edit_rateField').hide();
                            $('#edit_unitCostField').show();
                        }

                        $('#editPartModal').modal('show');
                    }
                });
            });

            $('#edit_part_type').on('change', function() {
                if ($(this).val() === 'Service') {
                    $('#edit_rateField').show();
                    $('#edit_unitCostField').hide();
                } else if ($(this).val() === 'Physical') {
                    $('#edit_rateField').hide();
                    $('#edit_unitCostField').show();
                } else {
                    $('#edit_rateField').hide();
                    $('#edit_unitCostField').hide();
                }
            });
        });
    </script>
   <script>
    var updatePartUrl = "{{ route('admin.parts.update', ['part' => '__ID__']) }}";
</script>
    <script>
        $('#editPartForm').on('submit', function(e) {
            e.preventDefault();

            let Id = $(this).attr('data-id');

            let formData = $(this).serialize();

            $.ajax({
                url: updatePartUrl.replace('__ID__', Id), // Replace placeholder with actual ID
                method: 'PUT',
                data: formData,
                headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Required for Laravel
    },
                success: function(response) {
                    $('#editPartModal').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Part updated successfully!',
                    }).then(function() {
                        location.reload();
                    });
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON.errors;
                    $('#edit_part_id_error').text(errors.part_id ? errors.part_id[0] : '');
                    $('#edit_part_category_error').text(errors.part_category ? errors.part_category[0] : '');
                    $('#edit_part_or_service_name_error').text(errors.part_or_service_name ? errors.part_or_service_name[0] : '');
                    $('#edit_part_type_error').text(errors.part_type ? errors.part_type[0] : '');
                    $('#edit_rate_error').text(errors.rate ? errors.rate[0] : '');
                    $('#edit_unit_cost_error').text(errors.unit_cost ? errors.unit_cost[0] : '');
                    $('#edit_url_error').text(errors.url ? errors.url[0] : '');
                    $('#edit_part_dimensions_length_error').text(errors.url ? errors.part_dimensions_length[0] : '');
                    $('#edit_part_dimensions_width_error').text(errors.url ? errors.part_dimensions_width[0] : '');
                    $('#edit_part_dimensions_depth_error').text(errors.url ? errors.part_dimensions_depth[0] : '');
                    $('#edit_part_dimension_weight_error').text(errors.url ? errors.part_dimension_weight[0] : '');
                    $('#edit_edge_banding_lf_error').text(errors.url ? errors.edge_banding_lf[0] : '');
                    $('#edit_available_qty_error').text(errors.available_qty ? errors
                        .available_qty[0] : '');
                    // New fields
                    $('#edit_source_company_error').text(errors.source_company ? errors.source_company[
                        0] : '');
                    $('#edit_lead_time_error').text(errors.lead_time ? errors.lead_time[0] : '');
                    $('#edit_qty_error').text(errors.qty ? errors.qty[0] : '');
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.deletePart');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function(event) {
                    // Prevent the default form submission
                    event.preventDefault();

                    const form = this.closest(
                        'form'); // Get the form associated with the clicked button

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit(); // Submit the form only if the user confirms
                        }
                    });
                });
            });
        });

        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
            });
        @endif
    </script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>

<script>
    document.querySelector('.alldeletePart').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the form from submitting immediately

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete all!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteAllForm').submit(); // Submit the form
            }
        });
    });
</script>
@endpush
