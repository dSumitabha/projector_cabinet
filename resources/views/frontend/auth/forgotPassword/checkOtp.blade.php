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


    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
    }

    .title {
        max-width: 400px;
        margin: auto;
        text-align: center;
        font-family: "Poppins", sans-serif;

        h3 {
            font-weight: bold;
        }

        p {
            font-size: 12px;
            color: #118a44;

            &.msg {
                color: initial;
                text-align: initial;
                font-weight: bold;
            }
        }
    }

    .otp-input-fields {
        margin: auto;
        background-color: white;
        box-shadow: 0px 0px 8px 0px #02025044;
        max-width: 400px;
        width: auto;
        display: flex;
        justify-content: center;
        gap: 10px;
        padding: 40px;

        input {
            height: 40px;
            width: 40px;
            background-color: transparent;
            border-radius: 4px;
            border: 1px solid #2f8f1f;
            text-align: center;
            outline: none;
            font-size: 16px;

            &::-webkit-outer-spin-button,
            &::-webkit-inner-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }

            /* Firefox */
            &[type="number"] {
                -moz-appearance: textfield;
            }

            &:focus {
                border-width: 2px;
                border-color: darken(#2f8f1f, 5%);
                font-size: 20px;
            }
        }
    }

    .result {
        max-width: 400px;
        margin: auto;
        padding: 24px;
        text-align: center;

        p {
            font-size: 24px;
            font-family: "Antonio", sans-serif;
            opacity: 1;
            transition: color 0.5s ease;

            &._ok {
                color: green;
            }

            &._notok {
                color: red;
                border-radius: 3px;
            }
        }
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

                        <form action="{{route('check.otp.submit')}}" method="post" class="otp-form" name="otp-form" id="otpSubmit">
                            @csrf
                            <div class="title">
                                <h3>OTP VERIFICATION</h3>
                                <p class="info">An OTP has been sent to {{ $maskedEmail }}</p>
                                <p class="msg">Please enter OTP to verify</p>
                            </div>
                            <div class="otp-input-fields">
                                <input type="number" class="otp__digit otp__field__1">
                                <input type="number" class="otp__digit otp__field__2">
                                <input type="number" class="otp__digit otp__field__3">
                                <input type="number" class="otp__digit otp__field__4">
                                <input type="number" class="otp__digit otp__field__5">
                                <input type="number" class="otp__digit otp__field__6">
                            </div>

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


    var otp_inputs = document.querySelectorAll(".otp__digit");
    var mykey = "0123456789".split("");
    otp_inputs.forEach((_) => {
        _.addEventListener("keyup", handle_next_input);
    });

    function handle_next_input(event) {
        let current = event.target;
        let index = parseInt(current.classList[1].split("__")[2]);
        current.value = event.key;

        if (event.keyCode == 8 && index > 1) {
            current.previousElementSibling.focus();
        }
        if (index < 6 && mykey.indexOf("" + event.key + "") != -1) {
            var next = current.nextElementSibling;
            next.focus();
        }
        var _finalKey = "";
        for (let {
                value
            }
            of otp_inputs) {
            _finalKey += value;
        }
        if (_finalKey.length == 6) {
            document.querySelector("#_otp").classList.replace("_notok", "_ok");
            document.querySelector("#_otp").innerText = _finalKey;
        } else {
            document.querySelector("#_otp").classList.replace("_ok", "_notok");
            document.querySelector("#_otp").innerText = _finalKey;
        }
    }


    $('#otpSubmit').on('submit', function(e) {
        e.preventDefault();

        var otp = '';
        document.querySelectorAll('.otp__digit').forEach(function(input) {
            otp += input.value;
        });

        // Get the CSRF token from the page
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: {
                otp: otp,
                _token: csrfToken // Include CSRF token manually
            },
            dataType: 'json',
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
                    setTimeout(function() {
                        window.location.href = "{{route('password.reset')}}";
                    }, 1000);
                }
            },
            error: function(xhr, status, error) {
                toastr.error('Something went wrong. Please try again.');
            }
        });
    });



    function resetForm() {
        $('#otpSubmit')[0].reset();
    }
</script>
@endpush