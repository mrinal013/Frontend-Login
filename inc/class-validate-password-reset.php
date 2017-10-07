<?php

class ValidatePasswordReset {
	public function __construct() {
		add_action('validate_password_reset', array( $this, 'front_user_validate_password_reset' ), 10, 2 );
	}

	public function front_user_validate_password_reset( $errors, $user ) {
		if ( $errors->get_error_code() ) {
	        wp_redirect( home_url('/login/?action=resetpass&failed=nomatch') );
	        exit;
	    }

	    if ( !empty( $_POST['pass1'] ) ) {
	        reset_password($user, $_POST['pass1']);

	        wp_redirect( home_url('/login/?action=resetpass&success=1') );
	        exit;
	    }

	    wp_redirect( home_url('/login/?action=resetpass') );
	    exit;
	}
}