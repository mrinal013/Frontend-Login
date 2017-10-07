<?php

class LoginRedirect {

	public function __construct() {
		add_filter('login_redirect', array( $this, 'front_user_login_redirect' ), 10, 3 );
	}

	public function front_user_login_redirect( $redirect_to, $url, $user ) {
		if( !isset($user->errors) ) {
			return $redirect_to;
		}
		wp_redirect( home_url('/login/') . '?action=login&failed=1' );
		exit;
	}
}
new LoginRedirect();