<?php

class Enqueue {
	private static $instance;

	public static function get_instance() {
		if( null == self::$instance ) {
			self::$instance = new Enqueue();
		}
		return self::$instance;
	}

	public function __construct() {

		add_action( 'wp_enqueue_scripts', array( $this, 'front_user_enqueue_style' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'front_user_enqueue_script' ) );
		
	}

	public function front_user_enqueue_style() {
		wp_enqueue_style( 'front-user-style', '//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css' );

	}

	public function front_user_enqueue_script() {
    	wp_enqueue_script( 'jquery-ui' , plugin_dir_url( __FILE__ ) . '../frontend/assets/js/jquery-ui.js', array( 'jquery' ), null, true );
    	wp_enqueue_script( 'front_user_script', plugin_dir_url( __FILE__ ) . '../frontend/assets/js/script.js', array('jquery'), null, true);
	}
}
add_action( 'plugins_loaded', array( 'Enqueue', 'get_instance' ) );