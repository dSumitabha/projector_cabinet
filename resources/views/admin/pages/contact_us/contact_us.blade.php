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
            <h1>Manage Free Quotes</h1>
            <p class="breadcrumbs">
                <span><a href="{{ route('admin.dashboard') }}">Home</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span> Free Quotes
            </p>
        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="ec-cat-list card card-default">
                    <div class="card-body">

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

                        <div class="table-responsive">
                            <table id="responsive-data-table" class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Email</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Projector Make</th>
                                        <th>Projector Model</th>
                                        <th>Channel Brand</th>
                                        <th>Channel Model</th>
                                        <th>Ceiling Height</th>
                                        <th>Screen Size</th>
                                        <th>Screen Type</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contactUs as $index => $quote)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $quote->email }}</td>
                                        <td>{{ $quote->first_name }}</td>
                                        <td>{{ $quote->last_name }}</td>
                                        <td>{{ $quote->projector_make }}</td>
                                        <td>{{ $quote->projector_model }}</td>
                                        <td>{{ $quote->channel_brand }}</td>
                                        <td>{{ $quote->channel_model }}</td>
                                        <td>{{ $quote->ceiling_height }}</td>
                                        <td>{{ $quote->screen_size }}</td>
                                        <td>{{ ucfirst(str_replace('_', ' ', $quote->screen_type)) }}</td>
                                        <td>{{ $quote->created_at->format('Y-m-d H:i:s') }}</td>
                                        <td>
                                            <form action="{{ route('admin.contactus.delete', $quote->id) }}" method="POST" class="deleteForm">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger deleteQuote">Delete</button>
                                            </form>
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

@endsection

@push('script')
<script>
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
