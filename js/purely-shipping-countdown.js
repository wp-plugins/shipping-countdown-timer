jQuery( document ).ready(function() {
	if (typeof shippingVar !== 'undefined') {

	jQuery('.purely-countdown').countdown({
	
		until: new Date(shippingVar)
	}).on('update.countdown', function(event) {
        var $this = $(this).html(event.strftime(''
            + '%H Hours '
            + '%M Minutes '
            + '%S Seconds'
		));
    });
	}

});
