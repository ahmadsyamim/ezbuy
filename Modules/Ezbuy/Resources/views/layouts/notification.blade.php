<div id="notification-pop" data-notify-position="top-center" data-notify-type="success" data-notify-msg="<i class='icon-ok-sign me-1'></i> Message Sent Successfully!"></div>
<script type="text/javascript">
	
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