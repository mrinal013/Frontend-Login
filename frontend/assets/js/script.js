;jQuery(document).ready(function( $ ) {
	
	$( "#login-tabs" ).tabs();

	$('#login-tabs a').click(function (e) {
		e.preventDefault();
		$this = $(this);
		// add class to tab
		$('#login-tabs li').removeClass('active-tab');
		$this.parent().addClass('active-tab');
		// show the right tab
		$('#page-login .tab-content').hide();
		$('#page-login ' + $this.attr('href')).show();
		return false;
	});

	// $('.sign-up').click(function(e) {
	// 	e.preventDefault();
	// 	$this = $(this);

	// 	// add class to tab
	// 	$('#login-tabs li').removeClass('active-tab');
	// 	$('#tab-register li').addClass('active-tab');
	// 	// show the right tab
	// 	$('#page-login .tab-content').hide();
	// 	$('#page-login ' + $this.attr('href')).show();
	// 	return false;
	// });
	
});