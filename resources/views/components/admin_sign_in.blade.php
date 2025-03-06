<h4 class="text-dark mb-5">Admin-Sign In</h4>
@include('messages')
<form method="post" action="{{route('admin_login_check')}}" autocomplete="off">
    @csrf
    <div class="row">
        <div class="form-group col-md-12 mb-4">
            <input type="email" class="form-control" id="email" name="email" placeholder="Username">
        </div>

        <div class="form-group col-md-12 ">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        </div>

        <div class="col-md-12">

            <div class="d-flex my-2 justify-content-between">
<!--                 <p><a class="text-blue" href="#" id="forgotPassword">Forgot Password?</a></p> -->
            </div>

            <button type="submit" class="btn btn-primary btn-block mb-4" style="background-color:#6466e8">Sign In</button>
        </div>
    </div>
</form>
