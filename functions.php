<?php
/**
 * ogrud_botamiczny functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ogrud_botamiczny
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
function garden_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on ogrud_botamiczny, use a find and replace
		* to change 'garden' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'garden', get_template_directory() . '/languages' );

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
			'menu-header' => esc_html__( 'Header menu', 'garden' ),
			'primary'     => esc_html__( 'Primary menu', 'garden' ),
			'shop-menu'     => esc_html__( 'Shop menu', 'garden' ),
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

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'garden_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'garden_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function garden_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'garden_content_width', 640 );
}
add_action( 'after_setup_theme', 'garden_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function garden_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'garden' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'garden' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'garden_widgets_init' );

/**
 * Disable Gutenberg
 */
add_filter('use_block_editor_for_post', '__return_false');

// Theme includes directory.
$realestate_inc_dir = 'inc';

// Array of files to include.
$realestate_includes = array(
	'/functions-template.php',  // 	Theme custom functions
	'/enqueue.php',				//	Enqueue scripts and styles.
	'/custom-header.php',		//	Implement the Custom Header feature.
	'/customizer.php',			//	Customizer additions.
	'/template-tags.php',		// 	Custom template tags for this theme.	
	'/template-functions.php',	//	Functions which enhance the theme by hooking into WordPress.
	
);

// Load WooCommerce functions if WooCommerce is activated.
if ( class_exists( 'WooCommerce' ) ) {
	$realestate_includes[] = '/woocommerce.php';
}

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

// Include files.
foreach ( $realestate_includes as $file ) {
	require_once get_theme_file_path( $realestate_inc_dir . $file );
}

/**
 * Make ACF Options
 */
if (function_exists('acf_add_options_page')) {
$option_page = acf_add_options_page([
	'page_title' => 'General settings',
	'menu_title' => 'General settings',
	'menu_slug' => 'theme-general-settings',
	'post_id' => 'options',
	'capability' => 'edit_posts',
	'redirect' => false
]);
}

//svg
function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml'; 
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');
  
define('ALLOW_UNFILTERED_UPLOADS', true); 
  
function fix_svg_thumb_display() {
	echo  
	'<style>
		td.media-icon img[src$=".svg"], img[src$=".svg"].attachment-post-thumbnail { 
			width: 100% !important; 
			height: auto !important; 
		}
	</style>';
}
add_action('admin_head', 'fix_svg_thumb_display');
function create_knoweledge_base_taxonomy() {
	register_taxonomy('categories', 'knoweledge_base', array(
		'hierarchical'  	=> true,
		'label' 					=> 'Kategorie',
		'show_in_rest' 		=> true,
		'show_ui'       	=> true,
	));

}

add_action( 'init', 'create_knoweledge_base_taxonomy' );
add_action( 'init', 'register_post_types' );

function register_post_types(){

	register_post_type( 'knoweledge_base', [
		'label' 							=> 'Baza wiedzy',
		'public'              => true,
		'supports'            => [ 'title', 'editor', 'custom-fields', 'thumbnail'], 
		'show_in_menu'        => true, 
		'hierarchical'        => true,
		'has_archive'         => false,
		'menu_icon'           => 'dashicons-database',
		'taxonomies' => 			array('categories', 'post_tag'),
	] );

	register_post_type( 'garden_departments', [
		'label' 							=> 'Działy Ogrodu',
		'public'              => true,
		'supports'            => [ 'title', 'editor', 'custom-fields', 'thumbnail'], 
		'show_in_menu'        => true, 
		'hierarchical'        => true,
		'has_archive'         => false,
		'menu_icon'           => 'dashicons-database',
		'taxonomies' => 			array('post_tag'),
	] );

}


function show_archive_top() { 

	$banner_page = get_field( 'banner_page', 'options' ); ?>
	<div class="page-banner" <?php if( $banner_page ) { echo 'style="background-image: linear-gradient(0deg, rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),url(' . wp_get_attachment_image_url( $banner_page, 'full' ) .'); "' ; }?>>
		<div class="container">
			<?php
			if ( is_home() || is_tax( 'category-course' ) || is_page( 'wydarzenia' ) ) { ?>
				<div class="choose">
					<a class="course<?php echo is_tax( 'category-course' ) ? ' active' : ''; ?>" href="<?php echo get_site_url(); ?>/type-of-course/education-cat/">
						<p class="choose__number">01</p>
						<p class="choose__title">Edukacja</p>
						<span class="link-arrow-green"><?php _e( 'Read more', 'ogrud_botamiczny' ) ?></span>
					</a>
					<a href="<?php echo get_site_url(); ?>/wydarzenia/" class="offer-events<?php echo is_page( 'wydarzenia' ) ? ' active' : ''; ?>">
					<p class="choose__number">02</p>
					<p class="choose__title">Wydarzenia</p>
					<span class="link-arrow-green"><?php _e( 'Read more', 'ogrud_botamiczny' ) ?></span>
					</a>
					<a class="offer-blog <?php echo is_home() ? ' active' : ''; ?>" href="<?php echo get_site_url(); ?>/oferta/">
					<p class="choose__number">03</p>
						<p class="choose__title">Aktualnosci</p>
						<span class="link-arrow-green"><?php _e( 'Read more', 'ogrud_botamiczny' ) ?></span>
					</a>
				</div>
			<?php } ?>	
		</div> 
	</div>
<?php }

function add_menu_link_class( $atts, $item, $args ) {
  if (property_exists($args, 'link_class')) {
    $atts['class'] = $args->link_class;
  }
  return $atts;
}
add_filter( 'nav_menu_link_attributes', 'add_menu_link_class', 1, 3 );
function smartwp_remove_wp_block_library_css(){
	wp_dequeue_style( 'wc-blocks-style' );
	wp_dequeue_style( 'wp-block-library' );
} 
add_action( 'wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 100 );

function header_add_to_cart_fragment($fragments)
{
	global $woocommerce;
	ob_start();
	?>
	<div class="shop__counter"><?php echo sprintf($woocommerce->cart->cart_contents_count); ?></div>
	<?php
	$fragments[".shop__counter"] = ob_get_clean();
	return $fragments;
}
add_filter("woocommerce_add_to_cart_fragments", "header_add_to_cart_fragment");