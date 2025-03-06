@extends('admin.layouts.master')
@section('content')

<div class="ec-content-wrapper">
    <div class="content">
        <div class="breadcrumb-wrapper breadcrumb-wrapper-2 breadcrumb-contacts">
            <h1>Update Video Link with Video Description</h1>
            <p class="breadcrumbs">
                <span><a href="{{ route('admin.dashboard') }}">Home</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span> Update Article & Videos Tab Manual
            </p>
        </div>

        <div class="row">
            <!-- Card for Articles and Videos Table -->
            <!-- <div class="col-xl-12 col-lg-12">
                <div class="ec-cat-list card card-default">
                    <div class="card-header">
                        <h5>Articles & Videos</h5>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Type</th>
                                        <th>URL</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td>1</td>
                                        <td>ff</td>
                                        <td>bjhdfbjbf</td>
                                        <td><a href="" target="_blank"></a></td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> -->

            <!-- Card for Form -->
            <div class="col-xl-12 col-lg-12">
                <div class="ec-cat-list card card-default">
                    <div class="card-header">
                        <h5>Upload Video URL & Add Content</h5>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                        @elseif(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <form action="{{ route('admin.products.artical.submit', $product->product_id) }}" method="post" enctype="multipart/form-data">
                            @csrf

                            @php
                            $existingArtical = \App\Models\ProductArtical::where('product_id', $product->product_id)->first();
                            $existingVideos = \App\Models\ProductArticalVideo::where('product_id', $product->product_id)->get();
                            @endphp

                            <div class="mb-3">
                                <label for="description" class="form-label">Artical Description</label>
                                <textarea class="form-control" name="description" rows="3">{{ $existingArtical ? $existingArtical->description : '' }}</textarea>
                                @error('description')
                                <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="url" class="form-label">Add Video URL</label>
                                <div id="url-inputs">
                                    @if ($existingVideos->isNotEmpty())
                                    @foreach ($existingVideos as $video)
                                    <div class="input-group mb-2 existing-url" data-id="{{ $video->id }}">
                                        <input type="url" class="form-control" name="urls[]" value="{{ $video->video_link }}" placeholder="Enter URL" readonly>
                                        <button type="button" class="btn btn-danger remove-url-btn">×</button>
                                    </div>
                                    @endforeach
                                    @endif
                                    <!-- New URL Input -->
                                    <div class="input-group mb-2">
                                        <input type="url" class="form-control" name="urls[]" placeholder="Enter URL">
                                        <button type="button" class="btn btn-success add-url-btn">+</button>
                                    </div>
                                </div>

                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Add New URL
        document.querySelectorAll('.add-url-btn').forEach(button => {
            button.addEventListener('click', function() {
                let newInput = document.createElement('div');
                newInput.classList.add('input-group', 'mb-2');
                newInput.innerHTML = `
                <input type="url" class="form-control" name="urls[]" placeholder="Enter URL">
                <button type="button" class="btn btn-danger remove-url-btn">×</button>
            `;
                document.getElementById('url-inputs').appendChild(newInput);
            });
        });

        // Remove newly added URL inputs
        document.getElementById('url-inputs').addEventListener('click', function(event) {
            if (event.target.classList.contains('remove-url-btn')) {
                let urlDiv = event.target.closest('.input-group');

                // Check if it's an existing URL (has data-id)
                if (urlDiv.classList.contains('existing-url')) {
                    let urlId = urlDiv.getAttribute('data-id');

                    fetch("{{ route('admin.products.artical.deleteUrl') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            },
                            body: JSON.stringify({
                                id: urlId
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                urlDiv.remove();
                            } else {
                                alert("Error deleting URL.");
                            }
                        })
                        .catch(error => console.error("Error:", error));
                } else {
                    urlDiv.remove();
                }
            }
        });
    });
</script>


@endpush
