<?php

class RegistrationRedirct {
	public function __construct() {
		add_filter('registration_errors', array( $this, 'front_user_registration_redirect' ), 10, 3);
	}

	public function front_user_registration_redirect( $errors, $sanitized_user_login, $user_email ) {

		// don't lose your time with spammers, redirect them to a success page
		if ( !isset($_POST['confirm_email']) || $_POST['confirm_email'] !== '' ) {
			wp_redirect( home_url('/login/') . '?action=register&success=1' );
			exit;
		}
		if ( !empty( $errors->errors) ) {
			if ( isset( $errors->errors['username_exists'] ) ) {
				wp_redirect( home_url('/login/') . '?action=register&failed=username_exists' );
			} else if ( isset( $errors->errors['email_exists'] ) ) {
				wp_redirect( home_url('/login/') . '?action=register&failed=email_exists' );
			} else if ( isset( $errors->errors['invalid_username'] ) ) {
				wp_redirect( home_url('/login/') . '?action=register&failed=invalid_username' );
				
			} else if ( isset( $errors->errors['invalid_email'] ) ) {
				wp_redirect( home_url('/login/') . '?action=register&failed=invalid_email' );
			} else if ( isset( $errors->errors['empty_username'] ) || isset( $errors->errors['empty_email'] ) ) {
				wp_redirect( home_url('/login/') . '?action=register&failed=empty' );
			} else {
				wp_redirect( home_url('/login/') . '?action=register&failed=generic' );
			}
			exit;
		}
		return $errors;
	}
}