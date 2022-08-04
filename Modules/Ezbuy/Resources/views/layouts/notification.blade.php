<div id="notification-pop" data-notify-position="top-center" data-notify-type="success" data-notify-msg="<i class='icon-ok-sign me-1'></i> Message Sent Successfully!"></div>
<script type="text/javascript">

	@if (session('success'))
		jQuery(window).on( 'load', function(){
			notisuccess("{!! session('success') !!}");
		});
	@endif

	@if (session('error'))
		jQuery(window).on( 'load', function(){
			notierror("{!! session('error') !!}");
		});
	@endif

	@if (session('info'))
		jQuery(window).on( 'load', function(){
			notiinfo("{!! session('info') !!}");
		});
	@endif

	@if (!empty(session('alert-type')))
	jQuery(window).on( 'load', function(){
		notisuccess("{!! session('message') !!}");
	});
	@endif


	function notisuccess($msg) {
		$("#notification-pop").attr("data-notify-type","success");
		$("#notification-pop").attr("data-notify-msg","<i class='icon-ok-sign me-1'></i> "+$msg);
		SEMICOLON.widget.notifications({ el: jQuery("#notification-pop") });
	}

	function notierror($msg) {
		$("#notification-pop").attr("data-notify-type","error");
		$("#notification-pop").attr("data-notify-msg","<i class='icon-remove-sign me-1'></i> "+$msg);
		SEMICOLON.widget.notifications({ el: jQuery("#notification-pop") });
	}

	function notiinfo($msg) {
		$("#notification-pop").attr("data-notify-type","info");
		$("#notification-pop").attr("data-notify-msg","<i class='icon-info-sign me-1'></i></i> "+$msg);
		SEMICOLON.widget.notifications({ el: jQuery("#notification-pop") });
	}

</script>