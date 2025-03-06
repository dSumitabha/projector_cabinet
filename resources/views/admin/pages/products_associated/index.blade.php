@extends('admin.layouts.master')
@section('content')
    <!-- CONTENT WRAPPER -->

    <div class="content">
        <div class="breadcrumb-wrapper d-flex align-items-center justify-content-between">
            <div>
                <h1>Product Association</h1>
                <p class="breadcrumbs"><span><a href="{{ route('admin.dashboard') }}">Home</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span>Product Association
                </p>
            </div>
            <div>
                <a href="{{ route('admin.products_associated.add') }}" class="btn btn-primary"> Add New Product
                    Association</a>
            </div>
        </div>
        <div class="row">
            <div style="text-align: right; margin-bottom: 10px;">
                <form id ="deleteAllForm" action="{{ route('admin.product_associated.deleteAll') }}" method="POST"
                    style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger alldeleteProductAssociated"
                        style="border-top-left-radius: 0; border-bottom-left-radius: 0;">Delete All</button>
                </form>

            </div>
            <div class="col-12">
                <div class="card card-default">
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

                        {{-- Display Success Message --}}
                        @if (session()->has('import_success'))
                            <div class="alert alert-success">
                                {{ session()->get('import_success') }}
                            </div>
                        @endif

                        <style>
                            .table {
                                color: #0f2961;
                            }
                        </style>
                        <div class="table-responsive" style="max-height: 500px; overflow-y: auto; border: 1px solid #ddd;">
                            <table id="responsive-data-table" class="table table-striped" style="width:100%">
                                <thead style="position: sticky; top: 0; background: white; z-index: 2;">
                                    <tr>
                                        <th>Simulation ID</th>
                                        <th>Simulation Images</th>
                                        <th>Projector Make</th>
                                        <th>Projector Model</th>
                                        <th>Screen Size</th>
                                        <th>Ceiling Height</th>
                                        <th>Center Channel Height</th>
                                        <th>Simulated Center Channel</th>
                                        <th>Slot from Bottom (Center Channel)</th>
                                        <th>Slot from Bottom (Projector)</th>
                                        <th>Center Channel Tilt slot(Front or Back)</th>
                                        <th>Center Channel Tilt rod length</th>
                                        <th>Center Channel L Clamp Position</th>
                                        <th>Distance of Cabinet from Screen</th>
                                        <th>Slot from Bottom (Floor Raising)</th>
                                        <th>Distance of Projector from Screen</th>
                                        <th>Viewing Angle (Sitting)</th>
                                        <th>Viewing Angle (Reclining)</th>
                                        <th>Hearing Angle</th>
                                        <th>Hearing Angle (Reclining)</th>
                                        <th>Distance of Top Section of the Screen from Ceiling</th>
                                        <th>Distance of Bottom Section of the Screen from Floor</th>
                                        <th>Distance of Cabinet from Wall</th>

                                        <th>Max Center Channel Height</th>
                                        <th>Max Center Channel Length</th>
                                        <th>Max Allowed Center Channel Depth</th>
                                        <th>Center Channel Flag</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($products as $productAssociate)
                                        <tr>
                                            <td>{{ $productAssociate->parent_product_id ?? 'NULL' }}</td>
                                            <td>
                                                <button type="button" class="btn btn-outline-primary add-images"
                                                    data-id="{{ $productAssociate->id }}"
                                                    data-product="{{ json_encode($productAssociate) }}"
                                                    data-bs-toggle="modal" data-bs-target="#addImagesModal">
                                                    Add Images
                                                </button>

                                                <button type="button" class="btn btn-outline-info view-images"
                                                    data-id="{{ $productAssociate->parent_product_id }}"
                                                    data-product="{{ json_encode($productAssociate) }}"
                                                    data-bs-toggle="modal" data-bs-target="#viewImagesModal">
                                                    View Images
                                                </button>
                                            </td>
                                            <td>{{ $productAssociate->projector_make ?? 'NULL' }}</td>
                                            <td>{{ $productAssociate->projector_model ?? 'NULL' }}</td>
                                            <td>{{ $productAssociate->screen_size ?? 'NULL' }}</td>
                                            <td>{{ $productAssociate->ceiling_height ?? 'NULL' }}</td>
                                            <td>{{ $productAssociate->center_channel_height ?? 'NULL' }}</td>
                                            <td>{{ $productAssociate->simulated_center_channel ?? 'NULL' }}</td>
                                            <td>{{ $productAssociate->center_channel_slot_from_bottom ?? 'NULL' }}</td>
                                            <td>{{ $productAssociate->projector_platform_slot_from_bottom ?? 'NULL' }}</td>
                                            <td>{{ $productAssociate->center_channel_tilt_slot ?? 'NULL' }}</td>
                                            <td>{{ $productAssociate->center_channel_tilt_rod_lenth ?? 'NULL' }}</td>
                                            <td>{{ $productAssociate->center_channel_l_clamp_position ?? 'NULL' }}</td>
                                            <td>{{ $productAssociate->distance_of_cabinet_from_screen ?? 'NULL' }}</td>
                                            <td>{{ $productAssociate->floor_raising_slot_from_bottom ?? 'NULL' }}</td>
                                            <td>{{ $productAssociate->distance_of_projector_from_screen ?? 'NULL' }}</td>
                                            <td>{{ $productAssociate->viewing_angle_sitting ?? 'NULL' }}</td>
                                            <td>{{ $productAssociate->viewing_angle_reclining ?? 'NULL' }}</td>
                                            <td>{{ $productAssociate->hearing_angle ?? 'NULL' }}</td>
                                            <td>{{ $productAssociate->hearing_angle_reclining ?? 'NULL' }}</td>
                                            <td>{{ $productAssociate->distance_of_top_section_of_screen_from_ceiling ?? 'NULL' }}
                                            </td>
                                            <td>{{ $productAssociate->distance_of_bottom_section_of_the_screen_from_floor ?? 'NULL' }}
                                            </td>
                                            <td>{{ $productAssociate->distance_of_floor_raising_screen_from_wall ?? 'NULL' }}
                                            </td>

                                            <td>{{ $productAssociate->max_center_channel_height ?? 'NULL' }}</td>
                                            <td>{{ $productAssociate->max_center_channel_length ?? 'NULL' }}</td>
                                            <td>{{ $productAssociate->max_allowed_center_channel_depth ?? 'NULL' }}</td>
                                            <td>{{ $productAssociate->center_channel_flag ?? 'NULL' }}</td>
                                            <td>
                                                <div class="btn-group mb-1">
                                                    <button type="button" class="btn btn-outline-success edit-product"
                                                        data-id="{{ $productAssociate->id }}"
                                                        data-product="{{ json_encode($productAssociate) }}"
                                                        data-bs-toggle="modal" data-bs-target="#editProductModal">Edit
                                                    </button>

                                                    <button type="button" class="btn btn-outline-danger"
                                                        onclick="confirmDelete('{{ route('admin.products_associated.delete', ['id' => $productAssociate->id]) }}')"
                                                        style="border-top-left-radius: 0; border-bottom-left-radius: 0;">Delete
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- Edit Product Modal -->
                            <div class="modal fade" id="editProductModal" tabindex="-1"
                                aria-labelledby="editProductModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form id="editProductForm" class="row g-3 p-3">
                                            <!-- Hidden field for product ID -->
                                            <input type="hidden" id="id" name="id">
                                            <!-- Parent Product ID and Name -->
                                            <div class="col-md-6 mt-3">
                                                <label for="parent_product_id" class="form-label">Parent Product ID
                                                    <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="parent_product_id"
                                                    name="parent_product_id">
                                                <div class="invalid-feedback mb-3"></div>
                                            </div>

                                            <!-- Projector Brand and Model -->
                                            <div class="col-md-6 mt-3">
                                                <label for="edit_projector_make" class="form-label">Projector Brand <span
                                                        class="text-danger">*</span></label>
                                                <select name="projector_make" id="projector_make" class="form-select">
                                                    <option value="" selected disabled>Select Projector Brand</option>
                                                    @foreach ($uniqueMakes as $make)
                                                        <option value="{{ $make->make }}">{{ $make->make }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback mb-3"></div>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <label for="edit_projector_model" class="form-label">Projector Model <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="projector_model"
                                                    name="projector_model">
                                                <div class="invalid-feedback mb-3"></div>
                                            </div>
                                            <!-- Other Fields -->
                                            <div class="col-md-6 mt-3">
                                                <label for="projector_platform_slot_from_bottom" class="form-label">Slot
                                                    from Bottom (Projector Platform)</label>
                                                <input type="text" class="form-control"
                                                    id="projector_platform_slot_from_bottom"
                                                    name="projector_platform_slot_from_bottom">
                                                <div class="invalid-feedback mb-3"></div>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <label for="center_channel_tilt_slot" class="form-label">Center Channel
                                                    Tilt Slot</label>
                                                <input type="text" class="form-control" id="center_channel_tilt_slot"
                                                    name="center_channel_tilt_slot">
                                                <div class="invalid-feedback mb-3"></div>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <label for="center_channel_tilt_rod_lenth" class="form-label">Center
                                                    Channel Tilt Rod Length</label>
                                                <input type="text" class="form-control"
                                                    id="center_channel_tilt_rod_lenth"
                                                    name="center_channel_tilt_rod_lenth">
                                                <div class="invalid-feedback mb-3"></div>
                                            </div>
                                            <div class="col-md-6 mt-3 mb-3">
                                                <label for="center_channel_l_clamp_position" class="form-label">Center
                                                    Channel L-Clamp Position</label>
                                                <input type="text" class="form-control"
                                                    id="center_channel_l_clamp_position"
                                                    name="center_channel_l_clamp_position">
                                                <div class="invalid-feedback mb-3"></div>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <label for="center_channel_slot_from_bottom" class="form-label">Slot from
                                                    Bottom (Center Channel)</label>
                                                <input type="text" class="form-control"
                                                    id="center_channel_slot_from_bottom"
                                                    name="center_channel_slot_from_bottom">
                                                <div class="invalid-feedback mb-3"></div>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <label for="floor_raising_slot_from_bottom" class="form-label">Slot from
                                                    Bottom (Floor Raising)</label>
                                                <input type="text" class="form-control"
                                                    id="floor_raising_slot_from_bottom"
                                                    name="floor_raising_slot_from_bottom">
                                                <div class="invalid-feedback mb-3"></div>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <label for="edit_screen_size" class="form-label">Screen Size <span
                                                        class="text-danger">*</span></label>
                                                <input type="number" class="form-control" id="screen_size"
                                                    name="screen_size">
                                                <div class="invalid-feedback mb-3"></div>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <label for="ceiling_height" class="form-label">Ceiling Height</label>
                                                <input type="text" class="form-control" id="ceiling_height"
                                                    name="ceiling_height">
                                                <div class="invalid-feedback mb-3"></div>
                                            </div>
                                            <div class="col-md-6 mt-3 mb-3">
                                                <label for="center_channel_height" class="form-label">Center Channel
                                                    Height</label>
                                                <input type="text" class="form-control" id="center_channel_height"
                                                    name="center_channel_height">
                                                <div class="invalid-feedback mb-3"></div>
                                            </div>

                                            <div class="col-md-6 mt-3 mb-3">
                                                <label for="simulated_center_channel" class="form-label">Simulated Center
                                                    Channel</label>
                                                <input type="text" class="form-control" id="simulated_center_channel"
                                                    name="simulated_center_channel">
                                                <div class="invalid-feedback mb-3"></div>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <label for="distance_of_cabinet_from_screen" class="form-label">Distance
                                                    of Cabinet from Screen</label>
                                                <input type="text" class="form-control"
                                                    id="distance_of_cabinet_from_screen"
                                                    name="distance_of_cabinet_from_screen">
                                                <div class="invalid-feedback mb-3"></div>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <label for="distance_of_projector_from_screen" class="form-label">Distance
                                                    of Projector from Screen</label>
                                                <input type="text" class="form-control"
                                                    id="distance_of_projector_from_screen"
                                                    name="distance_of_projector_from_screen">
                                                <div class="invalid-feedback mb-3"></div>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <label for="distance_of_top_section_of_screen_from_ceiling"
                                                    class="form-label">Distance of Top Section of the Screen from
                                                    Ceiling</label>
                                                <input type="text" class="form-control"
                                                    id="distance_of_top_section_of_screen_from_ceiling"
                                                    name="distance_of_top_section_of_screen_from_ceiling">
                                                <div class="invalid-feedback mb-3"></div>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <label for="distance_of_bottom_section_of_the_screen_from_floor"
                                                    class="form-label">Distance of Bottom Section of the Screen from
                                                    Floor</label>
                                                <input type="text" class="form-control"
                                                    id="distance_of_bottom_section_of_the_screen_from_floor"
                                                    name="distance_of_bottom_section_of_the_screen_from_floor">
                                                <div class="invalid-feedback mb-3"></div>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <label for="distance_of_floor_raising_screen_from_wall"
                                                    class="form-label">Distance of Cabinet from wall</label>
                                                <input type="text" class="form-control"
                                                    id="distance_of_floor_raising_screen_from_wall"
                                                    name="distance_of_floor_raising_screen_from_wall">
                                                <div class="invalid-feedback mb-3"></div>
                                            </div>



                                            <div class="col-md-6 mt-3 mb-3">
                                                <label for="max_center_channel_height" class="form-label">Max Center
                                                    Channel Height</label>
                                                <input type="text" class="form-control" id="max_center_channel_height"
                                                    name="max_center_channel_height">
                                                <div class="invalid-feedback mb-3"></div>
                                            </div>
                                            <div class="col-md-6 mt-3 mb-3">
                                                <label for="max_center_channel_length" class="form-label">Max Center
                                                    Channel Length</label>
                                                <input type="text" class="form-control" id="max_center_channel_length"
                                                    name="max_center_channel_length">
                                                <div class="invalid-feedback mb-3"></div>
                                            </div>

                                            <div class="col-md-6 mt-3 mb-3">
                                                <label for="max_allowed_center_channel_depth" class="form-label">Max
                                                    Allowed Center Channel Depth</label>
                                                <input type="text" class="form-control"
                                                    id="max_allowed_center_channel_depth"
                                                    name="max_allowed_center_channel_depth">
                                                <div class="invalid-feedback mb-3"></div>
                                            </div>

                                            <div class="col-md-6 mt-3 mb-3">
                                                <label for="center_channel_flag" class="form-label">Center Channel
                                                    Flag</label>
                                                <input type="text" class="form-control" id="center_channel_flag"
                                                    name="center_channel_flag">
                                                <div class="invalid-feedback mb-3"></div>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <label for="viewing_angle_sitting" class="form-label">Viewing Angle
                                                    (Sitting)</label>
                                                <input type="text" class="form-control" id="viewing_angle_sitting"
                                                    name="viewing_angle_sitting">
                                                <div class="invalid-feedback mb-3"></div>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <label for="viewing_angle_reclining" class="form-label">Viewing Angle
                                                    (Reclining)</label>
                                                <input type="text" class="form-control" id="viewing_angle_reclining"
                                                    name="viewing_angle_reclining">
                                                <div class="invalid-feedback mb-3"></div>
                                            </div>
                                            <div class="col-md-6 mt-3 mb-3">
                                                <label for="edit_hearing_angle" class="form-label">Hearing Angle</label>
                                                <input type="text" class="form-control" id="hearing_angle"
                                                    name="hearing_angle">
                                                <div class="invalid-feedback mb-3"></div>
                                            </div>
                                            <div class="col-md-6 mt-3 mb-3">
                                                <label for="edit_hearing_angle_reclining" class="form-label">Hearing Angle
                                                    Reclining</label>
                                                <input type="text" class="form-control" id="hearing_angle_reclining"
                                                    name="hearing_angle_reclining">
                                                <div class="invalid-feedback mb-3"></div>
                                            </div>
                                            <!-- Modal Footer -->
                                            <div class="col-md-12">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="addImagesModal" tabindex="-1"
                                aria-labelledby="addImagesModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Add Simulation Images</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('admin.simulation_images.store') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <input type="hidden" name="parent_product_id"
                                                    id="modal_parent_product_id">
                                                <input type="hidden" name="projector_make" id="modal_projector_make">
                                                <input type="hidden" name="screen_size" id="modal_screen_size">
                                                <input type="hidden" name="ceiling_height" id="modal_ceiling_height">
                                                <input type="hidden" name="center_channel_height"
                                                    id="modal_center_channel_height">

                                                <label for="images">Upload Images</label>
                                                <input type="file" name="images[]" id="images"
                                                    class="form-control" multiple required>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Upload</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="viewImagesModal" tabindex="-1"
                                aria-labelledby="viewImagesModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Simulation Images</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Image</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="imageTableBody">
                                                    <tr>
                                                        <td colspan="3" class="text-center">No images found.</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Content -->
@endsection
@push('script')
    <script>
        $('.add-images').on('click', function() {
            let product = $(this).data('product');
            $('#modal_parent_product_id').val(product.parent_product_id);
            $('#modal_projector_make').val(product.projector_make);
            $('#modal_screen_size').val(product.screen_size);
            $('#modal_ceiling_height').val(product.ceiling_height);
            $('#modal_center_channel_height').val(product.center_channel_height);
        });
    </script>
    <script>
        $('.view-images').on('click', function() {
            let product = $(this).data('product');

            $.ajax({
                url: "{{ route('admin.simulation_images.fetch') }}",
                method: "GET",
                data: {
                    parent_product_id: product.parent_product_id,
                    projector_make: product.projector_make,
                    screen_size: product.screen_size,
                    ceiling_height: product.ceiling_height,
                    center_channel_height: product.center_channel_height
                },
                success: function(response) {
                    let tbody = $('#imageTableBody');
                    tbody.empty();
                    if (response.length > 0) {
                        response.forEach((image) => {
                            tbody.append(`
                <tr>
                    <td>${image.id}</td>
                    <td><img src="${image.image_url}" width="100%"></td>
                    <td>
                        <input type="file" class="form-control d-none edit-image-input" data-id="${image.id}">
                        <button class="btn btn-primary edit-image m-3" data-id="${image.id}">
                            Edit
                        </button>
                        <button class="btn btn-success save-image d-none m-3" data-id="${image.id}">
                            Save
                        </button>
                        <button class="btn btn-danger delete-image" data-id="${image.id}">
                            Delete
                        </button>
                    </td>
                </tr>
            `);
                        });
                    } else {
                        tbody.append(
                            `<tr><td colspan="3" class="text-center">No images found.</td></tr>`);
                    }
                }
            });
        });
        // Show file input when clicking "Edit"
$(document).on('click', '.edit-image', function() {
    let imageId = $(this).data('id');
    let row = $(this).closest('tr');
    row.find('.edit-image-input').removeClass('d-none');
    row.find('.save-image').removeClass('d-none');
    $(this).addClass('d-none'); // Hide Edit button
});

// Handle image update
$(document).on('click', '.save-image', function() {
    let imageId = $(this).data('id');
    let row = $(this).closest('tr');
    let fileInput = row.find('.edit-image-input')[0];

    if (fileInput.files.length === 0) {
        alert('Please select an image to upload.');
        return;
    }

    let formData = new FormData();
    formData.append('image', fileInput.files[0]);
    formData.append('_token', "{{ csrf_token() }}");

    $.ajax({
        url: "{{ route('admin.simulation_images.update', ['id' => '__ID__']) }}".replace('__ID__', imageId),
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            alert(response.message);
            row.find('.edit-image').removeClass('d-none'); // Show Edit button
            row.find('.save-image').addClass('d-none'); // Hide Save button
            row.find('.edit-image-input').addClass('d-none'); // Hide file input
            row.find('img').attr('src', response.image_url); // Update image preview
        }
    });
});
        $(document).on('click', '.delete-image', function() {
            let imageId = $(this).data('id');
            if (confirm("Are you sure you want to delete this image?")) {
                $.ajax({
                    url: "{{ route('admin.simulation_images.delete', ['id' => '__ID__']) }}".replace(
                        '__ID__', imageId),
                    method: "DELETE",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        alert(response.message);
                        location.reload();
                        $('.view-images').trigger('click'); // Refresh images
                    }
                });
            }
        });
    </script>



    <script>
        $(document).ready(function() {
            $(document).on('click', '.edit-product', function() {
                var productData = $(this).data('product');
                var id = $(this).data('id');

                // Populate your modal form with productData
                $('#editProductModal #id').val(id);
                $('#editProductModal #parent_product_id').val(productData.parent_product_id);

                $('#editProductModal #projector_make').val(productData.projector_make);
                $('#editProductModal #projector_model').val(productData.projector_model);
                $('#editProductModal #projector_platform_slot_from_bottom').val(productData
                    .projector_platform_slot_from_bottom);
                $('#editProductModal #center_channel_tilt_slot').val(productData
                    .center_channel_tilt_slot);
                $('#editProductModal #center_channel_tilt_rod_lenth').val(productData
                    .center_channel_tilt_rod_lenth);

                $('#editProductModal #center_channel_slot_from_bottom').val(productData
                    .center_channel_slot_from_bottom);
                $('#editProductModal #floor_raising_slot_from_bottom').val(productData
                    .floor_raising_slot_from_bottom);
                $('#editProductModal #screen_size').val(productData.screen_size);
                $('#editProductModal #ceiling_height').val(productData.ceiling_height);
                $('#editProductModal #distance_of_cabinet_from_screen').val(productData
                    .distance_of_cabinet_from_screen);
                $('#editProductModal #distance_of_projector_from_screen').val(productData
                    .distance_of_projector_from_screen);
                $('#editProductModal #distance_of_top_section_of_screen_from_ceiling').val(productData
                    .distance_of_top_section_of_screen_from_ceiling);
                $('#editProductModal #distance_of_bottom_section_of_the_screen_from_floor').val(productData
                    .distance_of_bottom_section_of_the_screen_from_floor);
                $('#editProductModal #distance_of_floor_raising_screen_from_wall').val(productData
                    .distance_of_floor_raising_screen_from_wall);

                $('#editProductModal #viewing_angle_sitting').val(productData
                    .viewing_angle_sitting);
                $('#editProductModal #viewing_angle_reclining').val(productData.viewing_angle_reclining);
                $('#editProductModal #hearing_angle').val(productData.hearing_angle);
                $('#editProductModal #hearing_angle_reclining').val(productData.hearing_angle_reclining);
                $('#editProductModal #center_channel_height').val(productData.center_channel_height);
                $('#editProductModal #simulated_center_channel').val(productData.simulated_center_channel);
                $('#editProductModal #center_channel_l_clamp_position').val(productData
                    .center_channel_l_clamp_position);
                $('#editProductModal #max_center_channel_height').val(productData
                    .max_center_channel_height);
                $('#editProductModal #max_center_channel_length').val(productData
                    .max_center_channel_length);
                $('#editProductModal #max_allowed_center_channel_depth').val(productData
                    .max_allowed_center_channel_depth);
                $('#editProductModal #center_channel_flag').val(productData.center_channel_flag);
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            $('#editProductForm').on('submit', function(e) {
                e.preventDefault();

                let form = $(this);
                let url = '{{ route('admin.products_associated.update') }}';
                var csrfToken = '{{ csrf_token() }}';
                $.ajax({
                    url: url,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    data: form.serialize(),
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                title: 'Success!',
                                text: 'Record updated successfully.',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Close the modal
                                    $('#editProductModal').modal('hide');
                                    // Optionally, reload the page or update the product list
                                    location.reload();
                                }
                            });
                        }
                    },
                    error: function(xhr) {
                        // Handle validation errors
                        if (xhr.status === 404) {
                            // Product not found
                            Swal.fire({
                                title: 'Error!',
                                text: 'Record not found.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        } else if (xhr.status === 422) {
                            // Validation errors
                            let errors = xhr.responseJSON.errors;
                            if (errors) {
                                $.each(errors, function(key, value) {
                                    // Find the field with the corresponding name attribute
                                    let field = form.find('[name="' + key + '"]');
                                    field.addClass('is-invalid');
                                    field.next('.invalid-feedback').text(value[0]);
                                });
                            }
                        } else {
                            // Other errors
                            Swal.fire({
                                title: 'Error!',
                                text: 'An unexpected error occurred. Please try again.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    }
                });
            });
        });
    </script>

    <script>
        function confirmDelete(deleteUrl) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this data!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If user confirms, redirect to the delete URL
                    window.location.href = deleteUrl;
                }
            });
        }
    </script>
    <script>
        document.querySelector('.alldeleteProductAssociated').addEventListener('click', function(event) {
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
