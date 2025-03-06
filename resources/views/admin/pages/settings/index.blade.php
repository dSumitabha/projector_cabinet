@extends('admin.layouts.master')
@section('content')
    <div class="ec-content-wrapper">
        <div class="content">
            <div class="breadcrumb-wrapper breadcrumb-wrapper-2 breadcrumb-contacts">
                <h1>Update Settings</h1>
                <p class="breadcrumbs"><span><a href="{{ route('admin.dashboard') }}">Home</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span>Update Settings
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

                            <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('POST')

                                <!-- Logo Upload -->
                                <div class="mb-3">
                                    <label for="logo" class="form-label">Logo</label>
                                    <input type="file" class="form-control" name="logo">
                                    @if($logo)
                                        <img src="{{ asset($logo) }}" alt="Logo" class="mt-2" width="400">
                                    @endif
                                </div>

                                <!-- Facebook Link -->
                                <div class="mb-3">
                                    <label for="facebook" class="form-label">Facebook URL</label>
                                    <input type="url" class="form-control" name="facebook" value="{{ old('facebook', $facebook) }}">
                                </div>

                                <!-- YouTube Link -->
                                <div class="mb-3">
                                    <label for="youtube" class="form-label">YouTube URL</label>
                                    <input type="url" class="form-control" name="youtube" value="{{ old('youtube', $youtube) }}">
                                </div>

                                <button type="submit" class="btn btn-primary">Save Settings</button>
                            </form>

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
                        _method: 'PUT', // Ensure method is PUT for updating
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
