<?php
/**
 * quala functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package quala
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function quala_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on quala, use a find and replace
		* to change 'quala' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'quala', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'main-menu' => esc_html__( 'Primary', 'quala' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
add_action( 'after_setup_theme', 'quala_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function quala_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'quala_content_width', 640 );
}
add_action( 'after_setup_theme', 'quala_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function quala_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer widgets', 'quala' ),
			'id'            => 'quala_footer_widgets',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '',
			'after_title'   => '',
		)
	);
}
add_action( 'widgets_init', 'quala_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function quala_scripts() {
	wp_enqueue_style( 'quala-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_enqueue_style( 'quala-main-style', get_template_directory_uri() . '/assets/css/style.min.css', array(), _S_VERSION );
	wp_style_add_data( 'quala-style', 'rtl', 'replace' );

	wp_enqueue_script( 'quala-script', get_template_directory_uri() . '/assets/js/script.min.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'quala_scripts' );



/*
 * Remove Posts post type
*/
require_once get_template_directory() . "/inc/quala-remove-posts.php";

/*
 * Remove Comments post type
*/
require_once get_template_directory() . "/inc/quala-remove-comments.php";

/*
 * Add column widget
*/
require_once get_template_directory() . "/widgets/quala-widget-column.php";

/*
 * Initialise all custom widgets
*/
require_once get_template_directory() . "/widgets/quala-widgets-init.php";

/*
 * Automatically set the image Title, Alt-Text upon upload
*/
require_once get_template_directory() . "/inc/quala-autoset-image-attr.php";

/*
 * Add custom classes to nav-menu
*/
require_once get_template_directory() . "/inc/quala-custom-nav-classes.php";

/*
 * Display img function
*/
require_once get_template_directory() . "/inc/quala-display-image.php";

/*
 * Registering a metabox class
*/
// Metabox class
require_once get_template_directory() . "/inc/meta-box-class/class-quala-metaboxes.php";
// Metabox initializing function
require_once get_template_directory() . "/inc/metaboxes-init/quala-homepage-metaboxes.php";