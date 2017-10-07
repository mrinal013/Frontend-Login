<?php

class LoginInit {
	public function __construct() {
		add_action( 'login_init', array( $this, 'front_user_login_init' ) );
	}

	public function front_user_login_init() {
		$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'login';
		if ( isset( $_POST['wp-submit'] ) ) {
			$action = 'post-data';
		} else if ( isset( $_GET['reauth'] ) ) {
			$action = 'reauth';
		}
		// redirect to change password form
		if ( $action == 'rp' || $action == 'resetpass' ) {
			if( isset($_GET['key']) && isset($_GET['login']) ) {
				$rp_path = wp_unslash('/login/');
				$rp_cookie	= 'wp-resetpass-' . COOKIEHASH;
				$value = sprintf( '%s:%s', wp_unslash( $_GET['login'] ), wp_unslash( $_GET['key'] ) );
				setcookie( $rp_cookie, $value, 0, $rp_path, COOKIE_DOMAIN, is_ssl(), true );
			}
			
			wp_redirect( home_url('/login/?action=resetpass') );
			exit;
		}
		// redirect from wrong key when resetting password
		if ( $action == 'lostpassword' && isset($_GET['error']) && ( $_GET['error'] == 'expiredkey' || $_GET['error'] == 'invalidkey' ) ) {
			wp_redirect( home_url( '/login/?action=forgot&failed=wrongkey' ) );
			exit;
		}
		if (
			$action == 'post-data'		||			// don't mess with POST requests
			$action == 'reauth'			||			// need to reauthorize
			$action == 'logout'						// user is logging out
		) {
			return;
		}
		wp_redirect( home_url( '/login/' ) );
		exit;
	}
}