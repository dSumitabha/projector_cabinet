@extends('admin.layouts.master')
@section('content')
<div class="ec-content-wrapper">
    <div class="content">
        <div class="breadcrumb-wrapper breadcrumb-wrapper-2 breadcrumb-contacts">
            <h1>FAQ</h1>
            <p class="breadcrumbs"><span><a href="{{ route('admin.dashboard') }}">Home</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>FAQ
            </p>
        </div>
        <div class="row">
            <div style="text-align: right; margin-bottom: 10px;">
                <a href="{{ route('admin.faq.add') }}">
                    <button type="button" class="btn btn-outline-success"
                        style="border-top-left-radius: 0; border-bottom-left-radius: 0;">
                        Add New FAQs
                    </button>
                </a>
            </div>
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
                                        <th>Questions</th>
                                        <th>Answers</th>
                                        <th>Type</th> <!-- Added Type Column -->
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($faq as $key => $blog)
                                    <tr>
                                        <td>{{ $key + 1 }}</td> <!-- Serial number -->
                                        <td>{{ $blog->question }}</td>
                                        <td>{!! $blog->answer !!}</td>
                                        <td>
                                            @php
                                                $faqTypes = [
                                                    'general' => 'FAQ Page',
                                                    'product' => 'Product FAQ Page',
                                                    'common' => 'Common (Shown on Both Pages)'
                                                ];
                                            @endphp
                                            {{ $faqTypes[$blog->type] ?? 'Unknown' }} <!-- Display Type Name -->
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.faq.edit', $blog->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                            <form id="delete-form-{{ $blog->id }}" action="{{ route('admin.faq.destroy', $blog->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-danger" onclick="deleteBlog({{ $blog->id }})">Delete</button>
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
    function deleteBlog(blogId) {
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
                document.getElementById('delete-form-' + blogId).submit();
            }
        });
    }
</script>

@endpush


