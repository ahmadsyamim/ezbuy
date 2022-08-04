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
												<h2><a href="blog-single.html">[{{ $list->id }}] [{{ $list->status }}] {{Str::limit($list->title, 33, $end='..')}}</a></h2>
											</div>
											<div class="entry-meta">
												<ul>
													<li><i class="icon-clock"></i>{{ date("Y-m-d H:i", strtotime($list->paid_at)) }} </li>
													@if(in_array($list->status,['3','7','8','9']))
													<li><a data-href="https://republicproxy.my/images/1658853933019httpsjpmercaricomitemm22033001496.png" data-lightbox="iframe" class="newtab"><i class="icon-image"></i> Screenshot</a></li>
													@endif
													<!-- <li><i class="icon-star3 color"></i> <i class="icon-star3 color"></i> <i class="icon-star3 color"></i> <i class="icon-star3 color"></i> <i class="icon-star-half-full color"></i></li> -->
												</ul>
											</div>
											<div class="entry-content">
												<div class="clearfix" style="margin-bottom: 10px;">
													@if(in_array($list->status,['2','3','7','8','9','11','12','13']))
													<i class="i-rounded i-small i-bordered icon-credit-cards"  data-bs-toggle="tooltip" data-bs-placement="top" title="Paid"></i>
													@endif
													@if(in_array($list->status,['3','7','8','9']))
													<i class="i-rounded i-small i-bordered icon-line-shopping-bag"  data-bs-toggle="tooltip" data-bs-placement="top" title="Bought"></i>
													@endif
													@if(in_array($list->status,['7','8','9']))
													<i class="i-rounded i-small i-bordered icon-line-log-in"  data-bs-toggle="tooltip" data-bs-placement="top" title="Received"></i>
													@endif
													@if(in_array($list->status,['8','9']))
													<i class="i-rounded i-small i-bordered icon-plane-departure"  data-bs-toggle="tooltip" data-bs-placement="depart from" title="Ship-out from country"></i>
													@endif
													@if(in_array($list->status,['9']))
													<i class="i-rounded i-small i-bordered icon-check"  data-bs-toggle="tooltip" data-bs-placement="top" title="Complete"></i>
													@endif
													@if(in_array($list->status,['11','12']))
													<i class="i-rounded i-small i-bordered icon-line-cross"  data-bs-toggle="tooltip" data-bs-placement="depart from" title="Fail To Buy, Will Refund"></i>
													@endif
													@if(in_array($list->status,['13']))
													<i class="i-rounded i-small i-bordered icon-money-check-alt"  data-bs-toggle="tooltip" data-bs-placement="top" title="Complete"></i>
													@endif
													
													<!-- <i class="i-rounded i-small i-bordered icon-plane-arrival"  data-bs-toggle="tooltip" data-bs-placement="top" title="arrive at country"></i> -->
													<!-- <i class="i-rounded i-small i-bordered icon-line-log-out"  data-bs-toggle="tooltip" data-bs-placement="top" title="Ship locally"></i> -->
												</div>
												<p class="mb-0">{{ $list->producturl }}</p>
											</div>
										</div>
										<div class="col-lg-auto col-md-4 mt-4 mt-lg-0 text-start text-md-center">
											<div class="hotel-price">
												<b>MYR</b> {{ ($list->sellprice * config('app.rate')) + $list->shippingfee + $list->servicefee }}
											</div>
											<small><em>Total Price</em></small><br>
											@if(in_array($list->status,['2','3','7','8','9','11','12','13']))
											<a data-href="{{ $list->paymentlink }}" class="button button-rounded mt-4 mx-0 newtab"><i class="icon-file-invoice-dollar"></i>RECEIPT</a>
											@endif
											@if(in_array($list->status,['11']))
											<a data-id="{{ $list->id }}" data-bs-toggle="modal" data-bs-target="#RefundAccountModal" class="button button-rounded mt-4 mx-0 bg-danger refundbtn"><i class="icon-line-alert-circle"></i>REFUND</a>
											@endif
										</div>
									</div>
								</div>
								@endforeach

							</div>

							@include('ezbuy::layouts.paging')

							@endif

						</div>

						<div class="modal fade" id="RefundAccountModal" tabindex="-1" role="dialog" aria-labelledby="RefundAccountModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title" id="RefundAccountModalLabel">Refund to This Account</h4>
											<button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-hidden="true"></button>
										</div>
										<div class="modal-body">

										@php $action= route('refundupdate') ; @endphp
										<form class="mb-0" id="refundaccount" method="POST" action="{{ $action }}">
										@csrf
											<div class="form-widget">
												<div class="form-result"></div>

													<div class="form-process">
														<div class="css3-spinner">
															<div class="css3-spinner-scaler"></div>
														</div>
													</div>

													<div class="row">

														<div class="col-sm-8 form-group">
															<label for="bank">Bank <small>*</small></label>
															<select id="bank" name="bank" class="sm-form-control">
															<!-- // #fixlater //bootstrap-select live search -->
																@foreach (config('global.banklist') as $key => $value)
																<option value="{{$value}}" >{{__($value)}}</option>
																@endforeach
															</select>
															<p style="display:none" class="bank error text-danger"></p>
														</div>

														<!-- <div class="col-12 form-group">
															<label for="template-contactform-name">Name <small>*</small></label>
															<input type="text" id="template-contactform-name" name="template-contactform-name" value="" class="sm-form-control" />
														</div> -->

														<div class="col-12 form-group">
															<label for="accno">Acc No <small>*</small></label>
															<input type="text" id="accno" name="accno" value="" class="sm-form-control" />
															<p style="display:none" class="accno error text-danger"></p>
														</div>

														<div class="w-100"></div>

														<div class="col-12 form-group">
															<label for="receipname">Receipient Name <small>*</small></label>
															<input type="text" id="receipname" name="receipname" value="" class="sm-form-control" />
															<p style="display:none" class="receipname error text-danger"></p>
														</div>

													</div>

													<input type="hidden" id="buyid" name="buyid">

													
												</div>
												
												
											</div>
											<div class="modal-footer">
												<button class="button button-3d m-0 refundaccount" type="submit">Submit</button>
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
	});

	$(".refundaccount").click(function(e) {
		e.preventDefault();

		// let formData = new FormData(refundaccount);
		// console.log(formData);
		var form = $('form#refundaccount')[0];
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
					$("form#refundaccount").submit();
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
