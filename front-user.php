<?php
/**
* Plugin Name: Front user
* Plugin URI: https://github.com/mrinal013/XpeedStudio-Test
* Description: Frontend user registration and login system in WordPress
* Author: Md. Mrinal Haque
* Author URI: https://github.com/mrinal013
* License: GPLv2 or later
* Text Domain: front-user
* This program is free software; you can redistribute it and/or
* modify it under the terms of the GNU General Public License
* as published by the Free Software Foundation; either version 2
* of the License, or (at your option) any later version.
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
* You should have received a copy of the GNU General Public License
* along with this program; if not, write to the Free Software
* Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	die("direct access not allowed!!!");
}

// Include required files
include_once "admin/class-page-tmpl.php";

include_once "inc/class-login-action.php";
new LoginInit();

include_once "inc/class-template-redirect.php";
new Redirect();

include_once "inc/class-admin-pass.php";
new AdministratorsPass();

include_once "inc/class-registration-redirect.php";
new RegistrationRedirct();

// include_once "inc/class-login-redirect.php";
// new LoginRedirct();

include_once "inc/class-lostpassword.php";
new LostPassword();

include_once "inc/class-validate-password-reset.php";
new ValidatePasswordReset();

include_once "frontend/class-enqueue.php";


/**
 * Login page redirect
 */
function cubiq_login_redirect ($redirect_to, $url, $user) {
	if ( !isset($user->errors) ) {
		return $redirect_to;
	}
	wp_redirect( home_url('/login/') . '?action=login&failed=1');
	exit;
}
add_filter('login_redirect', 'cubiq_login_redirect', 10, 3);
/**
 * Password reset redirect
 */
function cubiq_reset_password () {
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
add_action( 'lostpassword_post', 'cubiq_reset_password');
/**
 * Validate password reset
 */
function cubiq_validate_password_reset ($errors, $user) {
	// passwords don't match
	if ( $errors->get_error_code() ) {
		wp_redirect( home_url('/login/?action=resetpass&failed=nomatch') );
		exit;
	}
	// wp-login already checked if the password is valid, so no further check is needed
	if ( !empty( $_POST['pass1'] ) ) {
		reset_password($user, $_POST['pass1']);
		wp_redirect( home_url('/login/?action=resetpass&success=1') );
		exit;
	}
	// redirect to change password form
	wp_redirect( home_url('/login/?action=resetpass') );
	exit;
}
add_action('validate_password_reset', 'cubiq_validate_password_reset', 10, 2);
