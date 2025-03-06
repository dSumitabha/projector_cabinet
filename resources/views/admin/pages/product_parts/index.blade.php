@extends('admin.layouts.master')
@section('content')
    <style>
        .text-danger {
            color: red;
        }
    </style>
    <!-- CONTENT WRAPPER -->
    <div class="ec-content-wrapper">
        <div class="content">
            <div class="breadcrumb-wrapper breadcrumb-wrapper-2 breadcrumb-contacts">
                <h1>Product-Parts</h1>
                <p class="breadcrumbs"><span><a href="{{ route('admin.dashboard') }}">Home</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span>Product-Parts
                </p>
            </div>
            <div class="row">
                <div style="text-align: right; margin-bottom: 10px;">
                    <form id ="deleteAllForm" action="{{ route('admin.product_parts.deleteAll') }}" method="POST"
                        style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger alldeletePart"
                            style="border-top-left-radius: 0; border-bottom-left-radius: 0;">Delete All</button>
                    </form>

                </div>
                <div class="col-xl-12 col-lg-12">
                    <div class="ec-cat-list card card-default">
                        <div class="card-body">


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
                            <div class="table-responsive">
                                <table id="responsive-data-table" class="table">
                                    <thead>
                                        <tr>
                                            <th>Sl</th>
                                            <th>Product ID</th>
                                            <th>Part ID</th>
                                            <th>Part / Service Name</th>
                                            <th>Part Type</th>
                                            <th>Rate</th>
                                            <th>Total Hours/Units</th>
                                            <th>Unit Cost</th>
                                            <th>% Used</th>
                                            <th>Total $</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($productParts as $index => $part)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $part->product_id }}</td>
                                                <td>{{ $part->part_id }}</td>
                                                <td>{{ $part->part_name }}</td>
                                                <td>{{ $part->part_type }}</td>
                                                <td>{{ $part->rate ?? 'N/A' }}</td>
                                                <td>{{ $part->total_hours_units ?? 'N/A' }}</td>
                                                <td>{{ $part->unit_cost ?? 'N/A' }}</td>
                                                <td>{{ $part->percentage_used ?? 'N/A' }}</td>
                                                <td>{{ $part->total }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-outline-success editPart"
                                                            data-id="{{ $part->id }}" data-rate="{{ $part->rate }}"
                                                            data-unit-cost="{{ $part->unit_cost }}">Edit</button>

                                                        <form action="{{ route('admin.product_parts.delete', $part->id) }}"
                                                            method="POST" style="display:inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-outline-danger deletePart"
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

    <!-- Edit Part Modal -->
    <div class="modal fade" id="editPartModal" tabindex="-1" aria-labelledby="editPartModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPartModalLabel">Edit Product Part</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger">
                        <li>Rate/Unit Cost can't be editable since it's coming from Part Table.</li>
                        <li>For PHYSICAL Type - Percentage Used is not editable.</li>
                    </div>
                    <div class="mb-3">
                        <label for="edit_rate_or_cost" id="edit_rate_or_cost_label" class="form-label">Rate / Unit
                            Cost</label>
                        <input type="number" id="edit_rate_or_cost" class="form-control" step="1" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="edit_total_hours_units" class="form-label">Total Hours/Units</label>
                        <input type="number" id="edit_total_hours_units" class="form-control" step="1">
                    </div>
                    <div class="mb-3">
                        <label for="edit_percentage_used" class="form-label">Percentage Used</label>
                        <input type="number" id="edit_percentage_used" class="form-control" step="1">
                    </div>

                    <div class="mb-3">
                        <label for="edit_total" class="form-label">Total</label>
                        <input type="number" id="edit_total" class="form-control" step="0.01" readonly>
                    </div>
                    <input type="hidden" id="edit_part_id">
                    @csrf
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="savePartChanges" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            // Handle Edit button click
            $(document).on('click', '.editPart', function() {
                const partId = $(this).data('id');
                const rate = $(this).data('rate');
                const unitCost = $(this).data('unit-cost');

                const row = $(this).closest('tr');
                const totalHoursUnits = row.find('td:eq(6)').text() !== 'N/A' ? parseFloat(row.find(
                    'td:eq(6)').text()) : 0;
                const percentageUsed = row.find('td:eq(8)').text() !== 'N/A' ? parseFloat(row.find(
                    'td:eq(8)').text()) : 100;
                // Parse the rate and unit cost

                // const unitCost = row.data('unit-cost') !== 'N/A' ? parseFloat(row.data('unit-cost')) : null;
                const total = row.find('td:eq(9)').text() !== 'N/A' ? parseFloat(row.find('td:eq(9)')
                    .text()) : 0;

                // Populate modal fields
                $('#edit_total_hours_units').val(totalHoursUnits);
                $('#edit_percentage_used').val(percentageUsed);
                $('#edit_total').val(total.toFixed(2));
                $('#edit_part_id').val(partId);

                // Determine which value to show
                if (rate !== '') {

                    $('#edit_rate_or_cost').val(rate);
                    $('#edit_rate_or_cost_label').text('Rate');
                    $('#edit_percentage_used').prop('readonly', false);
                } else if (unitCost !== '') {

                    $('#edit_rate_or_cost').val(unitCost);
                    $('#edit_rate_or_cost_label').text('Unit Cost');
                    $('#edit_percentage_used').prop('readonly', true); // Make percentage_used read-only
                }

                // Store rate and unit cost in the modal's data attributes for use in calculations
                $('#editPartModal').data('rate', rate);
                $('#editPartModal').data('unit-cost', unitCost);

                // Show the modal
                $('#editPartModal').modal('show');
            });

            // Calculate total based on input values
            function calculateTotal(rate, unitCost) {
                const totalHoursUnits = parseFloat($('#edit_total_hours_units').val()) || 0;
                const percentageUsed = parseFloat($('#edit_percentage_used').val()) || 100;

                let baseValue = 0;

                // Use rate if present, otherwise use unit cost
                if (rate !== null && rate !== 0) {

                    baseValue = rate * totalHoursUnits;
                } else if (unitCost !== null && unitCost !== 0) {

                    baseValue = unitCost * totalHoursUnits;

                } else {
                    baseValue = 0; // Both rate and unit cost are not available
                }

                const total = baseValue * (percentageUsed / 100);
                $('#edit_total').val(total.toFixed(2));
            }

            // Recalculate total when inputs change
            $('#edit_total_hours_units, #edit_percentage_used').on('input', function() {
                const rate = $('#editPartModal').data('rate') || null;
                const unitCost = $('#editPartModal').data('unit-cost') || null;
                calculateTotal(rate, unitCost);
            });

            // Handle Save button click
            $('#savePartChanges').on('click', function() {
                const partId = $('#edit_part_id').val();
                const totalHoursUnits = $('#edit_total_hours_units').val();
                const percentageUsed = $('#edit_percentage_used').val();
                const total = $('#edit_total').val();

                // Use the named route instead of the URL
                const updateUrl = `{{ route('admin.product_parts.update', ['id' => ':id']) }}`.replace(
                    ':id', partId);

                // Perform the AJAX request
                $.ajax({
                    url: updateUrl,
                    method: 'PUT',
                    data: {
                        _token: $('input[name="_token"]').val(),
                        total_hours_units: totalHoursUnits,
                        percentage_used: percentageUsed,
                        total: total
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Data updated successfully.',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            location
                                .reload(); // Reload the page to see the updated data
                        });
                    }
                });
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
