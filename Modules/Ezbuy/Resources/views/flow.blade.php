@extends('ezbuy::layouts.master')

@section('content')
@livewireStyles
@push('scripts')
@livewireScripts
<script>
    // function addSearch() {
    //     $('.searchbtn').addClass('is-loading');
    //     var data = $( "#addSearchForm" ).serialize();
        
    //     var jqxhr = $.post( "{{url('/api/addSearch')}}", data, function() {
    //   alert( "success" );
    // })
    //   .done(function() {
    //     alert( "second success" );
    //   })
    //   .fail(function() {
    //     alert( "error" );
    //   })
    //   .always(function() {
    //       alert( "finished" );
    //       $('.searchbtn').removeClass('is-loading');
    //   });
     
    // // Perform other work here ...
     
    // // Set another completion function for the request above
    // // jqxhr.always(function() {
    // //   alert( "second finished" );
    // // });
    // }
</script>
@endpush

<!-- Covid Care Demo Specific Stylesheet -->
<link rel="stylesheet" href="{{ url('/') }}/css/covid-care.css" type="text/css" /> <!-- Covid Care Custom Css -->
<link rel="stylesheet" href="{{ url('/') }}/css/fonts.css" type="text/css" /> <!-- Covid Care Custom Fonts -->

		<!-- Slider / Hero
		============================================= -->
		<div id="slider" class="slider-element dark py-5">

			<div class="container">
				<div class="row">
					<div class="col-lg-5 py-5">
						<h2 class="display-4 color fw-normal font-display">The Threat is the Virus, not the people. We will get through this, Together.</h2>
						<p class="color">Objectively harness robust ROI via functional leadership skills. Holisticly create one-to-one models.</p>
						<!-- <a href="#" class="btn text-larger rounded-pill bg-color text-white px-4 py-2 h-op-09 op-ts">Sign Up</a>
						<a href="#" class="btn text-larger rounded-pill px-4 py-2 ms-2 border-color color h-op-09 op-ts">Download App</a> -->
					</div>
				</div>
			</div>
		</div>

		<!-- Content
		============================================= -->
		<section id="content">
			<div class="content-wrap">

				<div class="container">

					<!-- HOW IS THE FLOW?
					============================================= -->
					<div class="row justify-content-center mt-5">
						<div class="col-md-7 text-center">
							<h3 class="display-4 color fw-bold font-display">HOW IS THE FLOW?</h3>
							<p class="lead" style="line-height: 1.5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis consectetur consequatur possimus asperiores. Vel maxime error cupiditate.</p>
						</div>
					</div>

					<div class="row justify-content-center align-items-center gutter-50 col-mb-80 mt-5">
						<div class="col-xl-9 col-lg-11">
							<div class="row feature-box-border col-mb-30 justify-content-center align-items-center">
								<div class="col-md-6 feature-box fbox-color">
									<div class="fbox-icon">
										<a href="#"><i>1</i></a>
									</div>
									<div class="fbox-content">
										<h3 class="nott text-larger mb-2">Register & Login</h3>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi, quae rerum dolores aperiam amet enim consequuntur maiores totam odit molestiae vel ut earum deleniti.</p>
									</div>
								</div>
								<div class="col-md-4 text-center">
									<img src="{{ asset('images/covid-care/images/illustration/doctors.svg') }}" alt="Image" class="p-4" height="230">
								</div>

								<div class="clear"></div>

								<div class="col-md-6 feature-box fbox-border fbox-light fbox-effect">
									<div class="fbox-icon">
										<a href="#"><i>2</i></a>
									</div>
									<div class="fbox-content">
										<h3 class="nott text-larger mb-2">Do your online shopping</h3>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi, quae rerum dolores aperiam amet enim consequuntur maiores totam odit molestiae vel ut earum deleniti.</p>
									</div>
								</div>
								<div class="col-md-4 text-center">
									<img src="{{ asset('images/covid-care/images/illustration/diet.jpg') }}" alt="Image" class="p-4" height="230">
								</div>

								<div class="clear"></div>

								<div class="col-md-6 feature-box fbox-border fbox-light fbox-effect">
									<div class="fbox-icon">
										<a href="#"><i>3</i></a>
									</div>
									<div class="fbox-content">
										<h3 class="nott text-larger mb-2">Inquiry with Us.</h3>
										<p>Manual or AI</p>
									</div>
								</div>
								<div class="col-md-4 text-center">
									<img src="{{ asset('images/covid-care/images/illustration/nurse.png') }}" alt="Image" class="p-4" height="230">
								</div>

								<div class="clear"></div>

								<div class="col-md-6 feature-box fbox-border fbox-light fbox-effect">
									<div class="fbox-icon">
										<a href="#"><i>4</i></a>
									</div>
									<div class="fbox-content">
										<h3 class="nott text-larger mb-2">Do Pay to Proceed</h3>
										<p>Our team will immediately reply . blabalbalbalba We accept FPX and credict cards.</p>
									</div>
								</div>
								<div class="col-md-4 text-center">
									<img src="{{ asset('images/covid-care/images/illustration/delivery.svg') }}" alt="Image" class="p-4" height="230">
								</div>

								<div class="clear"></div>

								<div class="col-md-6 feature-box fbox-border fbox-light fbox-effect noborder">
									<div class="fbox-icon">
										<a href="#"><i>5</i></a>
									</div>
									<div class="fbox-content">
										<h3 class="nott text-larger mb-2">Receive the item , Leave us a good Review.</h3>
										<p>Blablabalblablablaut earum deleniti.</p>
									</div>
								</div>
								<div class="col-md-4 text-center">
									<img src="{{ asset('images/covid-care/images/illustration/support.svg') }}" alt="Image" class="p-5" height="230">
								</div>

							</div>
						</div>
					</div>

					<!-- Section Mobile
					============================================= -->
					<div class="row justify-content-between align-items-center mt-6 col-mb-50">
						<div class="col-lg-5 order-lg-last">
							<h3 class="display-3 color fw-normal font-display mb-5">Get 24/7 Instant Price with our AI</h3>

							<!-- <p class="text-large color">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur et sequi atque <a href="#" class="bg-color-50 px-1"><u>expedita perferendis tenetur modi</u></a> quia, veniam voluptas repellat mollitia laboriosam nulla sit perspiciatis reprehenderit itaque distinctio facilis amet vel nesciunt quaerat.</p> -->

							<a href="#" class="color fw-bold border-bottom border-width-2 border-color me-2 text-capitalize">Learn more about our App</a><i class="icon-chevron-right icon-stacked text-smaller color"></i>
						</div>
						<div class="col-lg-5">
							<img src="{{ asset('images/covid-care/images/device.png') }}" alt="Phone call" class="rounded">
						</div>
					</div>


				</div>



				<!-- Featured Icons Area
				============================================= -->
				<div class="container topmargin-lg clearfix">

					<div class="pricing-box pricing-extended row align-items-stretch mt-6 mx-0 border-0 rounded-3" style="background-color: rgba(15,100,88,.07);">
						<div class="pricing-desc col-lg-9 p-5">
							<h3 class="h2 color fw-normal font-display border-bottom pb-4 mb-4">Our Subscription Charges</h3>
							<div class="pricing-features bg-transparent pt-3 pb-0">
								<ul class="row">
									<li class="col-md-6"><i class="icon-line-check-circle color me-2"></i> First 15 Days Free*</li>
									<li class="col-md-6"><i class="icon-line-check-circle color me-2"></i> iOS &amp; Android Both Available</li>
									<li class="col-md-6"><i class="icon-line-check-circle color me-2"></i> Only Subscription is Chargable</li>
									<li class="col-md-6"><i class="icon-line-check-circle color me-2"></i> No Hidden Changes</li>
									<li class="col-md-6"><i class="icon-line-check-circle color me-2"></i> International Credit Cards Accepted</li>
									<li class="col-md-6"><i class="icon-line-check-circle color me-2"></i> Money Refund Guaranteed</li>
									<li class="col-md-6"><i class="icon-line-check-circle color me-2"></i> One Day Delivery</li>
									<li class="col-md-6"><i class="icon-line-check-circle color me-2"></i> 24x7 Priority Email Support</li>
								</ul>
							</div>
						</div>

						<div class="pricing-action-area border-0 col-lg d-flex flex-column justify-content-center" style="background-color: rgba(15,100,88,.07);">
							<div class="pricing-price price-unit fw-bold font-primary color">
								<span class="price-unit">&dollar;</span>19<span class="price-tenure font-secondary text-uppercase">Monthly</span>
							</div>
							<div class="pricing-action">
								<a href="#" class="button bg-color rounded-pill button-large w-100 m-0">Get Started</a>
							</div>
						</div>
					</div>

				</div>
			</div>
		</section><!-- #content end -->

@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/fomantic-ui@2.8.8/dist/semantic.min.css">
@endpush
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.3.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fomantic-ui@2.8.8/dist/semantic.min.js"></script>

@endpush
@endsection
