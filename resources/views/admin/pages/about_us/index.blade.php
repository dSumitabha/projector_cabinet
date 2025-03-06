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
            <h1>Manage About Us</h1>
            <p class="breadcrumbs"><span><a href="{{ route('admin.dashboard') }}">Home</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>Manage About Us
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

                      

                        <div class="table-responsive">
                            <table id="responsive-data-table" class="table">
                                <thead>
                                    <tr>
                                        <th>Sl ID</th>
                                        <th>Description</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>{{ $aboutUs->description ?? 'N/A' }}</td>
                                        <td>
                                            @if($aboutUs->image)
                                                <a href="{{ asset('storage/' . $aboutUs->image) }}" target="_blank">
                                                    <img src="{{ asset('storage/' . $aboutUs->image) }}" style="height: 100px; width: 100px;">
                                                </a>
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.about.edit', $aboutUs->id) }}" class="btn btn-outline-success">Edit</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Content -->
</div>
@endsection
