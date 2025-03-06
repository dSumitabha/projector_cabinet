<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta name="description" content="Ekka - Admin Dashboard HTML Template.">

		<title>Admin Signin</title>
		
		<!-- GOOGLE FONTS -->
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800;900&family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

		<link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet" />
		
		<link rel="stylesheet" href="{{ url('/') }}/admin/assets/css/spstyle.css" class="stylesheet">
		<!-- Ekka CSS -->
		<link id="ekka-css" rel="stylesheet" href="{{ url('/') }}/admin/assets/css/ekka.css" />
		
		<!-- FAVICON -->
		<link href="{{ url('/') }}/admin/assets/img/favicon.png" rel="shortcut icon" />
	</head>
	
	<body class="sign-inup" id="body">
		<div class="text-center d-flex align-items-center justify-content-center" style="height : 25vh;">	
		</div>
		@if(session('error'))
			<div id="error-alert" class="alert alert-warning alert-dismissible fade show w-25 py-2" style= "margin :0 auto;"role="alert">
				{{ session('error') }}
				<span aria-hidden="true">&times;</span>
			</div>

			<script>
				// Automatically fade out the error alert after 5 seconds
				setTimeout(function() {
					$('#error-alert').fadeOut('slow');
				}, 2500);
			</script>
		@endif
		<div class="container d-flex align-items-center justify-content-center form-height-login pt-24px pb-24px" style="height : 65vh">
			<div class="row justify-content-center">
				<div class="col-lg-10 col-md-10">
					<div class="card" style="border : 1px solid 1px solid #eae9ef; box-shadow: 0 0 10px 0 #c5c2d1;" >
						<div class="card-header" style="background-color : #6466e8; padding: 1.25rem 1rem !important; ">
							<div class="ec-brand">
								<a href="{{route('home')}}" title="Starpact">
									<img class="ec-brand-icon" src="{{ url('/') }}/admin/assets/img/logo/logo-login.png" alt="" style="max-width:180px !important; width : unset"/>
								</a>
							</div>
						</div>
						<div class="card-body p-5" id="authContainer">
							<x-admin_sign_in />
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Javascript -->
		<script src="{{ url('/') }}/admin/assets/plugins/jquery/jquery-3.5.1.min.js"></script>
		<script src="{{ url('/') }}/admin/assets/js/bootstrap.bundle.min.js"></script>
		<script src="{{ url('/') }}/admin/assets/plugins/jquery-zoom/jquery.zoom.min.js"></script>
		<script src="{{ url('/') }}/admin/assets/plugins/slick/slick.min.js"></script>
	
		<!-- Ekka Custom -->	
		<script src="{{ url('/') }}/admin/assets/js/ekka.js"></script>
		<script>
			const authContainer = document.querySelector('#authContainer')

			document.querySelector('#forgotPassword').addEventListener('click', function(event){
				event.preventDefault()

				const xhr = new XMLHttpRequest()
				xhr.open('GET', '/forgot-password-view', true)
				xhr.setRequestHeader('Content-Type', 'text/html')

				xhr.onreadystatechange = function() {
					if (xhr.readyState === 4) {
						if (xhr.status === 200) {
							authContainer.innerHTML = xhr.responseText
							loadOTPView()
						}
						else{
							console.error('Error fetching the file:', xhr.status, xhr.statusText)
						}
					}
				}
				xhr.send()
			})
			
            function loadOTPView() {
				document.getElementById('forgotPasswordFrom').addEventListener('submit', function(event) {
					event.preventDefault();

					const formData = new FormData(this);
					const xhr = new XMLHttpRequest();
					const csrfContent = document.querySelector('input[name="_token"]').value

					console.log(formData)
					xhr.open('POST', '/otp-view', true);
					xhr.setRequestHeader('X-CSRF-TOKEN', csrfContent)

					xhr.onload = function() {
						if (xhr.readyState === 4) {
							if (xhr.status === 200) {
								authContainer.innerHTML = xhr.responseText
								loadChangePasswordView()
							} else {
								responseDiv.innerHTML = `<p>Error: ${xhr.statusText}</p>`
								console.error('Error fetching the file:', xhr.status, xhr.statusText)
							}
						}
					}
					xhr.send(formData)
				})
			}

			function loadChangePasswordView(){
				document.getElementById('fillOTPForm').addEventListener('submit', function(event) {
                    event.preventDefault()
					const formData = new FormData(this)
					const xhr = new XMLHttpRequest()
					const csrfContent = document.querySelector('input[name="_token"]').value
					xhr.open('POST', '/change-password', true)

					console.log(formData)
					xhr.setRequestHeader('X-CSRF-TOKEN', csrfContent)
					xhr.onload = function() {
						if (xhr.readyState === 4) {
                            if (xhr.status === 200) {
                                authContainer.innerHTML = xhr.responseText
								setChangePassword()
                            } else {
                            	authContainer.innerHTML = `<p>Error: ${xhr.statusText}</p>`
                                console.error('Error fetching the file:', xhr.status, xhr.statusText)
                            }
                        }
                    }
					xhr.send(formData)
				})
			}
			
			function setChangePassword(){
				document.getElementById('changePasswordForm').addEventListener('submit', function(event) {
                    event.preventDefault()

                    const formData = new FormData(this)
                    const xhr = new XMLHttpRequest()
                    const csrfContent = document.querySelector('input[name="_token"]').value
                    xhr.open('POST', '/reset-password', true)

					xhr.setRequestHeader('X-CSRF-TOKEN', csrfContent)
					xhr.onload = function() {
						if (xhr.readyState === 4) {
                            if (xhr.status === 200) {
                                authContainer.innerHTML = xhr.responseText
                                
                            } else {
                                authContainer.innerHTML = `<p>Error: ${xhr.statusText}</p>`
                                console.error('Error fetching the file:', xhr.status, xhr.statusText)
                            }
                        }
                    }
                    xhr.send(formData)
				})
			}
			
			function setLspace(){
				const fieldOTP = document.querySelector('#fieldOTP')
				fieldOTP.style.letterSpacing = "3ch"
				console.log('done')
			}


	</script>
	</body>
</html>