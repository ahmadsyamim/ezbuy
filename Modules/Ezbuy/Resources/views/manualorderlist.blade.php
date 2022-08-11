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
				<h1>Manual Order List</h1>
				<span><em>Admin Management</em></span>
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
							<p class="text-center">You have 0 list!</p class="text-center">
							@else
							<!-- Posts
							============================================= -->
							<div id="posts" class="row gutter-40 mb-0">

								@foreach( $lists as $key => $list )
								<div class="entry col-12">
									<div class="grid-inner row">
										<div class="col-lg-4">
											<a data-href="{{ $list->producturl }}" class="newtab" data-lightbox="image"><img src="{{ $list->image }}" style="max-height:180px;" alt="Bronze Time Hotel"></a>
										</div>
										<div class="col-lg col-md-8 mt-4 mt-lg-0">
											<div class="entry-title title-sm">
												<h2><a href="blog-single.html">[ID: {{ $list->id }}]{{Str::limit($list->title, 33, $end='..')}}</a></h2>
											</div>
											<div class="entry-meta">
												<ul>
													<li><i class="icon-clock"></i>{{ date("Y-m-d H:i", strtotime($list->created_at)) }} </li>
													<!-- <li><i class="icon-star3 color"></i> <i class="icon-star3 color"></i> <i class="icon-star3 color"></i> <i class="icon-star3 color"></i> <i class="icon-star-half-full color"></i></li> -->
												</ul>
											</div>
											<div class="entry-content">
												<p class="mb-0"><a data-href="{{ $list->producturl }}" class="newtab">{{ $list->producturl }}</a></p>
											</div>
										</div>
										<div class="col-lg-auto col-md-4 mt-4 mt-lg-0 text-start text-md-center">
											<div class="hotel-price">
												<b>MYR</b> {{ ($list->sellprice * config('app.rate')) }}
											</div>
											<small><em>Total Price</em></small><br>
											<a data-id="{{ $list->id }}" data-itemprice="{{ ($list->sellprice * config('app.rate')) }}" data-bs-toggle="modal" data-bs-target="#manualupdateModal" class="button button-rounded mt-4 mx-0 bg-danger refundbtn"><i class="icon-line-alert-circle"></i>UPDATE</a>
										</div>
									</div>
								</div>
								@endforeach

							</div>

							@include('ezbuy::layouts.paging')

							@endif

						</div>

						<div class="modal fade" id="manualupdateModal" tabindex="-1" role="dialog" aria-labelledby="manualupdateModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title" id="manualupdateModalLabel">Update this order</h4>
											<button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-hidden="true"></button>
										</div>
										<div class="modal-body">

										@php $action= route('manualupdate') ; @endphp
										<form class="mb-0" id="manualupdate" method="POST" action="{{ $action }}">
										@csrf
											<div class="form-widget">
												<div class="form-result"></div>

													<div class="form-process">
														<div class="css3-spinner">
															<div class="css3-spinner-scaler"></div>
														</div>
													</div>

													<div class="row">

														<div class="col-12 form-group">
															<label for="itemprice">Item Price <small>*</small></label>
															<input type="text" id="itemprice" value="" class="sm-form-control" disabled/>
														</div>

														<div class="col-12 form-group">
															<label for="shippingfee">Shipping <small>*</small></label>
															<input type="text" id="shippingfee" name="shippingfee" value="" class="sm-form-control" />
															<p style="display:none" class="shippingfee error text-danger"></p>
														</div>

														<div class="w-100"></div>

														<div class="col-12 form-group">
															<label for="servicefee">Service fee <small>*</small></label>
															<input type="text" id="servicefee" name="servicefee" value="" class="sm-form-control" />
															<p style="display:none" class="servicefee error text-danger"></p>
														</div>

													</div>

													<input type="hidden" id="buyid" name="buyid">

													
												</div>
												
												
											</div>
											<div class="modal-footer">
												<button class="button button-3d m-0 manualupdate" type="submit">Submit</button>
												<!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
											</div>
										</form>
									</div><!-- /.modal-content -->
								</div><!-- /.modal-dialog -->
							</div><!-- /.modal -->
							<!-- Modal Contact Form End -->

						<!-- Sidebar
						============================================= -->
						<div class="sidebar col-lg-3">
							<div class="sidebar-widgets-wrap">
								<div class="widget clearfix">

									<div class="ps-0 mt-15">

										<form class="row mb-0" action="{{ url()->current() }}" method="GET">
											<div class="form-process">
												<div class="css3-spinner">
													<div class="css3-spinner-scaler"></div>
												</div>
											</div>

											<div class="col-12 form-group">
												<label for="kword">PRODUCT NAME/URL :</label>
												<input type="text" id="kword" name="kword" value="{{ $_GET['kword'] ?? '' }}" class="sm-form-control required" placeholder="Air Jordan" />
											</div>

											<div class="col-12">
												<div class="input-daterange travel-date-group row mb-0">
													<div class="col-12 form-group">
														<label for="">Date From :</label>
														<input type="date" value="{{ $_GET['start'] ?? '' }}" class="sm-form-control text-start" name="start" placeholder="mm/dd/yyyy">
													</div>

													<div class="col-12 form-group">
														<label for="">Date Till :</label>
														<input type="date" value="{{ $_GET['end'] ?? '' }}" class="sm-form-control text-start" name="end" placeholder="mm/dd/yyyy">
													</div>
												</div>
											</div>

											<div class="w-100"></div>

											<div class="col-12 form-group mb-0">
												<button class="button button-3d m-0" type="submit">SEARCH</button>
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

@include('ezbuy::layouts.notification')

<script type="text/javascript">


	$(".refundbtn").click(function() {
		$("input#buyid").val($(this).attr("data-id"));
		$("input#itemprice").val($(this).attr("data-itemprice"));
	});

	$(".manualupdate").click(function(e) {
		e.preventDefault();

		// let formData = new FormData(manualupdate);
		// console.log(formData);
		var form = $('form#manualupdate')[0];
		var formData = new FormData(form);

		console.log(formData);
		$.ajax({
			url: "{{ $action }}",
			type: 'POST',
			data: formData,
			contentType: false,
			processData: false,
			success: function(data) {
				if ($.isEmptyObject(data.error)) {
					console.log('okkk :::',data.success);
					$("form#manualupdate").submit();
                    // alert(data.success);
                    // location.reload();

				} else {
					// alert("err");
					console.log(data.error);
					$('.error').hide()
					$.each(data.error, function(key, value) {
						$('.error.' + key).text(value[0])
						$('.error.' + key).show()
					});
				}
			},
			fail: function(data) {
				alert("API fail [0001]");
			}
		});
	});

</script>



@endpush
@endsection
