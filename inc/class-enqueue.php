<?php

class Enqueue {

	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'front_user_enqueue_style' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'front_user_enqueue_script' ) );
	}

	public function front_user_enqueue_style() {
		wp_enqueue_style( 'jquery-ui-style', plugin_dir_url( __FILE__ ) . '../frontend/assets/css/jquery-ui.css' );
		wp_enqueue_style( 'front-user-style', plugin_dir_url( __FILE__ ) . '../frontend/assets/css/style.css' );
	}

	public function front_user_enqueue_script() {
    	wp_enqueue_script( 'jquery-ui-script' , plugin_dir_url( __FILE__ ) . '../frontend/assets/js/jquery-ui.js', array( 'jquery' ), null, true );
    	wp_enqueue_script( 'front-user-script', plugin_dir_url( __FILE__ ) . '../frontend/assets/js/script.js', array('jquery'), null, true);
	}
}
new Enqueue();