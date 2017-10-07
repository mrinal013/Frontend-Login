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
include_once "inc/class-template-redirect.php";
include_once "inc/class-admin-pass.php";
include_once "inc/class-registration-redirect.php";
include_once "inc/class-login-redirect.php";
include_once "inc/class-lostpassword.php";
include_once "inc/class-validate-password-reset.php";
include_once "inc/class-enqueue.php";