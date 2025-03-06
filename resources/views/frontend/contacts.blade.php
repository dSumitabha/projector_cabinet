@extends('frontend.layouts.master')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')
<style>
    .form-label
    {
        color:blue;
        font-weight:bold;
    }
</style>
<div class="container py-5">
    <div class="row justify-content-center p-4">
        <!-- Contact Form -->
        <div class="col-lg-6 card-body shadow-lg">
            <div class="card border-0 rounded-3 p-4">
                <h2 class="text-center text-primary mb-4 fw-bold">Contact Us</h2>
                <form id="contactForm">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="full_name" placeholder="Enter your name">
                        <span class="text-danger error-text full_name_error"></span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter your email">
                        <span class="text-danger error-text email_error"></span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Subject</label>
                        <input type="text" class="form-control" id="subject" placeholder="Subject">
                        <span class="text-danger error-text subject_error"></span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Message</label>
                        <textarea class="form-control" id="message" rows="4" placeholder="Write your message..."></textarea>
                        <span class="text-danger error-text message_error"></span>
                    </div>
                    <button type="submit" id="submitBtn" class="btn btn-primary w-100">
                        Send Message
                    </button>
                </form>
            </div>
        </div>

        <!-- Google Map -->
        <div class="col-lg-6  shadow-lg">
            <div class="">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2546.057693929856!2d-86.48929982587676!3d36.15752114276612!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8864168e01b44c61%3A0xf231189671584a33!2s652%20Foster%20Ln%2C%20Mt.%20Juliet%2C%20TN%2037122%2C%20USA!5e1!3m2!1sen!2sin!4v1740055193097!5m2!1sen!2sin"  width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="mt-4">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2835.0556680989334!2d-86.57576842283024!3d36.5140468226407!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88643583242a7b63%3A0x75ce2c24d0d4f5eb!2s3278%20TN-76%2C%20Cottontown%2C%20TN%2037048%2C%20USA!5e1!3m2!1sen!2sin!4v1741262690883!5m2!1sen!2sin"  width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    $(document).ready(function () {
        $("#contactForm").on("submit", function (e) {
            e.preventDefault();

            $(".error-text").text(""); // Clear previous errors
            let submitBtn = $("#submitBtn");

            // Show loading text and disable button
            submitBtn.html('Loading... <span class="spinner-border spinner-border-sm"></span>').prop("disabled", true);

            $.ajax({
                url: "{{ route('contact.store') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    full_name: $("#full_name").val(),
                    email: $("#email").val(),
                    subject: $("#subject").val(),
                    message: $("#message").val(),
                },
                success: function (response) {
                    Swal.fire({
                        title: "Success!",
                        text: response.success,
                        icon: "success",
                        confirmButtonText: "OK",
                    });
                    $("#contactForm")[0].reset();
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function (key, value) {
                            $("." + key + "_error").text(value[0]); // Display error message
                        });
                    } else {
                        Swal.fire({
                            title: "Error!",
                            text: "An error occurred. Please try again.",
                            icon: "error",
                            confirmButtonText: "OK",
                        });
                    }
                },
                complete: function () {
                    // Restore button after AJAX completes
                    submitBtn.html("Send Message").prop("disabled", false);
                }
            });
        });
    });
</script>
@endpush

