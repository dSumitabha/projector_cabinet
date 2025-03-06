<h4 class="text-dark mb-5">forgot Password</h4>
<form action="" class="mb-5" style="min-width: 50ch" method="POST" id="forgotPasswordFrom">
    @csrf
    <input type="Email" class="form-control w-75" name="email" placeholder="Enter Registerd Email"/>
    <input type="submit" class="btn btn-primary w-75 mt-3 " value="GET OTP" style="letter-spacing : 0.5ch" id="getOTP"/>
</form>
@if($errors->has('email'))
     <div class="alert alert-danger" role="alert">{{ $errors->first('email') }}</div>
@endif