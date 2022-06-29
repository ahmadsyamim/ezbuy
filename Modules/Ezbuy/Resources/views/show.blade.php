@extends('ezbuy::layouts.master')

@section('content')
@livewireStyles
@push('scripts')
@livewireScripts
<script>
   
</script>
@endpush

<!-- Content
		============================================= -->
		<section id="content">
			<div class="">
				<div class="container clearfix">

					<div class="row pricing col-mb-30 mb-4 d-flex justify-content-center">

						<div class="col-md-6 col-lg-4">

							<div class="pricing-box pricing-simple px-5 py-4 bg-light text-center text-md-start">
								<div class="pricing-title">
									{{-- <span class="text-danger">Most Popular</span> --}}
									<h3>{{$data->title}}</h3>
                                    @if ($data->image)
                                    <img src="{{$data->image}}" class="img-thumbnail">
                                    @endif
								</div>
								<div class="pricing-price">
									{{-- <span class="price-unit">€</span> --}}
                                    {{$data->sellprice}}
								</div>
								<div class="pricing-features">
									<ul class="iconlist">
										{{-- <li><i class="icon-check text-smaller"></i> <strong>Premium</strong> Plugins</li> --}}
										{{-- <li><i class="icon-check text-smaller"></i> <strong>SEO</strong> Features</li> --}}
										<li><i class="icon-check text-smaller"></i> <strong>Full</strong> Access</li>
										{{-- <li><i class="icon-check text-smaller"></i> <strong>100</strong> User Accounts</li> --}}
										{{-- <li><i class="icon-check text-smaller"></i> <strong>1 Year</strong> License</li> --}}
										{{-- <li><i class="icon-check text-smaller"></i> <strong>24/7</strong> Support</li> --}}
									</ul>
								</div>
                                @auth
                                <div class="pricing-action d-flex justify-content-center"">
                                    <a href="#" class="btn btn-danger btn-lg">Get Started</a>
                                </div>
                                @else
                                <div class="pricing-action d-flex justify-content-center"">
                                <a href="#" class="btn btn-danger btn-lg">Login</a>
                                </div>
                                <div class="pricing-action d-flex justify-content-center"">
                                <a href="#" class="btn btn-danger btn-lg">Register</a>
                                </div>
                                @endauth
							</div>

						</div>

					</div>
				</div>

			</div>
		</section><!-- #content end -->

{{-- <div class="ui inverted dimmer mainDimmer">
    <div class="ui text loader">Loading</div>
  </div> --}}
@push('scripts')
<!-- You MUST include jQuery before Fomantic -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.3.1/dist/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/fomantic-ui@2.8.8/dist/semantic.min.css">
<script src="https://cdn.jsdelivr.net/npm/fomantic-ui@2.8.8/dist/semantic.min.js"></script>
<script>
    $(function() {
        $(document).on('click','.btn-add-product', function() {
            $('.mainDimmer').addClass('active');
        });
        Livewire.on('postAdded', postId => {
    alert('A post was added with the id of: ' + postId);
})
    window.livewire.on('ProductUpdated', function() {
        alert('A post was added with the id of: ');
    });
});
</script>
@endpush
@endsection
