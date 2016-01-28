<?php
/**
 * Awaken functions and definitions
 *
 * @package Awaken
 */


/**
 * Load the TGM init if it exists
 */
if ( file_exists( get_template_directory() . '/inc/options/tgm/tgm-init.php') ) {
    require_once( get_template_directory() . '/inc/options/tgm/tgm-init.php' );
}   
/**
 * Tweak the redux framework.
 * Register all the theme options.
 * Registers the wpex_option function.
 */
if ( file_exists( get_template_directory() . '/inc/options/admin-config.php') ) {
	require_once( get_template_directory() . '/inc/options/admin-config.php' );
}

if ( ! function_exists( 'awaken_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function awaken_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Awaken, use a find and replace
	 * to change 'awaken' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'awaken', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'featured-slider', 752, 440, true );
	add_image_size( 'featured', 388, 220, true );
	add_image_size( 'small-thumb', 120,85, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'main_navigation' => __( 'Main Navigation', 'awaken' ),
	) );
	register_nav_menus( array(
		'top_navigation' => __( 'Top Navigation', 'awaken' ),
	) );
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	/*add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );*/

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'awaken_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
	
	/**
	 * Set the content width based on the theme's design and stylesheet.
	 */
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 747; /* pixels */
	}	

}
endif; // awaken_setup
add_action( 'after_setup_theme', 'awaken_setup' );

/**
 * This function Contains All The scripts that Will be Loaded in the Theme Header including Custom Javascript, Custom CSS, etc.
 */
function awaken_initialize_header() {
	
	global $awaken_options; //Global theme options variable
	
	//Place all Javascript Here
	echo "<script>";
		echo $awaken_options['awaken-header-code'];
	echo "</script>";
	//Java Script Ends
	
	//CSS Begins
	echo "<style>";
		echo $awaken_options['awaken-ace-editor-css'];	
	echo "</style>";
	//CSS Ends
	
}
add_action('wp_head', 'awaken_initialize_header');

/**
 * Removes the [...] text.
 */
function awaken_excerpt_more($more) {
	return ' ';
}
add_filter('excerpt_more', 'awaken_excerpt_more');

/**
 * Adds a custom excerpt with a user defined link text.
 */
function awaken_custom_excerpt($text) {
   	global $awaken_options;
    $excerpt = '' . strip_tags($text) . '<a class="moretag" href="'. get_permalink() . '"> ' . $awaken_options['excerpt-more'] . '</a>';
   	return $excerpt;
}
add_filter('the_excerpt', 'awaken_custom_excerpt');

/**
 * Sets the post excerpt length to 70 words.
 *
 * function tied to the excerpt_length filter hook.
 *
 * @uses filter excerpt_length
 */
