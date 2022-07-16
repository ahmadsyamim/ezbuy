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
											<div class="product-image" style="max-height:300px;">
												<a href="#"><img src="{{ $list->image }}" alt="{{ $list->title }}"></a>
												<a href="#"><img src="{{ $list->image }}" alt="{{ $list->title }}"></a>
												<div class="sale-flash badge bg-success p-2">50% Off*</div>
												<div class="bg-overlay">
													<div class="bg-overlay-content align-items-end justify-content-between fadeIn" data-hover-speed="400">
													<!-- <div class="bg-overlay-content align-items-end justify-content-between fadeIn" data-hover-animate="fadeIn" data-hover-speed="400"> -->
														<a href="#" class="btn btn-dark me-2">BUY</a>
														<a href="{{ $list->producturl }}" class="btn btn-dark" data-lightbox="ajax" target="_blank"><i class="icon-line-log-out"></i></a>
													</div>
													<div class="bg-overlay-bg bg-transparent"></div>
												</div>
											</div>
											<div class="product-desc">
												<div class="product-title"><h3><a href="#">{{Str::limit($list->title, 33, $end='..')}}</a></h3></div>
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

							<div class="tab-content" id="tabs-10">

								<div class="shop row gutter-30">

									<div class="product col-lg-3 col-md-4 col-sm-6 col-12">
										<div class="grid-inner">
											<div class="product-image">
												<a href="#"><img src="images/shop/sunglasses/1.jpg" alt="Unisex Sunglasses"></a>
												<a href="#"><img src="images/shop/sunglasses/1-1.jpg" alt="Unisex Sunglasses"></a>
												<div class="sale-flash badge bg-danger p-2">Sale!</div>
												<div class="bg-overlay">
													<div class="bg-overlay-content align-items-end justify-content-between" data-hover-animate="fadeIn" data-hover-speed="400">
														<a href="#" class="btn btn-dark me-2"><i class="icon-shopping-basket"></i></a>
														<a href="include/ajax/shop-item.html" class="btn btn-dark" data-lightbox="ajax"><i class="icon-line-expand"></i></a>
													</div>
													<div class="bg-overlay-bg bg-transparent"></div>
												</div>
											</div>
											<div class="product-desc">
												<div class="product-title"><h3><a href="#">Unisex Sunglasses</a></h3></div>
												<div class="product-price"><del>$19.99</del> <ins>$11.99</ins></div>
												<div class="product-rating">
													<i class="icon-star3"></i>
													<i class="icon-star3"></i>
													<i class="icon-star3"></i>
													<i class="icon-star-empty"></i>
													<i class="icon-star-empty"></i>
												</div>
											</div>
										</div>
									</div>

									<div class="product col-lg-3 col-md-4 col-sm-6 col-12">
										<div class="grid-inner">
											<div class="product-image">
												<a href="#"><img src="images/shop/tshirts/1.jpg" alt="Blue Round-Neck Tshirt"></a>
												<a href="#"><img src="images/shop/tshirts/1-1.jpg" alt="Blue Round-Neck Tshirt"></a>
												<div class="bg-overlay">
													<div class="bg-overlay-content align-items-end justify-content-between" data-hover-animate="fadeIn" data-hover-speed="400">
														<a href="#" class="btn btn-dark me-2"><i class="icon-shopping-basket"></i></a>
														<a href="include/ajax/shop-item.html" class="btn btn-dark" data-lightbox="ajax"><i class="icon-line-expand"></i></a>
													</div>
													<div class="bg-overlay-bg bg-transparent"></div>
												</div>
											</div>
											<div class="product-desc">
												<div class="product-title"><h3><a href="#">Blue Round-Neck Tshirt</a></h3></div>
												<div class="product-price">$9.99</div>
												<div class="product-rating">
													<i class="icon-star3"></i>
													<i class="icon-star3"></i>
													<i class="icon-star3"></i>
													<i class="icon-star-half-full"></i>
													<i class="icon-star-empty"></i>
												</div>
											</div>
										</div>
									</div>

									<div class="product col-lg-3 col-md-4 col-sm-6 col-12">
										<div class="grid-inner">
											<div class="product-image">
												<a href="#"><img src="images/shop/watches/1.jpg" alt="Silver Chrome Watch"></a>
												<a href="#"><img src="images/shop/watches/1-1.jpg" alt="Silver Chrome Watch"></a>
												<div class="bg-overlay">
													<div class="bg-overlay-content align-items-end justify-content-between" data-hover-animate="fadeIn" data-hover-speed="400">
														<a href="#" class="btn btn-dark me-2"><i class="icon-shopping-basket"></i></a>
														<a href="include/ajax/shop-item.html" class="btn btn-dark" data-lightbox="ajax"><i class="icon-line-expand"></i></a>
													</div>
													<div class="bg-overlay-bg bg-transparent"></div>
												</div>
											</div>
											<div class="product-desc">
												<div class="product-title"><h3><a href="#">Silver Chrome Watch</a></h3></div>
												<div class="product-price">$129.99</div>
												<div class="product-rating">
													<i class="icon-star3"></i>
													<i class="icon-star3"></i>
													<i class="icon-star3"></i>
													<i class="icon-star3"></i>
													<i class="icon-star-half-full"></i>
												</div>
											</div>
										</div>
									</div>

									<div class="product col-lg-3 col-md-4 col-sm-6 col-12">
										<div class="grid-inner">
											<div class="product-image">
												<a href="#"><img src="images/shop/shoes/2.jpg" alt="Men Grey Casual Shoes"></a>
												<a href="#"><img src="images/shop/shoes/2-1.jpg" alt="Men Grey Casual Shoes"></a>
												<div class="sale-flash badge bg-danger p-2">Sale!</div>
												<div class="bg-overlay">
													<div class="bg-overlay-content align-items-end justify-content-between" data-hover-animate="fadeIn" data-hover-speed="400">
														<a href="#" class="btn btn-dark me-2"><i class="icon-shopping-basket"></i></a>
														<a href="include/ajax/shop-item.html" class="btn btn-dark" data-lightbox="ajax"><i class="icon-line-expand"></i></a>
													</div>
													<div class="bg-overlay-bg bg-transparent"></div>
												</div>
											</div>
											<div class="product-desc">
												<div class="product-title"><h3><a href="#">Men Grey Casual Shoes</a></h3></div>
												<div class="product-price"><del>$45.99</del> <ins>$39.49</ins></div>
												<div class="product-rating">
													<i class="icon-star3"></i>
													<i class="icon-star3"></i>
													<i class="icon-star-half-full"></i>
													<i class="icon-star-empty"></i>
													<i class="icon-star-empty"></i>
												</div>
											</div>
										</div>
									</div>

								</div>
							</div>

							<div class="tab-content" id="tabs-11">

								<div class="shop row gutter-30">

									<div class="product col-lg-3 col-md-4 col-sm-6 col-12">
										<div class="grid-inner">
											<div class="product-image">
												<div class="fslider" data-arrows="false">
													<div class="flexslider">
														<div class="slider-wrap">
															<div class="slide"><a href="#"><img src="images/shop/dress/3.jpg" alt="Pink Printed Dress"></a></div>
															<div class="slide"><a href="#"><img src="images/shop/dress/3-1.jpg" alt="Pink Printed Dress"></a></div>
															<div class="slide"><a href="#"><img src="images/shop/dress/3-2.jpg" alt="Pink Printed Dress"></a></div>
														</div>
													</div>
												</div>
												<div class="bg-overlay">
													<div class="bg-overlay-content align-items-end justify-content-between" data-hover-animate="fadeIn" data-hover-speed="400">
														<a href="#" class="btn btn-dark me-2"><i class="icon-shopping-basket"></i></a>
														<a href="include/ajax/shop-item.html" class="btn btn-dark" data-lightbox="ajax"><i class="icon-line-expand"></i></a>
													</div>
													<div class="bg-overlay-bg bg-transparent"></div>
												</div>
											</div>
											<div class="product-desc">
												<div class="product-title"><h3><a href="#">Pink Printed Dress</a></h3></div>
												<div class="product-price">$39.49</div>
												<div class="product-rating">
													<i class="icon-star3"></i>
													<i class="icon-star3"></i>
													<i class="icon-star3"></i>
													<i class="icon-star-empty"></i>
													<i class="icon-star-empty"></i>
												</div>
											</div>
										</div>
									</div>

									<div class="product col-lg-3 col-md-4 col-sm-6 col-12">
										<div class="grid-inner">
											<div class="product-image">
												<a href="#"><img src="images/shop/pants/5.jpg" alt="Green Trousers"></a>
												<a href="#"><img src="images/shop/pants/5-1.jpg" alt="Green Trousers"></a>
												<div class="sale-flash badge bg-danger p-2">Sale!</div>
												<div class="bg-overlay">
													<div class="bg-overlay-content align-items-end justify-content-between" data-hover-animate="fadeIn" data-hover-speed="400">
														<a href="#" class="btn btn-dark me-2"><i class="icon-shopping-basket"></i></a>
														<a href="include/ajax/shop-item.html" class="btn btn-dark" data-lightbox="ajax"><i class="icon-line-expand"></i></a>
													</div>
													<div class="bg-overlay-bg bg-transparent"></div>
												</div>
											</div>
											<div class="product-desc">
												<div class="product-title"><h3><a href="#">Green Trousers</a></h3></div>
												<div class="product-price"><del>$24.99</del> <ins>$21.99</ins></div>
												<div class="product-rating">
													<i class="icon-star3"></i>
													<i class="icon-star3"></i>
													<i class="icon-star3"></i>
													<i class="icon-star-half-full"></i>
													<i class="icon-star-empty"></i>
												</div>
											</div>
										</div>
									</div>

									<div class="product col-lg-3 col-md-4 col-sm-6 col-12">
										<div class="grid-inner">
											<div class="product-image">
												<a href="#"><img src="images/shop/sunglasses/2.jpg" alt="Men Aviator Sunglasses"></a>
												<a href="#"><img src="images/shop/sunglasses/2-1.jpg" alt="Men Aviator Sunglasses"></a>
												<div class="bg-overlay">
													<div class="bg-overlay-content align-items-end justify-content-between" data-hover-animate="fadeIn" data-hover-speed="400">
														<a href="#" class="btn btn-dark me-2"><i class="icon-shopping-basket"></i></a>
														<a href="include/ajax/shop-item.html" class="btn btn-dark" data-lightbox="ajax"><i class="icon-line-expand"></i></a>
													</div>
													<div class="bg-overlay-bg bg-transparent"></div>
												</div>
											</div>
											<div class="product-desc">
												<div class="product-title"><h3><a href="#">Men Aviator Sunglasses</a></h3></div>
												<div class="product-price">$13.49</div>
												<div class="product-rating">
													<i class="icon-star3"></i>
													<i class="icon-star3"></i>
													<i class="icon-star3"></i>
													<i class="icon-star3"></i>
													<i class="icon-star-empty"></i>
												</div>
											</div>
										</div>
									</div>

									<div class="product col-lg-3 col-md-4 col-sm-6 col-12">
										<div class="grid-inner">
											<div class="product-image">
												<a href="#"><img src="images/shop/tshirts/4.jpg" alt="Black Polo Tshirt"></a>
												<a href="#"><img src="images/shop/tshirts/4-1.jpg" alt="Black Polo Tshirt"></a>
												<div class="bg-overlay">
													<div class="bg-overlay-content align-items-end justify-content-between" data-hover-animate="fadeIn" data-hover-speed="400">
														<a href="#" class="btn btn-dark me-2"><i class="icon-shopping-basket"></i></a>
														<a href="include/ajax/shop-item.html" class="btn btn-dark" data-lightbox="ajax"><i class="icon-line-expand"></i></a>
													</div>
													<div class="bg-overlay-bg bg-transparent"></div>
												</div>
											</div>
											<div class="product-desc">
												<div class="product-title"><h3><a href="#">Black Polo Tshirt</a></h3></div>
												<div class="product-price">$11.49</div>
												<div class="product-rating">
													<i class="icon-star3"></i>
													<i class="icon-star3"></i>
													<i class="icon-star3"></i>
													<i class="icon-star3"></i>
													<i class="icon-star3"></i>
												</div>
											</div>
										</div>
									</div>

								</div>

							</div>

						</div>

					</div>

				</div>

				<div class="section border-top-0 border-bottom-0 mb-0 p-0 bg-transparent footer-stick">
					<div class="container clearfix">

						<div class="row col-mb-50">
							<div class="col-md-6 d-none d-md-flex align-self-end">
								<img src="images/services/4.jpg" alt="Image" class="mb-0">
							</div>

							<div class="col-md-6 mb-5 subscribe-widget">
								<div class="heading-block">
									<h3><strong>GET 20% OFF*</strong></h3>
									<span>Our App scales beautifully to different Devices.</span>
								</div>

								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet cumque, perferendis accusamus porro illo exercitationem molestias.</p>

								<div class="widget-subscribe-form-result"></div>
								<form id="widget-subscribe-form3" action="include/subscribe.php" method="post" class="mb-0">
									<div class="input-group" style="max-width:400px;">
										<div class="input-group-text"><i class="icon-email2"></i></div>
										<input type="email" name="widget-subscribe-form-email" class="form-control required email" placeholder="Enter your Email">
										<button class="btn btn-danger" type="submit">Subscribe Now</button>
									</div>
								</form>
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
