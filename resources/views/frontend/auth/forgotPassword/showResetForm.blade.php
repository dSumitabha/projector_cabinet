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
                    <h2 class="ec-title">Forgot Password</h2>

                </div>
            </div>
            <div class="ec-register-wrapper">
                <div class="ec-register-container">
                    <div class="ec-register-form">
                        <form action="{{ route('password.update') }}" method="post" id="change_password_form">
                            @csrf
                            <span class="ec-register-wrap ec-register-full">
                                <label>Password <span class="text-danger">*</span></label>
                                <input type="password" name="password" placeholder="Enter your new password">
                                <span class="text-danger error-text password_error"></span> <!-- Error message for phone -->

                            </span>
                            <span class="ec-register-wrap ec-register-full">
                                <label>Confirm Password <span class="text-danger">*</span></label>
                                <input type="password" name="password_confirmation" placeholder="Confirm your new password">
                                <span class="text-danger error-text password_confirmation_error"></span> <!-- Error message for phone -->

                            </span>
                            <span class="ec-register-wrap ec-register-btn">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </span>
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

    $('#change_password_form').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: new FormData(this),
            processData: false,
            dataType: 'json',
            contentType: false,
            beforeSend: function() {
                $(document).find('span.error-text').text('');
            },
            success: function(data) {
                if (data.status == 400) {
                    $.each(data.error, function(key, value) {
                        $('span.' + key + '_error').text(value[0]);
                    });
                } else if (data.status == 200) {
                    toastr.success(data.msg);
                    window.location.href = "{{route('login')}}";

                }
            }
        });
    });
</script>
@endpush