function awaken_excerpt_length( $length ) {
	return 23;
}
add_filter( 'excerpt_length', 'awaken_excerpt_length' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function awaken_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Main Sidebar', 'awaken' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="widget-title-container"><h1 class="widget-title">',
		'after_title'   => '</h1></div>',
	) );
	register_sidebar( array(
		'name'          => __( 'Magazine 1', 'awaken' ),
		'id'            => 'magazine-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="awt-container"><h1 class="awt-title">',
		'after_title'   => '</h1></div>',
	) );
	register_sidebar( array(
		'name'          => __( 'Magazine 2', 'awaken' ),
		'id'            => 'magazine-2',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="awt-container"><h1 class="awt-title">',
		'after_title'   => '</h1></div>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Left Sidebar', 'awaken' ),
		'id'            => 'footer-left',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="footer-widget-title">',
		'after_title'   => '</h1>',
	) );	
	register_sidebar( array(
		'name'          => __( 'Footer Mid Sidebar', 'awaken' ),
		'id'            => 'footer-mid',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="footer-widget-title">',
		'after_title'   => '</h1>',
	) );	
	register_sidebar( array(
		'name'          => __( 'Footer Right Sidebar', 'awaken' ),
		'id'            => 'footer-right',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="footer-widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'awaken_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function awaken_scripts() {
	
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.1.0' );

	wp_enqueue_style( 'bootstrap.css', get_template_directory_uri() . '/css/bootstrap.min.css', array(), 'all' );
	
	wp_enqueue_style( 'awaken-style', get_stylesheet_uri() );

	wp_enqueue_script( 'awaken-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js',array( 'jquery' ),'', true );	

	wp_enqueue_script( 'awaken-scripts', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ) );

    $awaken_user_agent = strtolower($_SERVER['HTTP_USER_AGENT']);
	if(preg_match('/(?i)msie [1-8]/',$awaken_user_agent)) {
		wp_enqueue_script( 'html5shiv', get_template_directory_uri() . '/js/html5shiv.js', true ); 
	}

	wp_enqueue_script( 'respond', get_template_directory_uri() . '/js/respond.min.js' );

	wp_enqueue_script( 'awaken-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'awaken_scripts' );

/**
 * Load Google Fonts
 */
function awaken_fonts_url() {
    $fonts_url = '';
 
    /* Translators: If there are characters in your language that are not
    * supported by Lora, translate this to 'off'. Do not translate
    * into your own language.
    */
    $source_sans_pro = _x( 'on', 'Source Sans Pro font: on or off', 'awaken' );

    /* Translators: If there are characters in your language that are not
    * supported by Open Sans, translate this to 'off'. Do not translate
    * into your own language.
    */
    $ubuntu = _x( 'on', 'Ubuntu font: on or off', 'awaken' );
 
    /* Translators: If there are characters in your language that are not
    * supported by Open Sans, translate this to 'off'. Do not translate
    * into your own language.
    */
    $roboto = _x( 'on', 'Roboto Condensed font: on or off', 'awaken' );
 
    if ( 'off' !== $source_sans_pro || 'off' !== $ubuntu || 'off' !== $roboto ) {
        $font_families = array();
 
        if ( 'off' !== $ubuntu ) {
            $font_families[] = 'Ubuntu:400,500';
        }

        if ( 'off' !== $source_sans_pro ) {
            $font_families[] = 'Source Sans Pro:400,600,700,400italic';
        }
 
        if ( 'off' !== $roboto ) {
            $font_families[] = 'Roboto Condensed:400italic,700,400';
        }
 
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
 
        $fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
    }
 
    return $fonts_url;
}
/**
* Enqueue Google fonts.
*/
function awaken_font_styles() {
    wp_enqueue_style( 'awaken-fonts', awaken_fonts_url(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'awaken_font_styles' );

/**
* Enqueue awaken options panel custom css.
*/
function awaken_option_panel_style() {
	wp_enqueue_style( 'admin_css', get_template_directory_uri() . '/inc/options/admin.css', false );
}
add_action( 'admin_enqueue_scripts', 'awaken_option_panel_style' );


/**
 * Activate a favicon for the website.
 */
function awaken_favicon() {
	global $awaken_options;

	if ( $awaken_options['favicon-display-checkbox'] == '1' ) {
		$favicon = $awaken_options['favicon-uploader']['url'];
		$awaken_favicon_output = '';
		if ( !empty( $favicon ) ) {
			$awaken_favicon_output .= '<link rel="shortcut icon" href="'.esc_url( $favicon ).'" type="image/x-icon" />';
		}
		echo $awaken_favicon_output;
	}
}
add_action( 'admin_head', 'awaken_favicon' );
add_action( 'wp_head', 'awaken_favicon' );

/**
* Add flex slider.
*/
function awaken_flex_scripts() {
    
    wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array('jquery'), false, true );
    wp_register_script( 'add-awaken-flex-js', get_template_directory_uri() . '/js/awaken.slider.js', array(), '', true );
	wp_enqueue_script( 'add-awaken-flex-js' );    
    wp_register_style( 'add-flex-css', get_template_directory_uri() . '/css/flexslider.css','','', 'screen' );
    wp_enqueue_style( 'add-flex-css' );

}
add_action( 'wp_enqueue_scripts', 'awaken_flex_scripts' );

function awaken_add_editor_styles() {
	$font_url = str_replace( ',', '%2C', '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700,400italic|Roboto+Condensed:400italic,400,700' );
    add_editor_style( $font_url );
    add_editor_style( 'editor-style.css' );
}
add_action( 'after_setup_theme', 'awaken_add_editor_styles' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load Widget files
 */
require get_template_directory() . '/inc/widgets/three-block-posts.php';
require get_template_directory() . '/inc/widgets/single-category.php';
require get_template_directory() . '/inc/widgets/dual-category.php';
require get_template_directory() . '/inc/widgets/medium-rectangle.php';
require get_template_directory() . '/inc/widgets/popular-tags-comments.php';
require get_template_directory() . '/inc/widgets/video-widget.php';

/* Load slider */
require get_template_directory() . '/inc/functions/slider.php';
/* Social Media Icons */
require get_template_directory() . '/inc/functions/socialmedia.php';