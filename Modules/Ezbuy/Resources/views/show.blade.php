@extends('ezbuy::layouts.master')

@section('content')
@livewireStyles
@push('scripts')
@livewireScripts
<script>
    $(document).ready(function () {
        $.fn.api.settings.api = {
            'get followers': '/followers/{id}?results={count}',
            'create user': '/create',
            'follow user': '/follow',
            'add user': '/add/{id}',
            'search': '/query/{query}/{/sort}'
        };
        $('.follow.button')
            .api({
                action: 'follow user',
                on: 'now'
            });

        $.ajax({
            url: "test.html",
            context: document.body
        }).done(function () {
            $(this).addClass("done");
        });
    });
</script>
@endpush

<!-- Content
		============================================= -->
		<section id="content">
			<div class="">
				<div class="container clearfix">

					@livewire('show-product', ['data' => $data])

				</div>
			</div>
		</section><!-- #content end -->

{{-- <div class="ui inverted dimmer mainDimmer">
    <div class="ui text loader">Loading</div>
  </div> --}}
@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/fomantic-ui@2.8.8/dist/semantic.min.css">
@endpush
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.3.1/dist/jquery.min.js"></script>
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
