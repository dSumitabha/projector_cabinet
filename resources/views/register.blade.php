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
                    <h2 class="ec-bg-title">Register</h2>
                    <h2 class="ec-title">Register</h2>

                </div>
            </div>
            <div class="ec-register-wrapper">
                <div class="ec-register-container">
                    <div class="ec-register-form">
                        <form action="{{route('register.submit')}}" method="post" id="user_reg">
                            @csrf
                            <span class="ec-register-wrap ec-register-half">
                                <label>First Name <span class="text-danger">*</span></label>
                                <input type="text" name="firstname" placeholder="Enter your first name">
                                <span class="text error-text firstname_error" style="color: #e71341"></span>

                            </span>
                            <span class="ec-register-wrap ec-register-half">
                                <label>Last Name <span class="text-danger">*</span></label>
                                <input type="text" name="lastname" placeholder="Enter your last name">
                                <span class="text error-text lastname_error" style="color: #e71341"></span>
                            </span>
                            <span class="ec-register-wrap ec-register-half">
                                <label>Email <span class="text-danger">*</span></label>
                                <input type="text" name="email" placeholder="Enter your email address">
                                <span class="text error-text email_error" style="color: #e71341"></span>
                            </span>
                            <span class="ec-register-wrap ec-register-half">
                                <label>Phone Number <span class="text-danger">*</span></label>
                                <input type="text" name="phonenumber" placeholder="Enter your phone number">
                                <span class="text error-text phonenumber_error" style="color: #e71341"></span>
                            </span>
                            <span class="ec-register-wrap ec-register-half">
                                <label>Password <span class="text-danger">*</span></label>
                                <input type="password" name="password" placeholder="Enter your password">
                                <span class="text error-text password_error" style="color: #e71341"></span>
                            </span>
                            <span class="ec-register-wrap ec-register-half">
                                <label>Confirm Password <span class="text-danger">*</span></label>
                                <input type="password" name="password_confirmation" placeholder="Enter your Password Again">
                                <span class="text error-text password_confirmation_error" style="color: #e71341"></span>
                            </span>
                            <span class="ec-register-wrap ec-register-btn">
                            <button class="btn btn-primary submit-btn" type="submit">Register</button>
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

    $('#user_reg').on('submit', function(e) {
        e.preventDefault();

        let submitBtn = $('.submit-btn');

        // Disable button and change text to "Loading..."
        submitBtn.prop('disabled', true).text('Loading...');

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

                    // Re-enable button and restore text on validation error
                    submitBtn.prop('disabled', false).text('Register');
                } else if (data.status == 200) {
                    resetForm();
                    toastr.success(data.msg);

                    setTimeout(function() {
                        window.location.href = data.redirect_url; // Redirect to the profile page
                    }, 1000);
                }
            },
            complete: function() {
                // Re-enable button and restore text when request completes
                submitBtn.prop('disabled', false).text('Register');
            }
        });
    });


    function resetForm() {
        $('#user_reg')[0].reset();
    }
</script>
@endpush
