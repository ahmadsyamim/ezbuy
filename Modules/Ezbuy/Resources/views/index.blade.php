@extends('ezbuy::layouts.master')

@section('content')
@livewireStyles
@push('scripts')
@livewireScripts
<script>
    function addSearch() {
        $('.searchbtn').addClass('is-loading');
        var data = $( "#addSearchForm" ).serialize();
        
        var jqxhr = $.post( "{{url('/api/addSearch')}}", data, function() {
      alert( "success" );
    })
      .done(function() {
        alert( "second success" );
      })
      .fail(function() {
        alert( "error" );
      })
      .always(function() {
          alert( "finished" );
          $('.searchbtn').removeClass('is-loading');
      });
     
    // Perform other work here ...
     
    // Set another completion function for the request above
    // jqxhr.always(function() {
    //   alert( "second finished" );
    // });
    }
</script>
@endpush

<!-- Content
		============================================= -->
		<section id="content">
			<div class="">
				<div class="container clearfix">

					<div class="fancy-title title-border title-center topmargin-sm">
						<h4>Popular Brands</h4>
					</div>

					<ul class="clients-grid grid-2 grid-sm-3 grid-md-6 mb-0">
						<li class="grid-item"><a href="#"><img src="images/clients/logo/1.png" alt="Clients"></a></li>
						<li class="grid-item"><a href="#"><img src="images/clients/logo/2.png" alt="Clients"></a></li>
						<li class="grid-item"><a href="#"><img src="images/clients/logo/3.png" alt="Clients"></a></li>
						<li class="grid-item"><a href="#"><img src="images/clients/logo/4.png" alt="Clients"></a></li>
						<li class="grid-item"><a href="#"><img src="images/clients/logo/5.png" alt="Clients"></a></li>
						<li class="grid-item"><a href="#"><img src="images/clients/logo/6.png" alt="Clients"></a></li>
						{{-- <li class="grid-item"><a href="#"><img src="images/clients/logo/7.png" alt="Clients"></a></li>
						<li class="grid-item"><a href="#"><img src="images/clients/logo/8.png" alt="Clients"></a></li>
						<li class="grid-item"><a href="#"><img src="images/clients/logo/9.png" alt="Clients"></a></li>
						<li class="grid-item"><a href="#"><img src="images/clients/logo/10.png" alt="Clients"></a></li>
						<li class="grid-item"><a href="#"><img src="images/clients/logo/11.png" alt="Clients"></a></li>
						<li class="grid-item"><a href="#"><img src="images/clients/logo/12.png" alt="Clients"></a></li>
						<li class="grid-item"><a href="#"><img src="images/clients/logo/13.png" alt="Clients"></a></li>
						<li class="grid-item"><a href="#"><img src="images/clients/logo/14.png" alt="Clients"></a></li>
						<li class="grid-item"><a href="#"><img src="images/clients/logo/15.png" alt="Clients"></a></li>
						<li class="grid-item"><a href="#"><img src="images/clients/logo/16.png" alt="Clients"></a></li>
						<li class="grid-item"><a href="#"><img src="images/clients/logo/19.png" alt="Clients"></a></li>
						<li class="grid-item"><a href="#"><img src="images/clients/logo/18.png" alt="Clients"></a></li> --}}
					</ul>

				</div>

				<div class="section border-top-0 border-bottom-0 mb-0 p-0 bg-transparent footer-stick">
					<div class="container clearfix">

						<div class="row col-mb-50">
							<div class="col-md-6 d-none d-md-flex align-self-end">
								<img src="images/services/4.jpg" alt="Image" class="mb-0">
							</div>

							<div class="col-md-6 mb-5 subscribe-widget">
								<div class="">
									<h3><strong>ENTER YOUR LINK HERE</strong></h3>
									{{-- <span>Our App scales beautifully to different Devices.</span> --}}
								</div>

								{{-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet cumque, perferendis accusamus porro illo exercitationem molestias.</p> --}}

								<livewire:product-add /> 
                                {{-- <div class="input-group" style="max-width:400px;">
                                    <div class="input-group-text"><i class="icon-calculator1"></i></div>
                                    <input type="text" name="link" class="form-control required" placeholder="Enter your product link">
                                    <button class="btn btn-danger" type="submit">Get Total Price</button>
                                </div> --}}
								{{-- <form id="widget-subscribe-form3" action="include/subscribe.php" method="post" class="mb-0">
								</form> --}}
							</div>
						</div>

					</div>
				</div>

                <div class="section mb-0">
					<div class="container">

						<div class="row col-mb-50">
							<div class="col-sm-6 col-lg-3">
								<div class="feature-box fbox-plain fbox-dark fbox-sm">
									<div class="fbox-icon">
										<i class="icon-thumbs-up2"></i>
									</div>
									<div class="fbox-content">
										<h3>100% Original</h3>
										<p class="mt-0">We guarantee you the sale of Original Brands.</p>
									</div>
								</div>
							</div>

							<div class="col-sm-6 col-lg-3">
								<div class="feature-box fbox-plain fbox-dark fbox-sm">
									<div class="fbox-icon">
										<i class="icon-credit-cards"></i>
									</div>
									<div class="fbox-content">
										<h3>Payment Options</h3>
										<p class="mt-0">We accept Visa, MasterCard and American Express.</p>
									</div>
								</div>
							</div>

							<div class="col-sm-6 col-lg-3">
								<div class="feature-box fbox-plain fbox-dark fbox-sm">
									<div class="fbox-icon">
										<i class="icon-truck2"></i>
									</div>
									<div class="fbox-content">
										<h3>Free Shipping</h3>
										<p class="mt-0">Free Delivery to 100+ Locations on orders above $40.</p>
									</div>
								</div>
							</div>

							<div class="col-sm-6 col-lg-3">
								<div class="feature-box fbox-plain fbox-dark fbox-sm">
									<div class="fbox-icon">
										<i class="icon-undo"></i>
									</div>
									<div class="fbox-content">
										<h3>30-Days Returns</h3>
										<p class="mt-0">Return or exchange items purchased within 30 days.</p>
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
@push('scripts')
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
