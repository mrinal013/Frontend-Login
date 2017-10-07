<?php

class Redirect {

	public function __construct() {
		add_action( 'template_redirect', array( $this, 'front_user_template_redirect' ) );
	}

	public function front_user_template_redirect() {
		if ( is_page( 'login' ) && is_user_logged_in() ) {
			wp_redirect( home_url( '/user/' ) );
			exit();
		}
		if ( is_page( 'user' ) && !is_user_logged_in() ) {
			wp_redirect( home_url( '/login/' ) );
			exit();
		}
	}
}
new Redirect();