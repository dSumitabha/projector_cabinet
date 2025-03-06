@extends('admin.layouts.master')
@section('content')
<div class="ec-content-wrapper">
    <div class="content">
        <div class="breadcrumb-wrapper breadcrumb-wrapper-2 breadcrumb-contacts">
            <h1>Update Product Tab Description</h1>
            <p class="breadcrumbs"><span><a href="{{ route('admin.dashboard') }}">Home</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>Update Product Tab Description
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

                        <form action="{{ route('admin.products.description.submit', $product->product_id) }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="image" class="form-label">Upload PDF</label>
                                <input type="file" class="form-control" name="image" accept="application/pdf">

                                <!-- Validation Error Message -->
                                @error('image')
                                <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>

                        @if (!empty($product_description) && !empty($product_description->pdf))
                <div class="mb-3">
                    <label class="form-label">Existing Description Manual</label>
                    <embed src="{{ asset($product_description->pdf) }}" type="application/pdf" width="100%" height="600px" />
                    <p>
                        If the PDF does not load,
                        <a href="{{ asset($product_description->pdf) }}" target="_blank">click here to download it</a>.
                    </p>
                </div>
            @endif

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

</script>
@endpush
