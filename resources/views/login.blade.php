@extends('frontend.layouts.master')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<style>
    /* Adjust Select2 box styling */
    .select2-container--default .select2-selection--single {
        height: 50px !important;
        /* Adjust height */
        font-size: 18px !important;
        /* Adjust font size */
        border: 1px solid grey !important;
        /* Set border color */
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        text-align: center !important;
    }

    /* Ensure full width if needed */
    .select2-container {
        width: 100% !important;
        /* Adjust width */
    }
</style>
<section class="ec-page-content section-space-p">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="section-title">
                    <h2 class="ec-bg-title">LogIn</h2>
                    <h2 class="ec-title">LogIn</h2>

                </div>
            </div>
            <div class="ec-register-wrapper">
                <div class="ec-register-container">
                    <div class="ec-register-form">
                        <form action="{{ route('login.submit') }}" method="post">
                            @csrf

                            <span class="ec-register-wrap ec-register-full">
                                <label>Registered Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" placeholder="Enter your email address" required="">
                            </span>

                            <span class="ec-register-wrap ec-register-full">
                                <label>Password <span class="text-danger">*</span></label>
                                <input type="password" name="password" placeholder="Enter your password" required="">
                            </span>
                            <span class="ec-register-wrap ec-register-fp">
                                <label><a href="{{route('password.request')}}">Forgot Password?</a></label>
                            </span>




                            <span class="ec-register-wrap ec-register-btn">
                                <button class="btn btn-primary" type="submit">LogIn</button>

                            </span>
                            <a href="{{ route('register') }}" class="btn btn-secondary" style="background-color:rgb(61, 55, 55)">REGSTER</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<!-- Initialize Select2 -->
<script>
    $(document).ready(function() {
        $('#ec-select-state').select2({
            placeholder: "Search for a state...",
            allowClear: true
        });
    });
</script>
@endpush
