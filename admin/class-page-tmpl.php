<?php
/**
* Add templates for login page and user page
*/
class TemplateFromPlugin {

	protected $templates;

	private static $instance;

	public static function get_instance() {
		if( null == self::$instance ) {
			self::$instance = new TemplateFromPlugin();
		}
		return self::$instance;
	}

	private function __construct() {
		$this->templates = array();

		if( version_compare( floatval( get_bloginfo( 'version' ) ), '4.7', '<' ) ) {
			// 4.6 or older version
			add_filter( 'page_attributes_dropdown_pages_args', array( $this, 'register_project_templates' ) );

		} else {
			// 4.7 or greater version
			add_filter( 'theme_page_templates', array( $this, 'add_new_template' ) );
		}

		add_filter( 'wp_insert_post_data', array( $this, 'register_project_templates' ) );

		add_filter( 'template_include', array( $this, 'view_project_template' ) );

		$this->templates = array(
			'../template/page-login.php' => 'Login Page Template',
			'../template/page-user.php' => 'User Profile Page Template',
		);
	}

	public function register_project_templates( $atts ) {
		$cache_key = 'page_templates-' . md5( get_theme_root() . '/' . get_stylesheet() );

		$templates = wp_get_theme()->get_page_templates();

		if( empty( $templates ) ) {
			$templates = array();
		}

		wp_cache_delete( $cache_key, 'themes' );

		$templates = array_merge( $templates, $this->templates );

		wp_cache_add( $cache_key, $templates, 'themes', 1800 );

		return $atts;
	}

	public function add_new_template( $posts_templates ) {
		$posts_templates = array_merge( $posts_templates, $this->templates );
		return $posts_templates;
	}

	public function view_project_template( $template ) {
		global $post;

		if( ! $post ) {
			return $template;
		}

		if( !isset( $this->templates[get_post_meta( $post->ID, '_wp_page_template', true ) ] ) ) {
			return $template;
		}

		$file = plugin_dir_path( __FILE__ ) . get_post_meta( $post->ID, '_wp_page_template', true );

		if( file_exists( $file ) ) {
			return $file;
		} else {
			echo $file;
		}

		return $template;
	}
}
add_action( 'plugins_loaded', array( 'TemplateFromPlugin', 'get_instance' ) );