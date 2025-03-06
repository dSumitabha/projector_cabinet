<h4 class="text-dark mb-5">Change Password</h4>
<form action="" class="mb-5" style="min-width: 50ch" method="POST" id="changePasswordFrom">
    @csrf
    <input type="text" class="form-control w-75 my-2" name="password" placeholder="Enter New Password"/>
    <input type="password" class="form-control w-75 my-2" name="password_confirmation" placeholder="Confirm Password"/>
    <input type="submit" class="btn btn-primary w-75 mt-3 " value="SET PASSWORD" style="letter-spacing : 0.5ch" id="setPassowrd"/>
</form>
@if($errors->any())
    <div class="alert alert-danger" role="alert">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif