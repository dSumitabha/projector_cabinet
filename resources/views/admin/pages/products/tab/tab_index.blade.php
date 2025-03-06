@extends('admin.layouts.master')
@section('content')
<!-- CONTENT WRAPPER -->
<style>
    .td-cost-price {
        font-weight: 600;
        color: #4caf50;
        /* Green */
    }

    .td-profit-percentage {
        font-weight: 600;
        color: #ff9800;
        /* Orange */
    }

    .td-selling-price {
        font-weight: 600;
        color: #f44336;
        /* Red */
    }

    .td-name {
        font-weight: 600;
        color: rgb(28, 28, 94);
        /* Red */
    }

    .td-product-id {
        font-weight: 600;
        color: rgb(6, 6, 153);
        /* Red */
    }

    .td-product-type {
        font-weight: 500;
        color: rgb(75, 75, 110);
        /* Red */
    }

    .td-product-frontend-name {
        font-weight: 600;
        color: rgb(87, 30, 114);
        /* Red */
    }
</style>
<div class="content">
    <div class="breadcrumb-wrapper d-flex align-items-center justify-content-between">
        <div>
            <h1>Manage Product Tabs</h1>
            <p class="breadcrumbs"><span><a href="{{ route('admin.dashboard') }}">Home</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>Manage Product Tabs
            </p>
        </div>

    </div>
    <div class="row">
        <div class="col-12">

            <div class="card card-default">
                <div class="card-body">
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
                        <table id="responsive-data-table" class="table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Parent Product ID</th>

                                    <th>Product ID</th>

                                    <th>Product Name</th>

                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->parent_product_id }}</td>

                                    <td class="td-product-id">{{ $product->product_id }}</td>

                                    <td class="td-name">{{ $product->product_name }}</td>
<style>
    .custom-btn {
    min-width: 160px; /* Ensures same width */
    height: 40px; /* Ensures same height */
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    border-radius: 5px; /* Slight rounded corners */
    text-decoration: none; /* Removes default anchor styling */
}

.custom-btn:hover {
    background-color: #28a745; /* Green background on hover */
    color: white;
}
</style>
                                    <td>
                                        <div class="btn-group mb-1">

                                            <div class="btn-group">
                                                <a href="{{ route('admin.products.description', ['id' => $product->product_id]) }}" class="btn btn-outline-success custom-btn">
                                                    Description
                                                </a>
                                                <a href="{{ route('admin.products.manual', ['id' => $product->product_id]) }}" class="btn btn-outline-success custom-btn">
                                                    Installation Manual
                                                </a>
                                                <a href="{{ route('admin.products.artical', ['id' => $product->product_id]) }}" class="btn btn-outline-success custom-btn">
                                                    Articles & Videos
                                                </a>
                                            </div>

                                            {{-- <a href="{{ route('admin.products.artical', ['id' => $product->product_id]) }}">
                                                <button type="button" class="btn btn-outline-success"
                                                    style="border-top-left-radius: 0; border-bottom-left-radius: 0;">Artical & Videos
                                                </button>
                                            </a> --}}


                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Edit Product Modal -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End Content -->
@endsection
@push('script')
@endpush
