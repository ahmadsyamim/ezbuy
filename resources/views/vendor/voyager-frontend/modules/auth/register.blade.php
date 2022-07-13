@extends('voyager-frontend::layouts.default')

@section('content')
<!-- Page Title
		============================================= -->
		<section id="page-title">

			<div class="container clearfix">
				<h1>Fitness</h1>
				<span>Forms Widget</span>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item"><a href="#">Widgets</a></li>
					<li class="breadcrumb-item active" aria-current="page">Fitness Form</li>
				</ol>
			</div>

		</section><!-- #page-title end -->

		<!-- Content
		============================================= -->
		<section id="content">
			<div class="content-wrap">
				<div class="container clearfix">

					<div class="form-widget">

						<div class="form-result"></div>

						<div class="row shadow bg-light border">

							<div class="col-lg-4 dark" style="background: linear-gradient(rgba(0,0,0,.8), rgba(0,0,0,.2)), url('https://images.unsplash.com/photo-1511809870860-4d2806eb1908?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=668&q=80') center center / cover; min-height: 400px;">
								<h3 class="center mt-5">Fitness Quotes</h3>
								<div class="calories-wrap center w-100 px-2">
									<span class="text-uppercase mb-0 ls2">Loosing Fat</span>
									<h2 id="calories-count" class="calories display-3 mb-2 heading-block border-bottom-0 fw-semibold font-body py-2"></h2>
									<span class="text-uppercase h6 ls3">Estimated Calories</span>
								</div>
								<small class="center m-0 position-absolute" style="bottom: 12px;">Metric Units</small>
							</div>

							<div class="col-lg-8 p-5">
                                <form class="row mb-0" id="fitness-form" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                                @csrf                                   

									<div class="form-process">
										<div class="css3-spinner">
											<div class="css3-spinner-scaler"></div>
										</div>
									</div>
									<div class="col-12 form-group">
										<div class="row">
											<div class="col-sm-2 col-form-label">
												<label for="name">Name:</label>
											</div>
											<div class="col-sm-10">
												<input type="text" name="name" id="name" class="form-control required" value="{{ old('name') }}" placeholder="Enter your Full Name" aria-describedby="nameHelpText" required autofocus>
                                                @if (!empty($errors) && $errors->has('name'))
                                                    <span>{{ $errors->first('name') }}</span>
                                                @endif                               
											</div>
										</div>
									</div>
									<div class="col-12 form-group">
										<div class="row">
											<div class="col-sm-2 col-form-label">
												<label for="email">Email:</label>
											</div>
											<div class="col-sm-10">
												<input type="email" name="email" id="email" class="form-control required" value="{{ old('email') }}" placeholder="Enter your Email" aria-describedby="emailHelpText" required>
                                                @if (!empty($errors) && $errors->has('email'))
                                                    <span>{{ $errors->first('email') }}</span>
                                                @endif                                               
											</div>
										</div>
									</div>
									<div class="col-12 form-group">
										<div class="row">
											<div class="col-sm-2 col-form-label">
												<label for="fitness-form-phone">Phone:</label>
											</div>
											<div class="col-sm-10">
												<input type="text" name="fitness-form-phone" id="fitness-form-phone" class="form-control required" value="" placeholder="Your Contact Number">
											</div>
										</div>
									</div>
									<div class="col-12 form-group">
										<div class="row">
											<div class="col-sm-2 col-form-label">
												<label for="fitness-form-sex">Gender:</label>
											</div>
											<div class="col-sm-6">
												<div class="btn-group d-flex" role="group">
													<input type="radio" class="btn-check required" name="fitness-form-sex" id="fitness-form-male" value="Male">
													<label for="fitness-form-male" class="btn btn-outline-dark font-body ls0 nott">Male</label>

													<input type="radio" class="btn-check required" name="fitness-form-sex" id="fitness-form-female" value="Female">
													<label for="fitness-form-female" class="btn btn-outline-dark font-body ls0 nott">Female</label>
												</div>
											</div>
										</div>
									</div>
									<div class="col-12 form-group">
										<div class="row">
											<div class="col-sm-2 col-form-label">
												<label for="password">Password:</label>
											</div>
											<div class="col-sm-5">
                                                <input type="password" name="password" id="password" class="form-control required" value="" placeholder="Password" aria-describedby="passwordHelpText" required>
                                                @if (!empty($errors) && $errors->has('password'))
                                                    <span>{{ $errors->first('password') }}</span>
                                                @endif  
											</div>
										</div>
									</div>
									<div class="col-12 form-group">
										<div class="row">
											<div class="col-sm-2 col-form-label">
												<label for="confirmpassword">Confirm Password:</label>
											</div>
											<div class="col-sm-5">
												<div class="input-group">
                                                    <input type="password" id="password-confirm" name="password_confirmation" class="form-control required" value="" placeholder="Confirm Password" required>
												</div>
											</div>
										</div>
									</div>
									<div class="col-12 form-group">
										<div class="row">
											<div class="col-sm-2 col-form-label">
												<label for="fitness-form-weight">Postcode:</label>
											</div>
											<div class="col-sm-5">
												<div class="input-group">
                                                    <input type="text" name="fitness-form-phone" id="fitness-form-phone" class="form-control required" value="" placeholder="Postcode">
												</div>
											</div>
										</div>
									</div>
									<div class="col-12 form-group">
										<div class="row">
											<div class="col-sm-2 col-form-label">
												<label for="fitness-form-phone">Address:</label>
											</div>
											<div class="col-sm-10">
                                                <textarea name="event-registration-bio" id="event-registration-bio" class="form-control required" cols="30" rows="5"></textarea>
											</div>
										</div>
									</div>

									<div class="col-12 d-none">
										<input type="text" id="fitness-form-botcheck" name="fitness-form-botcheck" value="" />
									</div>
									<div class="col-12 d-flex justify-content-end align-items-center">
										<button type="submit" name="fitness-form-submit" class="btn btn-success ms-2">Register</button>
									</div>

									<input type="hidden" name="prefix" value="fitness-form-">
									<input type="hidden" name="subject" value="New Fitness Received">
									<input type="hidden" id="fitness-form-calories" name="fitness-form-calories" value="">
								</form>
							</div>

						</div>

					</div>

				</div>
			</div>
		</section><!-- #content end -->
@endsection
