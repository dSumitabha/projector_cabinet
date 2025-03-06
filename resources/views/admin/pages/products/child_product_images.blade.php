@extends('admin.layouts.master')


<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')
    <style>
        .color-input {
            pointer-events: none;
        }
    </style>
    <!-- CONTENT WRAPPER -->
    <div class="ec-content-wrapper">
        <div class="content">
            <div class="breadcrumb-wrapper d-flex align-items-center justify-content-between">
                <div>
                    <h1>Manage Product Images for {{ $product->product_id }}</h1>
                    <p class="breadcrumbs"><span><a href="{{ route('admin.dashboard') }}">Home</a></span>
                        <span><i class="mdi mdi-chevron-right"></i></span>Manage
                    </p>
                </div>
                <div>
                    <a href="javascript:void(0);" class="btn btn-success" id="addMoreImages"> + Add More Images</a>
                </div>
                <div>
                    <a href="javascript:void(0);" class="btn btn-danger" id="deleteAllImages">Delete All Images</a>
                </div>
                <div>
                    <a href="{{ route('admin.products.child_index') }}" class="btn btn-primary"> View All Products
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-4 col-lg-12">
                    <div class="ec-cat-list card card-default mb-24px">
                        <div class="card-body">
                            <div class="ec-cat-form">
                                <h4>Product Overview</h4>

                                <form>

                                    <div class="form-group row">
                                        <label for="text" class="col-12 col-form-label">Parent Product ID</label>
                                        <div class="col-12">
                                            <h6 style="color:blue">{{ $product->parent_product_id }}</h6>

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="text" class="col-12 col-form-label">Product ID</label>
                                        <div class="col-12">
                                            <h6 style="color:blue">{{ $product->product_id }}</h6>

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="text" class="col-12 col-form-label">Product Name</label>
                                        <div class="col-12">
                                            <h6 style="color:blue">{{ $product->product_name }}</h6>

                                        </div>
                                    </div>








                                </form>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-12">
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
                                <table id="responsive-data-table" class="table">
                                    <thead>
                                        <tr>

                                            <th>Image</th>

                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @php
                                            $images = $product->productImages; // Assuming you are retrieving product images from the relationship
                                        @endphp
                                        @foreach ($images as $image)
                                            <tr>
                                                <td>
                                                    @php
                                                        $extension = pathinfo($image->image, PATHINFO_EXTENSION);

                                                    @endphp


                                                    @if (in_array($extension, ['mp4', 'mkv', 'avi', 'gif']))
                                                        <video class="img-responsive" controls style="max-width: 400px;">
                                                            <source
                                                                src="{{ asset('user/uploads/products/images/' . $image->image) }}"
                                                                type="video/{{ $extension }}">
                                                            Your browser does not support the video tag.
                                                        </video>
                                                    @else
                                                        <img class="img-responsive" height="200px"
                                                            src="{{ asset('user/uploads/products/images/' . $image->image) }}"
                                                            alt="Product Image">
                                                    @endif
                                                </td>

                                                <td>
                                                    <div class="btn-group mb-1">
                                                        <button type="button" class="btn btn-outline-warning edit-image"
                                                            data-id="{{ $image->id }}" data-image="{{ $image->image }}"
                                                            style="border-radius: 0 15px 0 15px !important;">Edit</button>
                                                        <button type="button" class="btn btn-outline-danger"
                                                            onclick="confirmDelete('{{ route('admin.products.child_product_images.delete', ['id' => $image->id]) }}')"
                                                            style="border-top-left-radius: 0; border-bottom-left-radius: 0;">Delete
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
        </div> <!-- End Content -->





        <div class="modal fade" id="addImageModal" tabindex="-1" aria-labelledby="addImageModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addImageModalLabel">Add Image for {{ $product->product_id }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="addImageForm" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="image">Choose Image/Video</label>
                                <input type="file" name="images[]" id="image" class="form-control" multiple
                                    accept=".png, .jpg, .jpeg, .webp, .mp4, .mkv, .avi, .gif">
                            </div>

                            <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Edit Image Modal -->
        <div class="modal fade" id="editImageModal" tabindex="-1" aria-labelledby="editImageModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="editImageForm">
                        @csrf
                        <input type="hidden" name="image_id" id="imageId">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editImageModalLabel">Edit Image/Video</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="newImage" class="form-label">Select New Image/Video</label>
                                <input type="file" class="form-control" id="newImage" name="new_image"
                                    accept=".png, .jpg, .jpeg, .webp, .mp4, .mkv, .avi, .gif">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div> <!-- End Content Wrapper -->
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            // Open modal when "Add More Images" button is clicked
            $('#addMoreImages').on('click', function(e) {
                e.preventDefault();
                $('#addImageModal').modal('show');
            });


            // AJAX to submit image upload form
            $('#addImageForm').on('submit', function(e) {
                e.preventDefault();

                // Create a FormData object to hold form data
                let formData = new FormData(this);

                let fileInput = $('#image')[0].files;

                if (fileInput.length === 0) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Please upload an image/video file.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                    return;
                }

                // Set up AJAX with CSRF token
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "{{ route('admin.products.child_product_images.store') }}", // Adjust the route as needed
                    method: "POST",
                    data: formData,
                    contentType: false, // Let jQuery set the content type
                    processData: false, // Prevent jQuery from automatically transforming the data
                    beforeSend: function() {
                        // Show loading indicator
                        Swal.fire({
                            title: 'Uploading...',
                            text: 'Please wait while the files are being uploaded.',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                    },
                    success: function(response) {
                        Swal.close(); // Close the loading dialog

                        if (response.status === 'success') {
                            Swal.fire({
                                title: 'Success!',
                                text: response.message,
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location
                                .reload(); // Reload the page to show the new image/video
                                }
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: response.message,
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.close(); // Close the loading dialog

                        if (xhr.status === 422) { // Validation error
                            let errors = xhr.responseJSON.errors;
                            let errorMessage = '';

                            $.each(errors, function(key, value) {
                                errorMessage += value[0] + '<br>';
                            });

                            Swal.fire({
                                title: 'Validation Error!',
                                html: errorMessage,
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Something went wrong. Please try again later.',
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
        $(document).ready(function() {

            // When the edit button is clicked, show the modal
            $('.edit-image').click(function() {
                let imageId = $(this).data('id');
                $('#imageId').val(imageId);
                $('#editImageModal').modal('show');
            });

            // AJAX form submission
            $('#editImageForm').submit(function(e) {
                e.preventDefault();

                let formData = new FormData(this);

                let fileInput = $('#newImage')[0].files;

                if (fileInput.length === 0) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Please upload an image/video file or enter a YouTube URL.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                    return;
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '{{ route('admin.admin_product_update_image') }}', // Update with your route
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.success) {
                            // Close the modal
                            $('#editImageModal').modal('hide');

                            // Optionally, refresh the page or update the image dynamically
                            Swal.fire({
                                title: 'Success!',
                                text: response.message,
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location
                                        .reload(); // Reload the page when the user clicks "OK"
                                }
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: response.message,
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) { // Validation error status code
                            let errors = xhr.responseJSON.errors;
                            let errorMessage = '';

                            $.each(errors, function(key, value) {
                                errorMessage += value[0] + '<br>';
                            });

                            Swal.fire({
                                title: 'Validation Error!',
                                html: errorMessage, // Use HTML to show line breaks
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Something went wrong. Please try again later.',
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
        document.getElementById("deleteAllImages").addEventListener("click", function() {
            if (confirm("Are you sure you want to delete all images for this product?")) {
                fetch("{{ route('admin.products.child_product_images.deleteAll', ['product_id' => $product->product_id]) }}", {
                        method: "DELETE",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Content-Type": "application/json"
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert("All images have been deleted successfully!");
                            location.reload();
                        } else {
                            alert("Error deleting images. Please try again.");
                        }
                    })
                    .catch(error => console.error("Error:", error));
            }
        });
    </script>
@endpush
