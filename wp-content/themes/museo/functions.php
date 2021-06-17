<?php			

if ( ! isset( $content_width ) ) $content_width = 440;

/**
 * Define some constats
 */
if( ! defined( 'ACADEMIATHEMES_VERSION' ) ) {
	define( 'ACADEMIATHEMES_VERSION', '1.1.2' );
}
if( ! defined( 'ACADEMIATHEMES_THEME_LITE' ) ) {
	define( 'ACADEMIATHEMES_THEME_LITE', true );
}
if( ! defined( 'ACADEMIATHEMES_THEME_PRO' ) ) {
	define( 'ACADEMIATHEMES_THEME_PRO', false );
}
if( ! defined( 'ACADEMIATHEMES_DIR' ) ) {
	define( 'ACADEMIATHEMES_DIR', trailingslashit( get_template_directory() ) );
}
if( ! defined( 'ACADEMIATHEMES_DIR_URI' ) ) {
	define( 'ACADEMIATHEMES_DIR_URI', trailingslashit( get_template_directory_uri() ) );
}

/**
 * Sets up theme defaults and registers the various WordPress features that Museo supports.
 *
 * @return void
 */

if ( ! function_exists( 'museo_setup' ) ) :
/**
 * Theme setup.
 *
 * Set up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support post thumbnails.
 */
function museo_setup() {
    // This theme styles the visual editor to resemble the theme style.
    add_editor_style( array( 'css/editor-style.css' ) );

	add_image_size( 'thumb-academia-slideshow', 960, 400, true );
	add_image_size( 'thumb-featured-tall', 580, 870, true );
	add_image_size( 'thumb-featured-page', 420, 300, true );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support( 'html5', array(
        'comment-form', 'comment-list', 'gallery', 'caption'
    ) );

	/* Add support for Custom Background 
	==================================== */
	
	$defaults = array('default-color' => 'f1eeea',);
	add_theme_support( 'custom-background', $defaults );
	
    /* Add support for Custom Logo 
	==================================== */

    add_theme_support( 'custom-logo', array(
	   'height'      => 80,
	   'width'       => 300,
	   'flex-width'  => true,
	   'flex-height' => true,
	) );

	/* Add support for post and comment RSS feed links in <head>
	==================================== */
	
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

	set_post_thumbnail_size( 150, 100, true );

	/* Add support for Localization
	==================================== */
	
	load_theme_textdomain( 'museo', get_template_directory() . '/languages' );
	
	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if ( is_readable($locale_file) )
		require_once($locale_file);

	/* Add support for Custom Headers 
	==================================== */
	
	add_theme_support(
		'custom-header', apply_filters(
			'academia_custom_header_args', array(
				'width'            => 1100,
				'height'           => 400,
				'flex-height'      => true,
				'video'            => true
			)
		)
	);
    
	// Register nav menus
    register_nav_menus( array(
        'primary' 		=> __( 'Main Menu', 'museo' ),
        'secondary-1' 	=> __( 'Secondary Menu (Left)', 'museo' ),
        'secondary-2' 	=> __( 'Secondary Menu (Right)', 'museo' ),
    ) );

	/* Remove support for Block Based Widgets 
	==================================== */
    remove_theme_support( 'widgets-block-editor' );

}
endif;

add_action( 'after_setup_theme', 'museo_setup' );

add_filter( 'image_size_names_choose', 'museo_custom_sizes' );
 
function museo_custom_sizes( $sizes ) {
	return array_merge( $sizes, array(
		'thumb-academia-slideshow' 	=> __( 'Featured Image: Slideshow Size', 'museo' ),
		'thumb-featured-page' 		=> __( 'Featured Image: Page Thumbnail', 'museo' ),
		'post-thumbnail' 			=> __( 'Featured Image: Thumbnail', 'museo' ),
	) );
}

/* Add javascripts and CSS used by the theme 
================================== */

