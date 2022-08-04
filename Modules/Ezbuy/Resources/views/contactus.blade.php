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
<style>
   .iti {
      width: 100%;
   }
</style>

<link
     rel="stylesheet"
     href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"
   />
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

<section id="map-overlay">
   <div class="container">
      <div class="row">
         <!-- Contact Form Overlay
            ============================================= -->
         <div class="contact-form-overlay col-md-8 offset-md-2 p-5">
            <div class="fancy-title title-border">
               <h3>Send us an Email</h3>
            </div>
            @php $action= route('contactsubmit') ; @endphp
            <form id="contactsubmit" method="POST" action="{{ $action }}" enctype="multipart/form-data">
            @csrf
               <div class="form-widget">
                  <div class="form-result"></div>

                     <div class="form-process">
                        <div class="css3-spinner">
                           <div class="css3-spinner-scaler"></div>
                        </div>
                     </div>

                     <div class="row">
                        <div class="col-md-6 form-group">
                           <label for="name">Name <small>*</small></label>
                           <input type="text" id="name" name="name" value="{{ old('name') ?? Auth::user()->name ?? '' }}" class="sm-form-control" />
                           <p style="display:none" class="name error text-danger"></p>
                        </div>

                        <div class="col-md-6 form-group">
                           <label for="email">Email <small>*</small></label>
                           <input type="email" id="email" name="email" value="{{ old('email') ?? Auth::user()->email ?? '' }}" class="email sm-form-control" />
                           <p style="display:none" class="email error text-danger"></p>
                        </div>

                        <div class="w-100"></div>

                        <div class="col-md-6 form-group">
                           <label for="phone_number">Phone</label>
                           <div><input type="tel" id="phone" name="phone_number" value="{{ old('phone_number') ?? Auth::user()->phone_number ?? '' }}" class="sm-form-control" /></div>
                           <p style="display:none" class="phone_number error text-danger"></p>
                        </div>

                        <div class="col-md-6 form-group">
                           <label for="subject">Subject <small>*</small></label>
                           <select id="subject" name="subject" class="sm-form-control">
                              @foreach (config('global.contactsubject') as $key => $value)
                              <option value="{{$key}}" >{{__($value)}}</option>
                              @endforeach
                           </select>
                           <p style="display:none" class="subject error text-danger"></p>
                        </div>

                        <div class="w-100"></div>

                        <div class="col-sm-6 form-group">
                           <label for="template-contactform-message">Upload </label>
                           <input type="file" id="attachement" name="attachement" class="required sm-form-control" />
                           <p style="display:none" class="attachement error text-danger"></p>
                        </div>

                        <div class="w-100"></div>

                        <div class="col-12 form-group">
                           <label for="message">Message <small>*</small></label>
                           <textarea class="sm-form-control" id="message" name="message" rows="8" cols="30"></textarea>
                           <p style="display:none" class="message error text-danger"></p>
                        </div>

                        <div class="col-12 form-group d-none">
                           <input type="text" id="ipaddress" name="ipaddress" value="{{$_SERVER['REMOTE_ADDR'] ?? ''}}" class="sm-form-control" />
                           <input type="text" id="agent" name="agent" value="{{$_SERVER['HTTP_USER_AGENT'] ?? ''}}" class="sm-form-control" />
                        </div>

                        <div class="col-12 form-group">
                           <button class="button button-3d m-0 contactsubmit" type="submit">Send Message</button>
                        </div>
                     </div>


               </div>
            </form>
            <!-- <div class="line"></div>
            <div class="row col-mb-50">

               <div class="col-md-4">
                  <address>
                     <strong>Headquarters:</strong><br>
                     795 Folsom Ave, Suite 600<br>
                     San Francisco, CA 94107<br>
                  </address>
                  <abbr title="Phone Number"><strong>Phone:</strong></abbr> (1) 8547 632521<br>
                  <abbr title="Fax"><strong>Fax:</strong></abbr> (1) 11 4752 1433<br>
                  <abbr title="Email Address"><strong>Email:</strong></abbr> info@canvas.com
               </div>

            </div> -->
         </div>
         <!-- Contact Form Overlay End -->
      </div>
   </div>
   <!-- Google Map
      ============================================= -->
   <section class="gmap">
   <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d810.809079194378!2d139.6307450292426!3d35.62190028891785!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xaf3d2fd34eac32f7!2zMzXCsDM3JzE4LjgiTiAxMznCsDM3JzUyLjciRQ!5e0!3m2!1sen!2sjp!4v1659464681347!5m2!1sen!2sjp" width="1800" height="1000" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
   </section>
</section>




@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/fomantic-ui@2.8.8/dist/semantic.min.css">
@endpush
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.3.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fomantic-ui@2.8.8/dist/semantic.min.js"></script>

<script>
    $([document.documentElement, document.body]).animate({
        scrollTop: $(".text-danger").offset().top - $(window).height()/2
    }, 1500);
</script>

<script>

   $('#message').attr('placeholder', "Example:\nInquiry for product below:\nhttps://jp.mercari.com/item/m29965203635\n\nLooking forward for your reply,\nThank you.");

	const phoneInputField = document.querySelector("#phone");
	const phoneInput = window.intlTelInput(phoneInputField, {
		initialCountry: "auto",
		geoIpLookup: getIp,
		preferredCountries: ["my", "sg"],
		utilsScript:
		"https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
	});

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

   $("#phone").blur(function() {
      const phoneNumber = phoneInput.getNumber();
      // alert(phoneNumber);
      $("input#phone").val(phoneNumber);
   });

   //https://www.twilio.com/blog/international-phone-number-input-html-javascript // fix later

	$(".contactsubmit").click(function(e) {
		e.preventDefault();

		// let formData = new FormData(contactsubmit);
		// console.log(formData);
		var form = $('form#contactsubmit')[0];
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
					$("form#contactsubmit").submit();
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

@include('ezbuy::layouts.notification')

@endpush
@endsection
