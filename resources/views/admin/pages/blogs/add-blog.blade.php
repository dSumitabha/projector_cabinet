@extends('admin.layouts.master')
@section('content')
<style>
    .text-danger {
        margin-left:10px;
        color: red !important;
    }
    </style>
    <div class="content">
        <div class="breadcrumb-wrapper breadcrumb-wrapper-2 breadcrumb-contacts">
            <h1>Add Blog Content</h1>
            <p class="breadcrumbs"><span><a href="{{ route('admin.dashboard') }}">Home</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>Blogs
            </p>
        </div>
        <div class="row">
            <div style="text-align: right; margin-bottom: 10px;">
                <a href="{{ route('admin.blogs') }}">
                    <button type="button" class="btn btn-outline-info"
                        style="border-top-left-radius: 0; border-bottom-left-radius: 0;">
                        View Existing Blogs
                    </button>
                </a>
            </div>
            <!-- Success Message -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="col-md-8 offset-md-2">
                <div class="ec-cat-list card card-default mb-24px">
                    <div class="card-body">
                        <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="image">Blog Image<span
                                    class="text-danger">*</span></label>
                                <input type="file" name="image" id="image" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="title">Blog Title<span
                                    class="text-danger">*</span></label>
                                <input type="text" name="title" id="title" class="form-control"
                                    placeholder="Enter blog title" required>
                            </div>

                            <div class="form-group">
                                <label for="description">Blog Description<span
                                    class="text-danger">*</span></label>
                                <textarea name="description" id="description" class="form-control summernote" placeholder="Enter blog description"
                                    required></textarea>
                            </div>

                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary">Add Blog</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
