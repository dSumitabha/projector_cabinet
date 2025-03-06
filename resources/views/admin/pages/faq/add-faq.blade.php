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
            <h1>Add FAQ Content</h1>
            <p class="breadcrumbs"><span><a href="{{ route('admin.dashboard') }}">Home</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>FAQ
            </p>
        </div>
        <div class="row">
            <div style="text-align: right; margin-bottom: 10px;">
                <a href="{{ route('admin.faq') }}">
                    <button type="button" class="btn btn-outline-info"
                        style="border-top-left-radius: 0; border-bottom-left-radius: 0;">
                        View Existing FAQ
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
                        <form action="{{ route('admin.faq.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="title">FAQ Question<span
                                    class="text-danger">*</span></label>
                                <input type="text" name="question" id="question" class="form-control"
                                    placeholder="Enter FAQ title" required>
                            </div>

                            <div class="form-group">
                                <label for="description">FAQ Answer<span
                                    class="text-danger">*</span></label>
                                <textarea name="answer" id="answer" class="form-control summernote" placeholder="Enter answer"
                                    required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="type">FAQ Type <span class="text-danger">*</span></label>
                                <select name="type" id="type" class="form-control" required>
                                    <option value="general">FAQ Page</option>
                                    <option value="product">Product FAQ Page</option>
                                    <option value="common">Common (Shown on Both Pages)</option>
                                </select>
                            </div>

                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary">Add FAQ</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
