<?php
/**
 * Functions for alr-starter theme
 */

if ( ! function_exists( 'alr-starter_setup' ) ) :
function alr-starter_setup() {
	load_theme_textdomain( 'alr-starter', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	add_filter( 'feed_links_show_comments_feed', '__return_false' ); //but no comments feed
	//add_filter( 'feed_links_show_home_comments_feed', '__return_false' ); //but no comments feed


	// TODO make sure this doesn't conflict with Yoast titles
	add_theme_support( 'title-tag' );

	//Featured image support
	add_theme_support( 'post-thumbnails' );

	// Register menus
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'alr-starter' ),
	) );

	//Valid HTML5 markup
	//TODO is this needed? Is this what messes up JetPack comments?
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	// add_theme_support( 'custom-background', apply_filters( 'alr-starter_custom_background_args', array(
	// 	'default-color' => 'ffffff',
	// 	'default-image' => '',
	// ) ) );

	// Add theme support for selective refresh for widgets.
	//add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'alr-starter_setup' );

//Content width impacts image and caption widths.
// TODO: Make sure this is the correct width
function alr-starter_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'alr-starter_content_width', 640 );
}
add_action( 'after_setup_theme', 'alr-starter_content_width', 0 );

//Widget Area
//TODO decide whether to keep or not
function alr-starter_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'alr-starter' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'alr-starter' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'alr-starter_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function alr-starter_scripts() {
	wp_enqueue_style( 'alr-starter-style', get_template_directory_uri() . '/css/main.css' );

	wp_enqueue_script( 'forte-js', get_template_directory_uri() . '/js/forte.js', array('jquery'), '', false );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'alr-starter_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

//Remove WP emojis
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

//Remove Live Writer link
remove_action( 'wp_head', 'wlwmanifest_link');

// Disable REST API link tag
remove_action('wp_head', 'rest_output_link_wp_head', 10);

// Disable oEmbed Discovery Links
remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);

// Disable REST API link in HTTP headers
remove_action('template_redirect', 'rest_output_link_header', 11, 0);

// Remove prefetch link helper used for Google fonts and emoji
function remove_dns_prefetch( $hints, $relation_type ) {
    if ( 'dns-prefetch' === $relation_type ) {
        return array_diff( wp_dependencies_unique_hosts(), $hints );
    }

    return $hints;
}

add_filter( 'wp_resource_hints', 'remove_dns_prefetch', 10, 2 );


//remove comment support on pages
add_action('init', 'remove_comment_support', 100);

function remove_comment_support() {
remove_post_type_support( 'page', 'comments' );
}

//Show template name -- comment out when not in use

/*
add_action('wp_head', 'show_template');
function show_template() {
	global $template;
	print_r($template);
}
*/
