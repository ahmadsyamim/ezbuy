@extends('ezbuy::layouts.master')

@section('content')
@livewireStyles
@push('scripts')
@livewireScripts

@endpush

<!-- Content
		============================================= -->
		<section id="content">
			<div class="">
				<div class="container clearfix">

					<div class="fancy-title title-border title-center topmargin-sm">
						<h4>THIS IS WATCHLIST</h4>
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
@endpush
@endsection
