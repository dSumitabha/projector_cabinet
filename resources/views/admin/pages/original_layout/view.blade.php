
@extends('admin.layouts.master')
@section('content')
    <style>
        .text-danger {
            color: red;
        }
    </style>
    <div class="ec-content-wrapper">
        <div class="content">
            <div class="breadcrumb-wrapper breadcrumb-wrapper-2 breadcrumb-contacts">
                <h1>Layout Attachments</h1>
                <p class="breadcrumbs"><span><a href="{{ route('admin.dashboard') }}">Home</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span>Layout Attachments
                </p>
            </div>
            <div class="row">
                {{-- <div style="text-align: right; margin-bottom: 10px;">
                <form id ="deleteAllForm" action="{{ route('admin.product_parts.deleteAll') }}" method="POST"
                    style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger alldeletePart"
                        style="border-top-left-radius: 0; border-bottom-left-radius: 0;">Delete All</button>
                </form>

            </div> --}}
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
                            <a href="{{ route('admin.layout.add') }}" class="btn btn-success mb-5" style="background-color:rgb(11, 212, 11)">
                                <i class="mdi mdi-plus plus-icon"></i> Add Layout Attachment
                            </a>
                            <div class="table-responsive">
                                <table id="responsive-data-table" class="table">
                                    <thead>
                                        <tr>
                                            <th>Sl ID</th>
                                            <th>Layout ID</th>
                                            <th>Grain / No-Grain</th>
                                            <th>Layout Name</th>
                                            <th>File Attachment</th>

                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $index => $value)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $value->layout_id }}</td>
                                                <td>{{ $value->grain_no_grain }}</td>

                                                <td>{{ $value->layout_name ?? 'N/A' }}</td>
                                                <td>
                                                    <a href="{{ $value->file_attachment }}"
                                                        target="_blank">
                                                    {{ $value->file_attachment ?? 'N/A' }}
                                                    </a>
                                                </td>

                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-outline-success editLayout"
                                                        data-id="{{ $value->id }}"
                                                        data-layout-id="{{ $value->layout_id }}"
                                                        data-grain-no-grain="{{ $value->grain_no_grain }}"
                                                        data-layout-name="{{ $value->layout_name }}"
                                                        data-file-attachment="{{ $value->file_attachment }}"
                                                        ">Edit</button>

                                                        <form action="{{ route('admin.layout.delete', $value->id) }}"
                                                            method="POST" style="display:inline-block;" class="deleteForm">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-outline-danger deleteLayout"
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
    </div>
<!-- Edit Layout Modal (Hidden initially) -->
<div class="modal fade" id="editLayoutModal" tabindex="-1" aria-labelledby="editLayoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editlayoutModalLabel">Edit Layout Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editLayoutForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="layout_id" class="form-label">Layout ID</label>
                        <input type="text" class="form-control" id="layout_id" name="layout_id" required>
                    </div>
                    <div class="mb-3">
                        <label for="grain_no_grain" class="form-label">Grain / No Grain</label>
                        <input type="text" class="form-control" id="grain_no_grain" name="grain_no_grain" >
                    </div>
                    <div class="mb-3">
                        <label for="layout_name" class="form-label">Layout Name</label>
                        <input type="text" class="form-control" id="layout_name" name="layout_name">
                    </div>
                    <div class="mb-3">
                        <label for="file_attachment" class="form-label">File Attachment</label>
                        <input type="text" class="form-control" id="file_attachment" name="file_attachment">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    // Open the edit modal and populate the form fields with the current data
    document.querySelectorAll('.editLayout').forEach(button => {
        button.addEventListener('click', function() {
            // Get data attributes from the button (the data set on each Edit button)
            const layoutId = this.getAttribute('data-layout-id');
            const fileName = this.getAttribute('data-layout-name');
            const grainNoGrain = this.getAttribute('data-grain-no-grain');
            const fileAttachment = this.getAttribute('data-file-attachment');
            const id = this.getAttribute('data-id');

            // Set the values in the modal's form fields
            document.getElementById('layout_id').value = layoutId;
            document.getElementById('layout_name').value = fileName || '';
            document.getElementById('grain_no_grain').value = grainNoGrain || '';
            document.getElementById('file_attachment').value = fileAttachment || '';

            // Set the form action to the correct route for updating the entry
            const form = document.getElementById('editLayoutForm');
            form.action = "{{ route('admin.layout.update', ':id') }}".replace(':id', id);

            // Show the modal
            var myModal = new bootstrap.Modal(document.getElementById('editLayoutModal'), {
                keyboard: false
            });
            myModal.show();
        });
    });

    // Handle form submission with SweetAlert confirmation
    document.getElementById('editLayoutForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the form from submitting immediately

        Swal.fire({
            title: 'Are you sure?',
            text: "You want to save these changes?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, save it!',
            cancelButtonText: 'Cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the form if confirmed
                this.submit();
            }
        });
    });
</script>
<script>
    // Listen for form submission to trigger SweetAlert before actually deleting
    document.querySelectorAll('.deleteForm').forEach(form => {
        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the form from submitting immediately

            // Show SweetAlert confirmation dialog
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, submit the form
                    form.submit();
                }
            });
        });
    });
</script>
<script>
    // Listen for form submission to trigger SweetAlert before actually deleting
    document.querySelectorAll('.deleteForm').forEach(form => {
        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the form from submitting immediately

            // Show SweetAlert confirmation dialog
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, submit the form
                    form.submit();
                }
            });
        });
    });
</script>
@endpush
