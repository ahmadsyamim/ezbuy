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

<section id="map-overlay">
   <div class="container">
      <div class="row">
         <!-- Contact Form Overlay
            ============================================= -->
         <div class="contact-form-overlay col-md-8 offset-md-2 p-5">
            <div class="fancy-title title-border">
               <h3>Send us an Email</h3>
            </div>
            <div class="form-widget">
               <div class="form-result"></div>
               <!-- Contact Form
                  ============================================= -->
               <form class="row mb-0" id="template-contactform" name="template-contactform" action="include/form.php" method="post" enctype="multipart/form-data">
                  <div class="col-md-6 form-group">
                     <label for="template-contactform-name">Name <small>*</small></label>
                     <input type="text" id="template-contactform-name" name="template-contactform-name" value="" class="sm-form-control required" />
                  </div>
                  <div class="col-md-6 form-group">
                     <label for="template-contactform-email">Email <small>*</small></label>
                     <input type="email" id="template-contactform-email" name="template-contactform-email" value="" class="required email sm-form-control" />
                  </div>
                  <div class="w-100"></div>
                  <div class="col-md-6 form-group">
                     <label for="template-contactform-phone">Phone</label>
                     <input type="text" id="template-contactform-phone" name="template-contactform-phone" value="" class="sm-form-control" />
                  </div>
                  <div class="col-md-6 form-group">
                     <label for="template-contactform-service">Services</label>
                     <select id="template-contactform-service" name="template-contactform-service" class="sm-form-control">
                        <option value="">-- Select One --</option>
                        <option value="Wordpress">Wordpress</option>
                        <option value="PHP / MySQL">PHP / MySQL</option>
                        <option value="HTML5 / CSS3">HTML5 / CSS3</option>
                        <option value="Graphic Design">Graphic Design</option>
                     </select>
                  </div>
                  <div class="w-100"></div>
                  <div class="col-md-6 form-group">
                     <label for="template-contactform-subject">Subject <small>*</small></label>
                     <input type="text" id="template-contactform-subject" name="subject" value="" class="required sm-form-control" />
                  </div>
                  <div class="col-md-6 form-group">
                     <label for="template-contactform-message">Upload CV <small>*</small></label>
                     <input type="file" id="template-contactform-file" name="template-contactform-file" class="required sm-form-control" />
                  </div>
                  <div class="w-100"></div>
                  <div class="col-12 form-group">
                     <label for="template-contactform-message">Message <small>*</small></label>
                     <textarea class="required sm-form-control" id="template-contactform-message" name="template-contactform-message" rows="6" cols="30"></textarea>
                  </div>
                  <div class="col-12 form-group d-none">
                     <input type="text" id="template-contactform-botcheck" name="template-contactform-botcheck" value="" class="sm-form-control" />
                  </div>
                  <div class="col-12 form-group">
                     <button class="button button-3d m-0" type="submit" id="template-contactform-submit" name="template-contactform-submit" value="submit">Send Message</button>
                  </div>
                  <input type="hidden" name="prefix" value="template-contactform-">
               </form>
            </div>
            <div class="line"></div>
            <div class="row col-mb-50">
               <!-- Contact Info
                  ============================================= -->
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
               <!-- Contact Info End -->
               <!-- Testimonails
                  ============================================= -->
				{{--
				<div class="col-md-8">
                  <div class="fslider customjs testimonial twitter-scroll twitter-feed" data-username="envato" data-count="4" data-animation="slide" data-arrows="false">
                     <i class="i-plain color icon-twitter mb-0" style="margin-right: 15px;"></i>
                     <div class="flexslider" style="width: auto;">
                        <div class="slider-wrap">
                           <div class="slide"></div>
                        </div>
                     </div>
                  </div>
                </div>
				--}}
               <!-- Testimonials End -->
            </div>
         </div>
         <!-- Contact Form Overlay End -->
      </div>
   </div>
   <!-- Google Map
      ============================================= -->
   <section class="gmap">
   <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d810.809079194378!2d139.6307450292426!3d35.62190028891785!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xaf3d2fd34eac32f7!2zMzXCsDM3JzE4LjgiTiAxMznCsDM3JzUyLjciRQ!5e0!3m2!1sen!2sjp!4v1659464681347!5m2!1sen!2sjp" width="1800" height="1200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
   </section>
</section>




@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/fomantic-ui@2.8.8/dist/semantic.min.css">
@endpush
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.3.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fomantic-ui@2.8.8/dist/semantic.min.js"></script>
<script>
    $(function () {
        $(document).on('click', '.btn-add-product', function () {
            $(this).addClass('loading');
        });
    });
</script>
@endpush
@endsection
