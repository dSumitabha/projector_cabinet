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

                        <form action="{{route('password.email')}}" method="post" id="sendMail">
                            @csrf
                            <span class="ec-register-wrap ec-register-full">
                                <label>Registered Email <span class="text-danger">*</span></label>
                                <input type="text" name="email" placeholder="Enter your email address">
                                <span class="text error-text email_error" style="color: #e71341"></span>

                            </span>
                            <span class="ec-register-wrap ec-register-btn">
                                <button class="btn btn-primary" type="submit" id="submitButton">
                                    <span class="btn-text">Submit</span> <!-- Original button text -->
                                    <span class="spinner-border spinner-border-sm text-light d-none" role="status" aria-hidden="true"></span> <!-- Loader Spinner -->
                                </button>
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

    $('#sendMail').on('submit', function(e) {
        e.preventDefault();

        // Find the submit button, spinner, and button text
        var submitButton = $(this).find('button[type="submit"]');
        var spinner = submitButton.find('.spinner-border');
        var buttonText = submitButton.find('.btn-text');

        // Disable the submit button to prevent re-submission
        submitButton.prop('disabled', true);

        // Show the loading spinner and hide the button text
        spinner.removeClass('d-none'); // Show spinner
        buttonText.addClass('d-none'); // Hide button text

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
                // Hide spinner and show button text
                spinner.addClass('d-none'); // Hide spinner
                buttonText.removeClass('d-none'); // Show button text

                // Enable the submit button again
                submitButton.prop('disabled', false);

                if (data.status == 400) {
                    $.each(data.error, function(key, value) {
                        $('span.' + key + '_error').text(value[0]);
                    });
                } else if (data.status == 200) {
                    resetForm();
                    toastr.success(data.msg);
                    setTimeout(function() {
                        window.location.href = "{{route('check.otp')}}";
                    }, 1000);
                }
            },
            error: function(xhr, status, error) {
                // Hide spinner and show button text
                spinner.addClass('d-none');
                buttonText.removeClass('d-none');

                // Enable the submit button again
                submitButton.prop('disabled', false);

                toastr.error('Something went wrong. Please try again.');
            }
        });
    });



    function resetForm() {
        $('#sendMail')[0].reset();
    }
</script>
@endpush