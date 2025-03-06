@extends('admin.layouts.master')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .text-danger {
            color: red;
        }

        .instruction-box {
            border: 2px solid #007BFF;
            /* Blue border */
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            /* Shadow effect */
            max-width: 400px;
            /* Set a max width */
            margin: 20px auto;
            /* Center the box on the page */
            background-color: #f9f9f9;
            /* Light background color */
        }

        ul {
            padding-left: 20px;
        }

        li {
            margin-bottom: 5px;
        }
    </style>

    <div class="ec-content-wrapper">
        <div class="breadcrumb-wrapper breadcrumb-wrapper-2 breadcrumb-contacts">
            <h1>Add Header Navigation</h1>
            <p class="breadcrumbs"><span><a href="{{ route('admin.dashboard') }}">Home</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>Add Banner
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="ec-cat-list card card-default mb-24px">
                <div class="card-body">
                    <div class="ec-cat-form" id="bannerForm">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4>Add New Navigation</h4>
                        </div>

                        <div class="instruction-box">
                            <ul>
                                <li style="color:#04064d"><b>Please Note :</b></li>
                                <li>Ensure that all fields are filled out correctly before submitting.</li>

                            </ul>
                        </div>
                        <hr />



                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('admin.header.navigation.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="first_header" class="col-form-label">First Header</label>
                                <input type="text" name="title" class="form-control" >
                            </div>

                            <button class="btn btn-primary">Add </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
