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
                <h1>Product-Packaging</h1>
                <p class="breadcrumbs"><span><a href="{{ route('admin.dashboard') }}">Home</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span>Product-Packaging
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
                            <div class="table-responsive">
                                <table id="responsive-data-table" class="table">
                                    <thead>
                                        <tr>
                                            <th>Sl</th>
                                            <th>Packaging Product ID</th>
                                            <th>Package S No</th>
                                            <th>Length of Package</th>
                                            <th>Width of Package</th>
                                            <th>Depth of Package</th>
                                            <th>Weight of Package</th>

                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($parts as $index => $part)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $part->packaging_product_id }}</td>
                                                <td>{{ $part->package_s_no }}</td>
                                                <td>{{ $part->length_of_package ?? 'N/A' }}</td>
                                                <td>{{ $part->width_of_package ?? 'N/A' }}</td>
                                                <td>{{ $part->depth_of_package ?? 'N/A' }}</td>
                                                <td>{{ $part->weight_of_package ?? 'N/A' }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-outline-success editPackage"
                                                        data-id="{{ $part->id }}"
                                                        data-package-id="{{ $part->packaging_product_id }}"
                                                        data-package-s-no="{{ $part->package_s_no }}"
                                                        data-length="{{ $part->length_of_package }}"
                                                        data-width="{{ $part->width_of_package }}"
                                                        data-depth="{{ $part->depth_of_package }}"
                                                        data-weight="{{ $part->weight_of_package }}"

                                                        ">Edit</button>

                                                        <form action="{{ route('admin.package.delete', $part->id) }}"
                                                            method="POST" style="display:inline-block;" class="deleteForm">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-outline-danger deletePackage"
                                                                style="border-top-left-radius: 0; border-bottom-left-radius: 0;">Delete</button>
                                                        </form>
                                                    </div>
                                                </td>
                                                {{-- <td>
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
                                                </td> --}}
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
    <div class="modal fade" id="editPackageModal" tabindex="-1" aria-labelledby="editPackageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editpackageModalLabel">Edit Package Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editPackageForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="packaging_product_id" class="form-label">Packaging Product ID</label>
                            <input type="text" class="form-control" id="packaging_product_id" name="packaging_product_id" required>
                        </div>
                        <div class="mb-3">
                            <label for="package_s_no" class="form-label">Package S No</label>
                            <input type="text" class="form-control" id="package_s_no" name="package_s_no" >
                        </div>
                        <div class="mb-3">
                            <label for="length_of_package" class="form-label">Length of Package</label>
                            <input type="text" class="form-control" id="length_of_package" name="length_of_package">
                        </div>
                        <div class="mb-3">
                            <label for="width_of_package" class="form-label">Width of Package</label>
                            <input type="text" class="form-control" id="width_of_package" name="width_of_package">
                        </div>
                        <div class="mb-3">
                            <label for="depth_of_package" class="form-label">Depth of Package</label>
                            <input type="text" class="form-control" id="depth_of_package" name="depth_of_package">
                        </div>
                        <div class="mb-3">
                            <label for="weight_of_package" class="form-label">Weight Of Package</label>
                            <input type="text" class="form-control" id="weight_of_package" name="weight_of_package">
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
    document.querySelectorAll('.editPackage').forEach(button => {
        button.addEventListener('click', function() {
            // Get data attributes from the button (the data set on each Edit button)
            const packageId = this.getAttribute('data-package-id');
            const packageSNo = this.getAttribute('data-package-s-no');
            const length = this.getAttribute('data-length');
            const width = this.getAttribute('data-width');
            const depth = this.getAttribute('data-depth');
            const weight = this.getAttribute('data-weight');
            const id = this.getAttribute('data-id');

            // Set the values in the modal's form fields
            document.getElementById('packaging_product_id').value = packageId;
            document.getElementById('package_s_no').value = packageSNo || '';
            document.getElementById('length_of_package').value = length || '';
            document.getElementById('width_of_package').value = width || '';
            document.getElementById('depth_of_package').value = depth || '';
            document.getElementById('weight_of_package').value = weight || '';

            // Set the form action to the correct route for updating the entry
            const form = document.getElementById('editPackageForm');
            form.action = "{{ route('admin.package.update', ':id') }}".replace(':id', id);

            // Show the modal
            var myModal = new bootstrap.Modal(document.getElementById('editPackageModal'), {
                keyboard: false
            });
            myModal.show();
        });
    });

    // Handle form submission with SweetAlert confirmation
    document.getElementById('editPackageForm').addEventListener('submit', function(event) {
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
@endpush

