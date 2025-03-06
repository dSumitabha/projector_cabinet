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
                <h1>Product Assemble Parts</h1>
                <p class="breadcrumbs"><span><a href="{{ route('admin.dashboard') }}">Home</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span>Product Assemble Parts
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
                            <a href="{{ route('admin.assemble.add') }}" class="btn btn-success mb-5" style="background-color:rgb(11, 212, 11)">
                                <i class="mdi mdi-plus plus-icon"></i> Add Product Assemble Parts
                            </a>
                            <div class="table-responsive">
                                <table id="responsive-data-table" class="table">
                                    <thead>
                                        <tr>
                                            <th>Sl ID</th>
                                            <th>Assembly Part ID</th>
                                            <th>Part Id</th>
                                            <th>Part Dimensions</th>
                                            {{-- <th>Product Id</th> --}}
                                            <th>Packaging Product Id</th>
                                            <th>Package S No</th>
                                            <th>Package Dimension</th>
                                            <th>Layer</th>


                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $index => $value)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $value->assembly_part_id }}</td>

                                                <td>{{ $value->part_id ?? 'N/A' }}</td>
                                                <td>
                                                    @php
                                                        $part = \App\Models\Part::where('part_id', $value->part_id)->first();
                                                    @endphp
                                                    @if ($part)
                                                    <button type="button" class="btn btn-primary view-part-details"
                                                    data-id="{{ $part->id }}"
                                                    data-length="{{ $part->part_dimensions_length }}"
                                                    data-width="{{ $part->part_dimensions_width }}"
                                                    data-depth="{{ $part->part_dimensions_depth }}"
                                                    data-weight="{{ $part->part_dimension_weight }}"
                                                    data-bs-toggle="modal" data-bs-target="#partDetailsModal">
                                                View Part Dimensions
                                            </button>
                                                    @else
                                                        <span class="text-danger">{{ $value->part_id }} not present in Part Table</span>
                                                    @endif
                                                </td>
                                                {{-- <td>{{ $value->product_id ?? 'N/A' }}</td> --}}
                                                <td>{{ $value->packaging_product_id ?? 'N/A' }}</td>
                                                <td>{{ $value->package_s_no ?? 'N/A' }}</td>
                                                <td>
                                                    @php
                                                        $package = \App\Models\PackageProduct::where('packaging_product_id', $value->packaging_product_id)->where('package_s_no',$value->package_s_no)->first();
                                                    @endphp
                                                    @if ($package)
                                                    <button type="button" class="btn btn-info view-package-details"
                                                    data-id="{{ $package->id }}"
                                                    data-length="{{ $package->length_of_package }}"
                                                    data-width="{{ $package->width_of_package }}"
                                                    data-depth="{{ $package->depth_of_package }}"
                                                    data-weight="{{ $package->weight_of_package }}"
                                                    data-bs-toggle="modal" data-bs-target="#packageDetailsModal">
                                                View Package Dimensions
                                            </button>
                                                    @else
                                                        <span class="text-danger">Package - {{ $value->packaging_product_id }} under {{$value->package_s_no  }} not present in Product Package Table</span>
                                                    @endif
                                                </td>
                                                <td>{{ $value->qty ?? 'N/A' }}</td>


                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-outline-success editAssemble"
                                                        data-id="{{ $value->id }}"
                                                        data-assembly-part-id="{{ $value->assembly_part_id }}"
                                                        data-part-id="{{ $value->part_id }}"
                                                        data-product-id="{{ $value->product_id }}"
                                                        data-packaging-product-id="{{ $value->packaging_product_id }}"
                                                        data-package-s-no="{{ $value->package_s_no }}"
                                                        data-qty="{{ $value->qty }}"
                                                      >Edit</button>

                                                        <form action="{{ route('admin.assemble.delete', $value->id) }}"
                                                            method="POST" style="display:inline-block;" class="deleteForm">
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
    </div>
    <!-- Part Details Modal -->
    <div class="modal fade" id="partDetailsModal" tabindex="-1" aria-labelledby="partDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="partDetailsModalLabel">Part Dimensions</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Attribute</th>
                                <th>Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Length</strong></td>
                                <td id="partLength">N/A</td>
                            </tr>
                            <tr>
                                <td><strong>Width</strong></td>
                                <td id="partWidth">N/A</td>
                            </tr>
                            <tr>
                                <td><strong>Depth</strong></td>
                                <td id="partDepth">N/A</td>
                            </tr>
                            <tr>
                                <td><strong>Weight in lb</strong></td>
                                <td id="partWeight">N/A</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Package Details Modal -->
    <div class="modal fade" id="packageDetailsModal" tabindex="-1" aria-labelledby="packDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="partDetailsModalLabel">Package Dimensions</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Attribute</th>
                                <th>Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Length</strong></td>
                                <td id="packageLength">N/A</td>
                            </tr>
                            <tr>
                                <td><strong>Width</strong></td>
                                <td id="packageWidth">N/A</td>
                            </tr>
                            <tr>
                                <td><strong>Depth</strong></td>
                                <td id="packageDepth">N/A</td>
                            </tr>
                            <tr>
                                <td><strong>Weight in lb</strong></td>
                                <td id="packageWeight">N/A</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<!-- Edit Fusion Modal (Hidden initially) -->
