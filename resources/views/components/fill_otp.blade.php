<h4 class="text-dark mb-3">Fill OTP </h4>

<form action="" class="mb-5" style="min-width: 50ch" method="POST" id="fillOTPForm">
    @if($errors->has('OTP'))
        <p class="alert alert-danger mb-4 py-2 w-75" role="alert">{{ $errors->first('OTP') }}</p>
    @endif
    @csrf
    <input type="number" maxlength="6" class="form-control w-75 text-center" id="fieldOTP" name="OTP" placeholder="Enter 6 Digit OTP" onfocus="setLspace()"/>
    <input type="submit" class="btn btn-success w-75 mt-3" value="Verify OTP" style="letter-spacing : 0.5ch"/>
</form>

<button id="resendOTP" class="btn btn-info w-50 mt-5 d-block mx-auto">Resend OTP</button>

