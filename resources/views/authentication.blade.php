@extends('frontend.layouts.master')
@section('content')
<!-- Ec breadcrumb start -->
<div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="row ec_breadcrumb_inner">
					<div class="col-md-6 col-sm-12">
						<h2 class="ec-breadcrumb-title">Login</h2>
					</div>
					<div class="col-md-6 col-sm-12">
						<!-- ec-breadcrumb-list start -->
						<ul class="ec-breadcrumb-list">
							<li class="ec-breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
							<li class="ec-breadcrumb-item active" id="breadcumbActive">Login</li>
						</ul>
						<!-- ec-breadcrumb-list end -->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Ec breadcrumb end -->
	
<!-- Ec login page -->
<section class="ec-page-content section-space-p" id="authContainer">
	<x-auth_login />
</section>
<script>
    const ecAuth = document.querySelector('#authContainer');
    const registerButton = document.querySelector('#registerButton');

    registerButton.addEventListener('click', function(event) {
		event.preventDefault()
        const xhr = new XMLHttpRequest()

        xhr.open('GET', '/register-content', true);


        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 300) {
                ecAuth.innerHTML = xhr.responseText
            } else {

                console.error('Failed to fetch new section:', xhr.statusText)
            }
        };

        xhr.onerror = function() {
            console.error('Network error while fetching new section')
        };

        xhr.send()
		
    })
</script>

@endsection