<div class="modal fade" id="editAssembleModal" tabindex="-1" aria-labelledby="editAssembleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAssembleModalLabel">Edit Assemble Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editAssembleForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="assembly_part_id" class="form-label">Assembly Part ID</label>
                        <input type="text" class="form-control" id="assembly_part_id" name="assembly_part_id" required>
                    </div>
                    <div class="mb-3">
                        <label for="part_id" class="form-label">Part Id</label>
                        <input type="text" class="form-control" id="part_id" name="part_id" required>
                    </div>
                    {{-- <div class="mb-3">
                        <label for="product_id" class="form-label">Product Id</label>
                        <input type="text" class="form-control" id="product_id" name="product_id" required>
                    </div> --}}
                    <div class="mb-3">
                        <label for="packaging_product_id" class="form-label">Packaging Product Id</label>
                        <input type="text" class="form-control" id="packaging_product_id" name="packaging_product_id">
                    </div>
                    <div class="mb-3">
                        <label for="package_s_no" class="form-label">Package S No</label>
                        <input type="text" class="form-control" id="package_s_no" name="package_s_no">
                    </div>

                    <div class="mb-3">
                        <label for="qty" class="form-label">Layer</label>
                        <input type="text" class="form-control" id="qty" name="qty">
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
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".view-part-details").forEach(function(button) {
            button.addEventListener("click", function() {
                document.getElementById("partLength").textContent = this.dataset.length || "N/A";
                document.getElementById("partWidth").textContent = this.dataset.width || "N/A";
                document.getElementById("partDepth").textContent = this.dataset.depth || "N/A";
                document.getElementById("partWeight").textContent = this.dataset.weight || "N/A";
            });
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".view-package-details").forEach(function(button) {
            button.addEventListener("click", function() {
                document.getElementById("packageLength").textContent = this.dataset.length || "N/A";
                document.getElementById("packageWidth").textContent = this.dataset.width || "N/A";
                document.getElementById("packageDepth").textContent = this.dataset.depth || "N/A";
                document.getElementById("partWeight").textContent = this.dataset.weight || "N/A";
            });
        });
    });
</script>
<script>
    // Open the edit modal and populate the form fields with the current data
    document.querySelectorAll('.editAssemble').forEach(button => {
        button.addEventListener('click', function() {
            // Get data attributes from the button (the data set on each Edit button)
            const assemblyPartId = this.getAttribute('data-assembly-part-id');
            const partId = this.getAttribute('data-part-id');
            const productId = this.getAttribute('data-product-id');
            const packagingProductId = this.getAttribute('data-packaging-product-id');
            const packageSNo = this.getAttribute('data-package-s-no');
            const qty = this.getAttribute('data-qty');
            const id = this.getAttribute('data-id');

            // Set the values in the modal's form fields
            document.getElementById('assembly_part_id').value = assemblyPartId;
            document.getElementById('part_id').value = partId;
            // document.getElementById('product_id').value = productId || '';
            document.getElementById('packaging_product_id').value = packagingProductId || '';
            document.getElementById('package_s_no').value = packageSNo || '';
            document.getElementById('qty').value = qty || '';

            // Set the form action to the correct route for updating the entry
            const form = document.getElementById('editAssembleForm');
            form.action = "{{ route('admin.assemble.update', ':id') }}".replace(':id', id);

            // Show the modal
            var myModal = new bootstrap.Modal(document.getElementById('editAssembleModal'), {
                keyboard: false
            });
            myModal.show();
        });
    });

    // Handle form submission with SweetAlert confirmation
    document.getElementById('editAssembleForm').addEventListener('submit', function(event) {
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