function museo_js_scripts() {

	$theme_version = wp_get_theme()->get( 'Version' );

	// Theme stylesheet.
	wp_enqueue_style( 'museo-style', get_stylesheet_uri(), array(), $theme_version );

	// Add Dashicons font.
	wp_enqueue_style( 'dashicons' );

	if (! is_admin()) {

		wp_enqueue_script(
			'jquery-superfish',
			get_template_directory_uri() . '/js/superfish.min.js',
			array('jquery'),
			true
		);

		wp_enqueue_script(
			'jquery-fitvids',
			get_template_directory_uri() . '/js/jquery.fitvids.js',
			array('jquery'),
			'1.7.10',
			true
		);

		wp_enqueue_script(
			'museo-scripts',
			get_template_directory_uri() . '/js/museo.js',
			array('jquery'),
			$theme_version, 
			true
		);

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

		/* Font-Awesome */
		wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', null, '4.7.0');

	}

}
add_action('wp_enqueue_scripts', 'museo_js_scripts');

function museo_enqueue_fonts() {
	
	// Include the file.
	require_once get_theme_file_path( 'academia-admin/components/wptt-webfont-loader.php' );

	// Load the webfont.
	wp_enqueue_style(
		'ibm-plex-sans',
		wptt_get_webfont_url( 'https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400;1,700&display=swap' ),
		array(),
		'1.0'
	);

}
add_action( 'wp_enqueue_scripts', 'museo_enqueue_fonts' );

/**
 * --------------------------------------------
 * Enqueue scripts and styles for the backend.
 * --------------------------------------------
 */

if ( ! function_exists( 'academiathemes_scripts_admin' ) ) {
	/**
	 * Enqueue admin styles and scripts
	 */
	function academiathemes_scripts_admin( $hook ) {

		// Styles
		wp_enqueue_style(
			'museo-style-admin',
			get_template_directory_uri() . '/academia-admin/css/academiathemes_theme_settings.css',
			'', ACADEMIATHEMES_VERSION, 'all'
		);

		// Scripts
		wp_enqueue_script(
			'academiathemes-scripts-admin',
			get_template_directory_uri() . '/academia-admin/js/academiathemes-admin.js',
			[ 'jquery' ], ACADEMIATHEMES_VERSION, true
		);
	}
}
add_action( 'admin_enqueue_scripts', 'academiathemes_scripts_admin' );

if ( ! function_exists( 'museo_get_the_archive_title' ) ) :
/* Custom Archives titles.
=================================== */
function museo_get_the_archive_title( $title ) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    }

    return $title;
}
endif;
add_filter( 'get_the_archive_title', 'museo_get_the_archive_title' );

/* Enable Excerpts for Static Pages
==================================== */

add_action( 'init', 'museo_excerpts_for_pages' );

function museo_excerpts_for_pages() {
	add_post_type_support( 'page', 'excerpt' );
}

/* Custom Excerpt Length
==================================== */

function museo_new_excerpt_length($length) {
	if ( is_admin() ) { return $length; }
	else { return 30; }
}
add_filter('excerpt_length', 'museo_new_excerpt_length');

/* Replace invalid ellipsis from excerpts
==================================== */

function museo_excerpt($text)
{
   $text = str_replace(' [&hellip;]', '&hellip;', $text);
   $text = str_replace('[&hellip;]', '&hellip;', $text);
   $text = str_replace('[...]', '...', $text);
   return $text;
}
add_filter('the_excerpt', 'museo_excerpt');

/* Convert HEX color to RGB value (for the customizer)						
==================================== */

