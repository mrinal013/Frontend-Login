<?php

class LostPassword {
	
	public function __construct() {
		add_action( 'lostpassword_post', array( $this, 'front_user_reset_password'));
	}

	public function front_user_reset_password() {
		$user_data = '';
		if ( !empty( $_POST['user_login'] ) ) {
			if ( strpos( $_POST['user_login'], '@' ) ) {
				$user_data = get_user_by( 'email', trim($_POST['user_login']) );
			} else {
				$user_data = get_user_by( 'login', trim($_POST['user_login']) );
			}
		}
		if ( empty($user_data) ) {
			wp_redirect( home_url('/login/') . '?action=forgot&failed=1' );
			exit;
		}
	}
}
new LostPassword();