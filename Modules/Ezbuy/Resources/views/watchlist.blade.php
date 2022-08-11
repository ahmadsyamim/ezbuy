@extends('ezbuy::layouts.master')

@section('content')
@livewireStyles
@push('scripts')
@livewireScripts

@endpush

		<!-- Page Title
		============================================= -->
		<section id="page-title">

			<div class="container clearfix">
				<h1>Watchlist</h1>
				<span>"Nothing haunts like the things you didn't buy"</span>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<!-- <li class="breadcrumb-item"><a href="#">Widgets</a></li> -->
					<li class="breadcrumb-item active" aria-current="page">Watchlist</li>
				</ol>
			</div>

		</section><!-- #page-title end -->

		<!-- Content
		============================================= -->
		<section id="content">
			<div class="">
				<div class="container clearfix">
					
					<div class="tabs topmargin-lg clearfix" id="tab-3">

					@if( count($lists) < 1 )
					<p class="text-center">You have 0 watchlist. Try once!</p class="text-center">
					@else 
						<ul class="tab-nav clearfix">
							<li><a href="#tabs-9">Watchlist</a></li>
							<!-- <li><a href="#tabs-10">Best sellers</a></li>
							<li><a href="#tabs-11">You may like</a></li> -->
						</ul>

						<div class="tab-container">

							<div class="tab-content" id="tabs-9">

								<div class="shop row gutter-30">
									@foreach( $lists as $key => $list )
									<div class="product col-lg-3 col-md-4 col-sm-6 col-12">
										<div class="grid-inner">
											<div class="product-image" style="max-height:300px; width:300px;">
												<a href="#"><img src="{{ $list->image }}" alt="{{ $list->title }}"></a>
												<a href="#"><img src="{{ $list->image }}" alt="{{ $list->title }}"></a>
												<!-- <div class="sale-flash badge bg-success p-2">50% Off*</div> -->
												<div class="bg-overlay">
													<div class="bg-overlay-content align-items-end justify-content-between fadeIn" data-hover-speed="400">
													<!-- <div class="bg-overlay-content align-items-end justify-content-between fadeIn" data-hover-animate="fadeIn" data-hover-speed="400"> -->
														@if(!empty($list->paymentlink))
														<a href="{{$list->paymentlink}}" class="btn btn-primary me-2">BUY</a>
														@else
														<a data-href="{{ $list->producturl }}" class="btn btn-dark newtab" data-lightbox="ajax" target="_blank"><i class="icon-line2-login"></i></a>
														@endif
													</div>
													<div class="bg-overlay-bg bg-transparent"></div>
												</div>
											</div>
											<div class="product-desc">
												<div class="product-title"><h3><a href="#">[{{$list->id}}]{{Str::limit($list->title, 33, $end='..')}}</a></h3></div>
												<div class="product-price"><ins><b>MYR</b> 149</ins></div>
												<!-- <div class="product-rating">
													<i class="icon-star3"></i>
													<i class="icon-star3"></i>
													<i class="icon-star3"></i>
													<i class="icon-star3"></i>
													<i class="icon-star-half-full"></i>
												</div> -->
											</div>
										</div>
									</div>
									@endforeach

								</div>

								@include('ezbuy::layouts.paging')

							</div>

						</div>
					@endif
					</div>

				</div>

				<div class="section border-top-0 border-bottom-0 mb-0 p-0 bg-transparent footer-stick">
					<div class="container clearfix">

						<div class="row col-mb-50">
							<div class="col-md-6 d-none d-md-flex align-self-end">
								<img src="images/services/4.jpg" alt="Image" class="mb-0">
							</div>

							@livewire('product-add')

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

@include('ezbuy::layouts.notification')

@endpush
@endsection
