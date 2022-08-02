<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="SemiColonWeb" />

	<!-- Stylesheets
	============================================= -->
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Poppins:300,400,500,600,700|PT+Serif:400,400i&display=swap" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
	<link rel="stylesheet" href="style.css" type="text/css" />
	<link rel="stylesheet" href="css/dark.css" type="text/css" />
	<link rel="stylesheet" href="css/font-icons.css" type="text/css" />
	<link rel="stylesheet" href="css/animate.css" type="text/css" />
	<link rel="stylesheet" href="css/magnific-popup.css" type="text/css" />

	<link rel="stylesheet" href="css/custom.css" type="text/css" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<!-- Document Title
	============================================= -->
	<title>Login - Layout 5 | Canvas</title>

</head>

<body class="stretched">

	@if (request()->get('intended'))
		@php
		Session::put('url.intended', request()->get('intended'));  
		@endphp
	@endif

	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">

		<!-- Content
		============================================= -->
		<section id="content">
			<div class="content-wrap py-0">

				<div class="section p-0 m-0 h-100 position-absolute" style="background: url('https://wallpapercave.com/wp/wp3702631.jpg') center center no-repeat; background-size: cover;"></div>

				<div class="section bg-transparent min-vh-100 p-0 m-0">
					<div class="vertical-middle">
						<div class="container-fluid py-5 mx-auto">
							<div class="center">
								<a href="{{ url('/') }}"><img src="images/logo-dark.png" alt="Canvas Logo"></a>
							</div>

							<div class="card mx-auto rounded-0 border-0" style="max-width: 400px; background-color: rgba(255,255,255,0.93);">
								<div class="card-body" style="padding: 40px;">
									<form id="login-form" name="login-form" class="mb-0 login-form" method="POST" action="{{ route('login') }}">
                                    @csrf
										<h3>Login to your Account</h3>

										<div class="row">
										    <span class="text-danger">{{ $error ?? '' }}</span>

											<div class="col-12 form-group">
												<label for="email">Email:</label>
												<input type="email" id="email" name="email" value="{{ old('email') }}"class="form-control not-dark" aria-describedby="emailHelpText" required autofocus/>
                                                @if (!empty($errors) && $errors->has('email'))
                                                    <span>{{ $errors->first('email') }}</span>
                                                @endif
                                            </div>

											<div class="col-12 form-group">
												<label for="password">Password:</label>
												<input type="password" id="password" name="password" value="" class="form-control not-dark" aria-describedby="passwordHelpText" required/>
                                                @if (!empty($errors) && $errors->has('password'))
                                                    <span>{{ $errors->first('password') }}</span>
                                                @endif
											</div>
                                            <label>
                                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                            </label>
											<div class="col-12 form-group">
												<button class="button button-3d button-black m-0" id="login-form-submit" name="login-form-submit" value="login">Login</button>
												<a href="{{ route('password.request') }}" class="float-end">Forgot Password?</a>
                                                <p><a href="{{ route('register') }}" class="float-end">Register</a></p>
											</div>
										</div>
									</form>

									<div class="line line-sm"></div>

									<!-- <div class="w-100 text-center">
										<h4 style="margin-bottom: 15px;">or Login with:</h4>
										<a href="#" class="button button-rounded si-facebook si-colored">Facebook</a>
										<span class="d-none d-md-inline-block">or</span>
										<a href="#" class="button button-rounded si-twitter si-colored">Twitter</a>
									</div> -->
								</div>
							</div>

							<div class="text-center dark mt-3"><small>Copyrights &copy; All Rights Reserved by RepublicProxy Enterprise</small></div>
						</div>
					</div>
				</div>

			</div>
		</section><!-- #content end -->

	</div><!-- #wrapper end -->

	<!-- Go To Top
	============================================= -->
	<div id="gotoTop" class="icon-angle-up"></div>

	<!-- JavaScripts
	============================================= -->
	<script src="js/jquery.js"></script>
	<script src="js/plugins.min.js"></script>

	<!-- Footer Scripts
	============================================= -->
	<script src="js/functions.js"></script>

</body>
</html>