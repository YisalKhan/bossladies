<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Theme Compatibility for Make theme
 * @see https://wordpress.org/themes/make/
 * @since 1.0
 */
class ET_Builder_Theme_Compat_Make {
	/**
	 * Unique instance of class
	 */
	public static $instance;

	/**
	 * Constructor
	 */
	private function __construct(){
		$this->init_hooks();
	}

	/**
	 * Gets the instance of the class
	 */
	public static function init(){
		if ( null === self::$instance ){
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Hook methods to WordPress
	 * @return void
	 */
	function init_hooks() {
		$theme   = wp_get_theme();
		$version = isset( $theme['Version'] ) ? $theme['Version'] : false;

		// Bail if no theme version found
		if ( ! $version ) {
			return;
		}

		// Fixing Make v1.6.4 below compatibility issue
		// @todo once this issue is fixed in future version, run version_compare() to limit the scope of this fix
		add_filter( 'make_will_be_builder_page', array( $this, 'adjust_builder_page_status' ) );
		add_action( 'admin_enqueue_scripts',     array( $this, 'admin_enqueue_scripts' ), 10 );

		// Fix missing theme page container when TB is enabled.
		add_action( 'et_theme_builder_template_after_header', array( $this, 'theme_builder_after_header' ) );
		add_action( 'et_theme_builder_template_before_footer', array( $this, 'theme_builder_before_footer' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'add_styling_fix' ), 11 );
	}

	/**
	 * Make will not save Divi Builder layout if template-builder.php is selected. Fortunately,
	 * Make has a filter to determine wheather a page should use template-builder.php or not during post saving
	 * If Divi Builder is known to be used while the page template is set to template-builder.php,
	 * cancel template-builder.php usage. This doesn't distract user and work smoothly on the backend
	 * @since 1.0
	 * @return bool
	 */
	function adjust_builder_page_status( $use_builder ) {
		if ( isset( $_POST['et_pb_use_builder'] ) && 'on' === $_POST['et_pb_use_builder'] ) {
			return 0;
		}

		return $use_builder;
	}

	/**
	 * Description
	 * @since 1.0
	 * @return void
	 */
	function admin_enqueue_scripts() {
		if ( ! function_exists( 'get_current_screen' ) ) {
			return;
		}

		$current_screen = get_current_screen();

		// Only load in post-editing screen
		if ( isset( $current_screen->base ) && 'post' === $current_screen->base ) {
			wp_enqueue_script( 'et_pb_theme_compat_make_editor', ET_BUILDER_PLUGIN_URI . '/theme-compat/js/make-editor.js', array( 'et_pb_admin_js', 'jquery' ), ET_BUILDER_VERSION, true );
		}
	}

	/**
	 * Display theme opening container.
	 *
	 * Provide the opening container tag only to ensure TB layout works smoothly.
	 *
	 * @since ??
	 */
	public function theme_builder_after_header() {
		?>
		<div id="site-wrapper" class="site-wrapper">
			<div id="site-content" class="site-content">
				<div class="container">
		<?php
	}

	/**
	 * Display theme closing container.
	 *
	 * Provide the closing container tag only to ensure TB layout works smoothly.
	 *
	 * @since ??
	 */
	public function theme_builder_before_footer() {
		?>
				</div><!-- .container -->
			</div><!-- #site-content -->
		</div><!-- #site-wrapper -->
		<?php
	}

	/**
	 * Add inline styling for fixing design quirks on Make theme.
	 *
	 * @since ??
	 */
	public function add_styling_fix() {
		$style = '#et-boc #site-content { float: none; }';
		wp_add_inline_style( 'et-builder-modules-style', $style );
	}
}
ET_Builder_Theme_Compat_Make::init();