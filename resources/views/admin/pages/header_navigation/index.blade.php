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
            <h1>Manage Header Navigation</h1>
            <p class="breadcrumbs"><span><a href="{{ route('admin.dashboard') }}">Home</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>Manage Header Navigation
            </p>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="ec-cat-list card card-default">
                    <div class="card-body">

                        <!-- Display validation errors -->
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
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

                        <a href="{{ route('admin.header.navigation.add') }}" class="btn btn-success mb-5" style="background-color:rgb(11, 212, 11)">
                            <i class="mdi mdi-plus plus-icon"></i> Add New Navigation
                        </a>
                        
                        <div class="table-responsive">
                            <table id="responsive-data-table" class="table">
                                <thead>
                                    <tr>
                                        <th>Sl ID</th>
                                        <th>First Header</th>
                                        
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($navigation as $index => $banner)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $banner->title }}</td> <!-- This is the title of the navigation -->
                                       <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-outline-success editBanner"
                                                    data-id="{{ $banner->id }}"
                                                    data-first-header="{{ $banner->title }}">Edit</button>

                                                <form action="{{ route('admin.header.navigation.destroy', $banner->id) }}"
                                                    method="POST" style="display:inline-block;" class="deleteForm">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger deleteBanner"
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

<!-- Edit Banner Modal (Hidden initially) -->
<div class="modal fade" id="editBannerModal" tabindex="-1" aria-labelledby="editBannerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBannerModalLabel">Edit Header Navigation Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editBannerForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="title" class="form-label">Header Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" required>
                        @error('title')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Update Navigation</button>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection

@push('script')
<script>
    // Open the edit modal and populate the form fields with the current data
    document.querySelectorAll('.editBanner').forEach(button => {
        button.addEventListener('click', function() {
            const firstHeader = this.getAttribute('data-first-header');
            const id = this.getAttribute('data-id');

            document.getElementById('title').value = firstHeader || '';

            const form = document.getElementById('editBannerForm');
            form.action = "{{ route('admin.header.navigation.update', ':id') }}".replace(':id', id);

            const myModal = new bootstrap.Modal(document.getElementById('editBannerModal'), {
                keyboard: false
            });
            myModal.show();
        });
    });

    // Handle form submission with SweetAlert confirmation
    document.getElementById('editBannerForm').addEventListener('submit', function(event) {
        event.preventDefault();

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
                this.submit();
            }
        });
    });

    // Handle delete confirmation with SweetAlert
    document.querySelectorAll('.deleteForm').forEach(form => {
        form.addEventListener('submit', function(event) {
            event.preventDefault();

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
                    form.submit();
                }
            });
        });
    });
</script>
@endpush
