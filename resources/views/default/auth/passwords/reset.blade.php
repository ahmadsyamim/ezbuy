@extends('voyager-frontend::layouts.default')

@section('content')

<!-- Page Title
		============================================= -->
		<section id="page-title">

			<div class="container clearfix">
				<h1>PASSWORD RESET</h1>
				<span>"Reset your life .... And begin a new one"</span>
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

							<div class="col-lg-4 dark" style="background: linear-gradient(rgba(0,0,0,.8), rgba(0,0,0,.2)), url('https://images.unsplash.com/photo-1609994263276-9311ca68f301?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80') center center / cover; min-height: 400px;">
								<h3 class="center mt-5"></h3>
								<div class="calories-wrap center w-100 px-2">
									<span class="text-uppercase mb-0 ls2"></span>
									<h2 id="calories-count" class="calories display-3 mb-2 heading-block border-bottom-0 fw-semibold font-body py-2"></h2>
									<!-- <span class="text-uppercase h6 ls3">Estimated Calories</span> -->
								</div>
								<small class="center m-0 position-absolute" style="bottom: 12px;">{{ env('APP.NAME') }}</small>
							</div>

							<div class="col-lg-8 p-5">
                                <form class="row mb-0" id="fitness-form" method="POST" action="{{ route('password.request') }}" enctype="multipart/form-data">
                                @csrf                                   
                                <input type="hidden" name="token" value="{{ $token }}">
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
												<input type="email" name="email" class="form-control required" value="{{ $_GET['email'] }}" aria-describedby="emailHelpText" readonly>
                                                @if (!empty($errors) && $errors->has('email'))
                                                    <span class="text-danger">{{ $errors->first('email') }}</span>
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

									<div class="col-12 d-none">
										<input type="text" id="fitness-form-botcheck" name="fitness-form-botcheck" value="" />
									</div>
									<div class="col-12 d-flex justify-content-end align-items-center">
										<button type="submit" name="fitness-form-submit" class="btn btn-success ms-2">RESET</button>
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


@endpush

@endsection
