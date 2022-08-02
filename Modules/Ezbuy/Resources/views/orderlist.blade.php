@extends('ezbuy::layouts.master')

@section('content')
@livewireStyles
@push('scripts')
@livewireScripts

@endpush

<style>
.entry:not(:first-child) {
    margin-top: unset;
    padding-top: var(--custom-gutter);
	border-top: 1px solid #EEE;
}
</style>	

		<!-- Page Title
		============================================= -->
		<section id="page-title">

			<div class="container clearfix">
				<h1>Orderlist</h1>
				<span><em>"Love your order ? Please leave a review"</em></span>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<!-- <li class="breadcrumb-item"><a href="#">Widgets</a></li> -->
					<li class="breadcrumb-item active" aria-current="page">Orderlist</li>
				</ol>
			</div>

		</section><!-- #page-title end -->

<!-- Content
		============================================= -->
		<!-- Content
		============================================= -->
		<section id="content">
			<div class="content-wrap">
				<div class="container clearfix">

					<div class="row gutter-40 col-mb-80">

						
						<!-- Post Content
						============================================= -->
						<div class="postcontent col-lg-9 order-lg-last">
							@if( count($lists) < 1 )
							<p class="text-center">You have 0 Order. Try once!</p class="text-center">
							@else
							<!-- Posts
							============================================= -->
							<div id="posts" class="row gutter-40 mb-0">

								@foreach( $lists as $key => $list )
								<div class="entry col-12">
									<div class="grid-inner row">
										<div class="col-lg-4">
											<a href="{{ $list->image }}" data-lightbox="image"><img src="{{ $list->image }}" style="max-height:180px;" alt="Bronze Time Hotel"></a>
										</div>
										<div class="col-lg col-md-8 mt-4 mt-lg-0">
											<div class="entry-title title-sm">
												<h2><a href="blog-single.html">{{Str::limit($list->title, 33, $end='..')}}</a></h2>
											</div>
											<div class="entry-meta">
												<ul>
													<li><i class="icon-clock"></i>2022/12/12 15:45 </li>
													@if(in_array($list->status,['3','7','8','9']))
													<li><a data-href="https://republicproxy.my/images/1658853933019httpsjpmercaricomitemm22033001496.png" data-lightbox="iframe" class="newtab"><i class="icon-image"></i> Screenshot</a></li>
													@endif
													<!-- <li><i class="icon-star3 color"></i> <i class="icon-star3 color"></i> <i class="icon-star3 color"></i> <i class="icon-star3 color"></i> <i class="icon-star-half-full color"></i></li> -->
												</ul>
											</div>
											<div class="entry-content">
												<div class="clearfix" style="margin-bottom: 10px;">
													@if(in_array($list->status,['2','3','7','8','9']))
													<i class="i-rounded i-small i-bordered icon-credit-cards"  data-bs-toggle="tooltip" data-bs-placement="top" title="Paid"></i>
													@endif
													@if(in_array($list->status,['3','7','8','9']))
													<i class="i-rounded i-small i-bordered icon-line-shopping-bag"  data-bs-toggle="tooltip" data-bs-placement="top" title="Bought"></i>
													@endif
													@if(in_array($list->status,['7','8','9']))
													<i class="i-rounded i-small i-bordered icon-line-log-in"  data-bs-toggle="tooltip" data-bs-placement="top" title="received"></i>
													@endif
													@if(in_array($list->status,['8','9']))
													<i class="i-rounded i-small i-bordered icon-plane-departure"  data-bs-toggle="tooltip" data-bs-placement="depart from" title="ship-out from country"></i>
													@endif
													@if(in_array($list->status,['9']))
													<i class="i-rounded i-small i-bordered icon-check"  data-bs-toggle="tooltip" data-bs-placement="top" title="Complete"></i>
													@endif
													<!-- <i class="i-rounded i-small i-bordered icon-plane-arrival"  data-bs-toggle="tooltip" data-bs-placement="top" title="arrive at country"></i> -->
													<!-- <i class="i-rounded i-small i-bordered icon-line-log-out"  data-bs-toggle="tooltip" data-bs-placement="top" title="Ship locally"></i> -->
												</div>
												<p class="mb-0">{{ $list->producturl }}</p>
											</div>
										</div>
										<div class="col-lg-auto col-md-4 mt-4 mt-lg-0 text-start text-md-center">
											<div class="hotel-price">
												<b>MYR</b> 49.99 {{ $list->id }} {{ $list->status }}
											</div>
											<small><em>Total Price</em></small><br>
											<a data-href="{{ $list->paymentlink }}" class="button button-rounded mt-4 mx-0 newtab"><i class="icon-file-invoice-dollar"></i>REFUND</a>
										</div>
									</div>
								</div>
								@endforeach

							</div>

							@include('ezbuy::layouts.paging')

							@endif

						</div>

						<!-- Sidebar
						============================================= -->
						<div class="sidebar col-lg-3">
							<div class="sidebar-widgets-wrap">
								<div class="widget clearfix">

									<div class="ps-0 mt-15">

										<form class="row mb-0">
											<div class="form-process">
												<div class="css3-spinner">
													<div class="css3-spinner-scaler"></div>
												</div>
											</div>

											<div class="col-12 form-group">
												<label for="template-contactform-name">NAME/URL :</label>
												<input type="text" id="template-contactform-name" name="template-contactform-name" value="" class="sm-form-control required" placeholder="Air Jordan" />
											</div>

											<div class="col-12">
												<div class="input-daterange travel-date-group row mb-0">
													<div class="col-12 form-group">
														<label for="">Date From :</label>
														<input type="text" value="" class="sm-form-control text-start" name="start" placeholder="mm/dd/yyyy">
													</div>

													<div class="col-12 form-group">
														<label for="">Date Till :</label>
														<input type="text" value="" class="sm-form-control text-start" name="end" placeholder="mm/dd/yyyy">
													</div>
												</div>
											</div>

											<div class="w-100"></div>

											<div class="col-12 form-group d-none">
												<input type="text" id="template-contactform-botcheck" name="template-contactform-botcheck" value="" class="sm-form-control" />
											</div>

											<div class="col-12 form-group mb-0">
												<a href="#" class="button button-3d m-0">Search</a>
											</div>
										</form>

									</div>

								</div>

							</div>

						</div>
					</div>

				</div>
			</div>
		</section><!-- #content end -->

		
		<div class="ui inverted dimmer mainDimmer">
    <div class="ui text loader">Loading</div>
</div>
@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/fomantic-ui@2.8.8/dist/semantic.min.css">
@endpush
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.3.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fomantic-ui@2.8.8/dist/semantic.min.js"></script>

<script type="text/javascript">
	jQuery(window).on( 'load', function(){
		notisuccess("payment successful");
	});

    $("a.newtab").click(function( event ) {
		event.preventDefault();
		var href = $(this).attr('data-href');
		// alert(href);
		window.open(href, "_blank",);

    });

</script>

@include('ezbuy::layouts.notification')

@endpush
@endsection
