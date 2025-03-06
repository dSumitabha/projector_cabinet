@extends('admin.layouts.master')
@section('content')
<div class="ec-content-wrapper">
    <div class="content">
        <div class="breadcrumb-wrapper breadcrumb-wrapper-2 breadcrumb-contacts">
            <h1>Sales Rate</h1>
            <p class="breadcrumbs"><span><a href="{{ route('admin.dashboard') }}">Home</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>Sales Rate
            </p>
        </div>

        <div class="row">

            <div class="col-xl-12 col-lg-12">
                <div class="ec-cat-list card card-default">
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
                                        <th>Sales Rate</th>

                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($salesRates  as $index => $rate)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $rate->rate }}</td>

                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-outline-success editRate"
                                                    data-id="{{ $rate->id }}" data-rate="{{ $rate->rate }}"
                                                    data-bs-toggle="modal" data-bs-target="#editModal">
                                                    Edit
                                                </button>

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
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Sales Rate</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    @csrf
                    <input type="hidden" id="editId">
                    <div class="mb-3">
                        <label for="editRate" class="form-label">Rate:</label>
                        <input type="text" name="rate" id="editRate" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Rate</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    $(document).ready(function() {
        // Open modal and populate fields
        $('.editRate').click(function() {
            let id = $(this).data('id');
            let rate = $(this).data('rate');

            $('#editId').val(id);
            $('#editRate').val(rate);
            $('#editModal').modal('show');
        });

        // Handle AJAX form submission
        $('#editForm').submit(function(e) {
            e.preventDefault();
            let id = $('#editId').val();
            let rate = $('#editRate').val();

            // Using the route name to generate the URL
            let url = "{{ route('admin.sales_tax.update', ':id') }}".replace(':id', id);

            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    _method: 'PUT',  // Ensure method is PUT for updating
                    rate: rate
                },
                success: function(response) {
                    $('#editModal').modal('hide');
                    alert('Rate updated successfully!');
                    location.reload(); // Refresh the page to show updated data
                },
                error: function(xhr) {
                    alert('Error updating rate. Please try again.');
                }
            });
        });
    });
    </script>
@endpush
