<?php

class AdministratorsPass {
	public function __construct() {
		add_action( 'admin_init', array( $this, 'front_user_admin_init' ) );
	}

	public function front_user_admin_init() {
		if ( current_user_can( 'subscriber' ) && !defined( 'DOING_AJAX' ) ) {
			wp_redirect( home_url('/user/') );
			exit;
		}
	}
}