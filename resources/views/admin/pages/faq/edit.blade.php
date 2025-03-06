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
            <h1>Edit Blog Content</h1>
            <p class="breadcrumbs"><span><a href="{{ route('admin.dashboard') }}">Home</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>FAQs
            </p>
        </div>
        <div class="row">
            <div style="text-align: right; margin-bottom: 10px;">
                <a href="{{ route('admin.faq') }}">
                    <button type="button" class="btn btn-outline-info"
                        style="border-top-left-radius: 0; border-bottom-left-radius: 0;">
                        View Existing FAQs
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
            <div class="col-md-10 offset-md-1">
                <div class="ec-cat-list card card-default mb-24px">
                    <div class="card-body">
                        <form action="{{ route('admin.faq.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')



                            <div class="form-group">
                                <label for="question">Questions<span class="text-danger">*</span></label>
                                <input type="text" name="question" id="question" class="form-control"
                                    value="{{ old('question', $blog->question) }}" placeholder="Enter blog title" required>
                            </div>

                            <div class="form-group">
                                <label for="answer">Answers<span class="text-danger">*</span></label>
                                <textarea name="answer" id="answer" class="form-control summernote"
                                    placeholder="Enter blog description" required>{{ old('description', $blog->answer) }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="type">FAQ Type <span class="text-danger">*</span></label>
                                <select name="type" id="type" class="form-control" required>
                                    <option value="general" {{ old('type', $blog->type) == 'general' ? 'selected' : '' }}>FAQ Page</option>
                                    <option value="product" {{ old('type', $blog->type) == 'product' ? 'selected' : '' }}>Product FAQ Page</option>
                                    <option value="common" {{ old('type', $blog->type) == 'common' ? 'selected' : '' }}>Common (Shown on Both Pages)</option>
                                </select>
                            </div>
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary">Update FAQ</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')



@endpush