function museo_hex2rgb($hex) {
	$hex = str_replace("#", "", $hex);
	
	if(strlen($hex) == 3) {
		$r = hexdec(substr($hex,0,1).substr($hex,0,1));
		$g = hexdec(substr($hex,1,1).substr($hex,1,1));
		$b = hexdec(substr($hex,2,1).substr($hex,2,1));
	} else {
		$r = hexdec(substr($hex,0,2));
		$g = hexdec(substr($hex,2,2));
		$b = hexdec(substr($hex,4,2));
	}
	$rgb = "$r, $g, $b";
	return $rgb; // returns an array with the rgb values
}

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function museo_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
	}
}
add_action( 'wp_head', 'museo_pingback_header' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @since Museo 1.0
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function museo_body_classes( $classes ) {

	$classes[] = academiathemes_helper_get_sidebar_position();
	$classes[] = academiathemes_helper_get_active_header_style();

	return $classes;
}

add_filter( 'body_class', 'museo_body_classes' );

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function museo_skip_link_focus_fix() {
	// The following is minified via `terser --compress --mangle -- js/skip-link-focus-fix.js`.
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'museo_skip_link_focus_fix' );

if ( ! function_exists( 'museo_the_custom_logo' ) ) {

/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 * @since Museo 1.0
 */

	function museo_the_custom_logo() {
		
		if ( function_exists( 'the_custom_logo' ) ) {
			
			// We don't use the default the_custom_logo() function because of its automatic addition of itemprop attributes (they fail the ARIA tests)
			$site = get_bloginfo('name');
			$custom_logo_id = get_theme_mod( 'custom_logo' );

			if ( $custom_logo_id ) {

				$html = sprintf( '<a href="%1$s" class="custom-logo-link" rel="home">%2$s</a>', 
				esc_url( home_url( '/' ) ),
				wp_get_attachment_image( $custom_logo_id, 'full', false, array(
					'class'    => 'custom-logo',
					'alt' => __('Logo for ','museo') . esc_attr($site),
					) )
				);
			
				echo $html;

			}

		}

	}
}

if ( ! function_exists( 'museo_comment' ) ) :
/**
 * Template for comments and pingbacks.
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function museo_comment( $comment, $args, $depth ) {

	if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<div class="comment-body">
			<?php esc_html_e( 'Pingback:', 'museo' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( esc_html__( 'Edit', 'museo' ), '<span class="edit-link">', '</span>' ); ?>
		</div>

	<?php else : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">

			<div class="comment-author vcard">
				<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
			</div><!-- .comment-author -->

			<header class="comment-meta">
				<?php printf( '<cite class="fn">%s</cite>', get_comment_author_link() ); ?>

				<div class="comment-metadata">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
						<time datetime="<?php comment_time( 'c' ); ?>">
							<?php printf( esc_html_x( '%1$s at %2$s', '1: date, 2: time', 'museo' ), get_comment_date(), get_comment_time() ); ?>
						</time>
					</a>
				</div><!-- .comment-metadata -->

				<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'museo' ); ?></p>
				<?php endif; ?>

				<div class="comment-tools">
					<?php edit_comment_link( esc_html__( 'Edit', 'museo' ), '<span class="edit-link">', '</span>' ); ?>

					<?php
						comment_reply_link( array_merge( $args, array(
							'add_below' => 'div-comment',
							'depth'     => $depth,
							'max_depth' => $args['max_depth'],
							'before'    => '<span class="reply">',
							'after'     => '</span>',
						) ) );
					?>
				</div><!-- .comment-tools -->
			</header><!-- .comment-meta -->

			<div class="comment-content">
				<?php comment_text(); ?>
			</div><!-- .comment-content -->
		</article><!-- .comment-body -->

	<?php
	endif;
}
endif; // ends check for museo_comment()

if ( ! function_exists( 'wp_body_open' ) ) {
    function wp_body_open() {
        do_action( 'wp_body_open' );
    }
}

/* Include WordPress Theme Customizer
================================== */

require_once( get_template_directory() . '/customizer/customizer.php');

/* Include Additional Options and Components
================================== */

require_once( get_template_directory() . '/academia-admin/sidebars.php');
require_once( get_template_directory() . '/academia-admin/helper-functions.php');

/* Include Theme Options Page for Admin
================================== */

//require only in admin!
if (is_admin()) {	
	require_once('academia-admin/academia-theme-settings.php');

	if (current_user_can( 'manage_options' ) ) {
		require_once(get_template_directory() . '/academia-admin/admin-notices/academiathemes-notices.php');
		require_once(get_template_directory() . '/academia-admin/admin-notices/academiathemes-notice-welcome.php');
		require_once(get_template_directory() . '/academia-admin/admin-notices/academiathemes-notice-review.php');

		// Remove theme data from database when theme is deactivated.
		add_action('switch_theme', 'museo_db_data_remove');

		if ( ! function_exists( 'museo_db_data_remove' ) ) {
			function museo_db_data_remove() {

				delete_option( 'museo_admin_notices');
				delete_option( 'museo_theme_installed_time');

			}
		}

	}

}