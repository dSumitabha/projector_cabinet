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
            <h1>Product Packaging Info</h1>
            <p class="breadcrumbs"><span><a href="{{ route('admin.dashboard') }}">Home</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>Packages
            </p>
        </div>
     </div>
     <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="ec-cat-list card card-default mb-24px">
                <div class="card-body">
                    <div class="ec-cat-form" id="projectorForm">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4>Add New Product Packaging - By Import</h4>
                            <!-- Button to download Excel format -->

                            <a href="{{ route('admin.packages.download-format') }}" class="btn btn-outline-success">
                                <i class="mdi mdi-download"></i> Download Excel Format
                            </a>
                        </div>
                        <a href="{{ route('admin.package.index') }}" class="btn btn-success" style="background-color:rgb(11, 212, 11)">
                            <i class="mdi mdi-package"></i> View Existing Product Packaging
                        </a>
                        <div class="instruction-box">
                            <ul>
                                <li style="color:#04064d"><b>Please Note :</b></li>
                                <li>Ensure that the <strong>Packaging Product ID</strong> is <span
                                        class="text-danger">present for every row</span>.</li>


                                <li>Maintain the proper format of the Excel sheet, and <span
                                        class="text-danger">never alter the column
                                        headers</span>.</li>
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

                        <form action="{{ route('admin.package.import') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="file" class="col-form-label">Import Product Packaging</label>
                                <input type="file" name="file" class="form-control">
                            </div>
                            <button class="btn btn-primary">Import</button>
                        </form>



                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
