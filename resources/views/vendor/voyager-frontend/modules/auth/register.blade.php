@extends('voyager-frontend::layouts.default')

@section('content')

<link
     rel="stylesheet"
     href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"
   />
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

<!-- Page Title
		============================================= -->
		<section id="page-title">

			<div class="container clearfix">
				<h1>Register</h1>
				<span>"If opportunity doesn't knock, build a door"</span>
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

					<div> <!--form-widget-->

						<div class="form-result"></div>

						<div class="row shadow bg-light border">

							<div class="col-lg-4 dark" style="background: linear-gradient(rgba(0,0,0,.8), rgba(0,0,0,.2)), url('https://images.unsplash.com/photo-1523705480679-b5d0cc17a656?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=735&q=80') center center / cover; min-height: 400px;">
								<h3 class="center mt-5">Knowledge will give you power but Character will give you respect.</h3>
								<div class="calories-wrap center w-100 px-2">
									<!-- <span class="text-uppercase mb-0 ls2">Loosing Fat</span> -->
									<h2 id="calories-count" class="calories display-3 mb-2 heading-block border-bottom-0 fw-semibold font-body py-2"></h2>
									<!-- <span class="text-uppercase h6 ls3">Estimated Calories</span> -->
								</div>
								<small class="center m-0 position-absolute" style="bottom: 12px;">Bruce Lee</small>
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
												<label for="email">Email:</label>
											</div>
											<div class="col-sm-10">
												<input type="email" name="email" class="form-control required" value="{{ old('email') }}" placeholder="Enter your Email" aria-describedby="emailHelpText">
                                                @if (!empty($errors) && $errors->has('email'))
                                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                                @endif                                               
											</div>
										</div>
									</div>

									<div class="col-12 form-group">
										<div class="row">
											<div class="col-sm-2 col-form-label">
												<label for="name">Name:</label>
											</div>
											<div class="col-sm-10">
												<input type="text" name="name" id="name" class="form-control required" value="{{ old('name') }}" placeholder="Enter your Full Name" aria-describedby="nameHelpText">
                                                @if (!empty($errors) && $errors->has('name'))
                                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                                @endif                               
											</div>
										</div>
									</div>
									<div class="col-12 form-group">
										<div class="row">
											<div class="col-sm-2 col-form-label">
												<label for="fitness-form-phone">Phone:</label>
											</div>
											<div class="col-sm-5">
												<div class="input-group">
													<input id="phone" type="tel" name="phone_number" class="form-control required" value="{{ old('phone_number') }}">
												</div>	
												@if (!empty($errors) && $errors->has('phone_number'))
												<span class="text-danger">{{ $errors->first('phone_number') }}</span>
												@endif
											</div>
										</div>
									</div>
									<div class="col-12 form-group">
										<div class="row">
											<div class="col-sm-2 col-form-label">
												<label for="password">Password:</label>
											</div>
											<div class="col-sm-5">
                                                <input type="password" name="password" id="password" class="form-control required" value="" placeholder="Password" aria-describedby="passwordHelpText">
                                                @if (!empty($errors) && $errors->has('password'))
                                                    <span class="text-danger">{{ $errors->first('password') }}</span>
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
                                                    <input type="password" id="password-confirm" name="password_confirmation" class="form-control required" value="" placeholder="Confirm Password">
												</div>
											</div>
										</div>
									</div>

                                    <div class="divider divider-center" style="color:#555;">Shipping Address &nbsp; <i class="icon-address-card"></i></div>

									<div class="col-12 form-group">
										<div class="row">
											<div class="col-sm-2 col-form-label">
												<label for="name">SA Name:</label>
											</div>
											<div class="col-sm-10">
												<div class="input-group">
													<input type="text" name="saname" class="form-control required" value="{{ old('saname') }}" placeholder="Full Name">
												</div>
												@if (!empty($errors) && $errors->has('saname'))
												<span class="text-danger">{{ $errors->first('saname') }}</span>
												@endif                               
											</div>
										</div>
									</div>

									<div class="col-12 form-group">
										<div class="row">
											<div class="col-sm-2 col-form-label">
												<label for="fitness-form-phone">SA Phone:</label>
											</div>
											<div class="col-sm-5">
												<div class="input-group">
													<input id="saphone" type="tel" name="saphone_number" class="form-control required" value="{{ old('saphone_number') }}">
												</div>
												@if (!empty($errors) && $errors->has('saphone_number'))
												<span class="text-danger">{{ $errors->first('saphone_number') }}</span>
												@endif 
											</div>
										</div>
									</div>
									<div class="col-12 form-group">
										<div class="row">
											<div class="col-sm-2 col-form-label">
												<label for="fitness-form-phone">SA Address 1:</label>
											</div>
											<div class="col-sm-10">
												<div class="input-group">
													<input type="text" name="saaddress1" class="form-control required" value="{{ old('saaddress1') }}" placeholder="Address1" aria-describedby="nameHelpText">
												</div>
												@if (!empty($errors) && $errors->has('saaddress1'))
												<span class="text-danger">{{ $errors->first('saaddress1') }}</span>
												@endif 
											</div>
										</div>
									</div>

									<div class="col-12 form-group">
										<div class="row">
											<div class="col-sm-2 col-form-label">
												<label for="fitness-form-phone">SA Address 2:</label>
											</div>
											<div class="col-sm-10">
												<div class="input-group">
													<input type="text" name="saaddress2" class="form-control required" value="{{ old('saaddress2') }}" placeholder="Optional" aria-describedby="nameHelpText">
												</div>
											</div>
										</div>
									</div>

									<div class="col-12 form-group">
										<div class="row">
											<div class="col-sm-2 col-form-label">
												<label for="fitness-form-weight">SA Postcode:</label>
											</div>
											<div class="col-sm-5">
												<div class="input-group">
                                                    <input type="text" name="sapostcode" class="form-control required" value="{{ old('postcode') }}" placeholder="Postcode">
												</div>
												@if (!empty($errors) && $errors->has('sapostcode'))
												<span class="text-danger">{{ $errors->first('sapostcode') }}</span>
												@endif  
											</div>
										</div>
									</div>

									<div class="col-12 form-group">
										<div class="row">
											<div class="col-sm-2 col-form-label">
												<label for="fitness-form-phone">SA City:</label>
											</div>
											<div class="col-sm-5">
												<div class="input-group">
													<input type="text" name="sacity" class="form-control required" value="{{ old('sacity') }}" placeholder="City" aria-describedby="nameHelpText">
												</div>
												@if (!empty($errors) && $errors->has('sacity'))
												<span class="text-danger">{{ $errors->first('sacity') }}</span>
												@endif 
											</div>
										</div>
									</div>

									<div class="col-12 form-group">
										<div class="row">
											<div class="col-sm-2 col-form-label">
												<label for="fitness-form-phone">SA State:</label>
											</div>
											<div class="col-sm-5">
												<div class="input-group">
													<input type="text" name="sastate" class="form-control required" value="{{ old('sastate') }}" placeholder="State" aria-describedby="nameHelpText">
												</div>
												@if (!empty($errors) && $errors->has('sastate'))
												<span class="text-danger">{{ $errors->first('sastate') }}</span>
												@endif 
											</div>
										</div>
									</div>
                                    

									<div class="col-12 d-none">
										<input type="text" id="fitness-form-botcheck" name="fitness-form-botcheck" value="" />
									</div>
									<div class="col-12 d-flex justify-content-end align-items-center">
										<button type="submit" name="fitness-form-submit" class="btn btn-success ms-2">REGISTER</button>
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

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.3.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fomantic-ui@2.8.8/dist/semantic.min.js"></script>

<script>
    $([document.documentElement, document.body]).animate({
        scrollTop: $(".text-danger").offset().top - $(window).height()/2
    }, 1500);
</script>

<script>
	const phoneInputField = document.querySelector("#phone");
	const phoneInput = window.intlTelInput(phoneInputField, {
		initialCountry: "auto",
		geoIpLookup: getIp,
		preferredCountries: ["my", "sg"],
		utilsScript:
		"https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
	});

	const saphoneInputField = document.querySelector("#saphone");
	const saphoneInput = window.intlTelInput(saphoneInputField, {
		initialCountry: "auto",
		geoIpLookup: getIp,
		preferredCountries: ["my", "sg"],
		utilsScript:
		"https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
	});

	console.log(saphoneInput);

	alert('2121');

	function getIp(callback) {
		fetch('https://ipinfo.io/json?token=4ea90b6207ed28', { headers: { 'Accept': 'application/json' }})
		.then((resp) => resp.json())
		.catch(() => {
			return {
				country: 'us',
			};
		})
		.then((resp) => callback(resp.country));
	}

   //https://www.twilio.com/blog/international-phone-number-input-html-javascript // fix later
	
</script>

@endpush

@endsection
