<?php
// Dashboard Customization
function simpler_admin_bar()
{

	global $wp_admin_bar;
	$wp_admin_bar->remove_menu('wp-logo');
	$wp_admin_bar->remove_menu('comments');
	$wp_admin_bar->remove_menu('new');
	$wp_admin_bar->remove_menu('about');
	$wp_admin_bar->remove_menu('wporg');
	$wp_admin_bar->remove_menu('documentation');
	$wp_admin_bar->remove_menu('support-forums');
	$wp_admin_bar->remove_menu('feedback');
	$wp_admin_bar->remove_menu('view-site');

}
add_action( 'wp_before_admin_bar_render', 'simpler_admin_bar' );

function simpler_dashboard_widgets()
{

  global $wp_meta_boxes;
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);

}
add_action('wp_dashboard_setup', 'simpler_dashboard_widgets');

function simpler_footer_admin ()
{
    echo 'Premier SA Golf Academy';
}
add_filter('admin_footer_text', 'simpler_footer_admin');

function simpler_wp_version()
{
	return '';
}
add_filter('the_generator', 'simpler_wp_version');

// theme admin
include('functions/theme-admin.php');
include('functions/better-excerpts.php');
include('functions/better-comments.php');
include('functions/slides-meta.php');

// get scripts
add_action('wp_enqueue_scripts','my_theme_scripts_function');

function my_theme_scripts_function()
{

	wp_deregister_script('jquery');
	wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"), false, '1.4.2');
	wp_enqueue_script('jquery');

	wp_enqueue_script('sliding effect', get_stylesheet_directory_uri() . '/js/sliding_effect.js');
	wp_enqueue_script('superfish', get_stylesheet_directory_uri() . '/js/superfish.js');
	wp_enqueue_script('supersubs', get_stylesheet_directory_uri() . '/js/supersubs.js');

	if(is_front_page()) :
	 wp_enqueue_script('nivoSlider', get_stylesheet_directory_uri() . '/js/jquery.nivo.slider.pack.js');
	endif;
}

//Add Pagination Support
include('functions/pagination.php');

// Limit Post Word Count
function new_excerpt_length($length)
{
	return 50;
}
add_filter('excerpt_length', 'new_excerpt_length');

//Replace Excerpt Link
function new_excerpt_more($more)
{
  global $post;
  return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

//Activate post-image functionality (WP 2.9+)
if ( function_exists( 'add_theme_support' ) )
  add_theme_support( 'post-thumbnails' );

// featured image sizes
if ( function_exists( 'add_image_size' ) )
{
  add_image_size( 'full-size',  9999, 9999, false );
  add_image_size( 'post-image',  150, 150, true );
  add_image_size( 'related-posts',  50, 50, true );
  add_image_size( 'slider',  960, 360, true );
}

// Enable Custom Background
add_custom_background();

// register navigation menus
register_nav_menus(
	array('main nav'=>__('Main Nav'),)
);

/// add home link to menu
function home_page_menu_args( $args )
{
  $args['show_home'] = true;
  return $args;
}
add_filter( 'wp_page_menu_args', 'home_page_menu_args' );


// menu fallback
function default_menu()
{
  require_once (TEMPLATEPATH . '/includes/default-menu.php');
}

add_action( 'init', 'create_post_types' );
function create_post_types()
{
  // Define Post Type For Slider
  register_post_type( 'slides',
    array(
      'labels' => array(
		'name' => _x( 'Slides', 'post type general name' ), // Tip: _x('') is used for localization
		'singular_name' => _x( 'Slide', 'post type singular name' ),
		'add_new' => _x( 'Add New', 'Slide' ),
		'add_new_item' => __( 'Add New Slide' ),
		'edit_item' => __( 'Edit Slide' ),
		'new_item' => __( 'New Slide' ),
		'view_item' => __( 'View Slide' ),
		'search_items' => __( 'Search Slides' ),
		'not_found' =>  __( 'No Slides found' ),
		'not_found_in_trash' => __( 'No Slides found in Trash' ),
		'parent_item_colon' => ''
      ),
      'public' => true,
	  'exclude_from_search' => true,
	  'supports' => array('title','thumbnail'),
	  'menu_icon' => get_stylesheet_directory_uri() . '/images/admin/slides.png',
    )
  );
}

//Register Sidebars
if ( function_exists('register_sidebar') )
register_sidebar( array(
  'name' => 'Sidebar',
  'description' => 'Widgets in this area will be shown in the sidebar.',
  'before_widget' => '<div class="sidebar-box clearfix">',
  'after_widget' => '</div>',
  'before_title' => '<h4>',
  'after_title' => '</h4>',)
);
register_sidebar( array(
  'name' => 'First Footer Area',
  'description' => 'Widgets in this area will be shown in the footer - left side.',
  'before_widget' => '<div class="footer-box">',
  'after_widget' => '</div>',
  'before_title' => '<h4>',
  'after_title' => '</h4>',)
);
register_sidebar( array(
  'name' => 'Second Footer Area',
  'description' => 'Widgets in this area will be shown in the footer - middle left.',
  'before_widget' => '<div class="footer-box">',
  'after_widget' => '</div>',
  'before_title' => '<h4>',
  'after_title' => '</h4>',)
);
register_sidebar(array(
  'name' => 'Third Footer Area',
  'description' => 'Widgets in this area will be shown in the footer - middle right.',
  'before_widget' => '<div class="footer-box">',
  'after_widget' => '</div>',
  'before_title' => '<h4>',
  'after_title' => '</h4>',)
);
register_sidebar( array(
  'name' => 'Fourth Footer Area',
  'description' => 'Widgets in this area will be shown in the footer - right side.',
  'before_widget' => '<div class="footer-box">',
  'after_widget' => '</div>',
  'before_title' => '<h4>',
  'after_title' => '</h4>',)
);

// functions run on activation --> important flush to clear rewrites
if ( is_admin() && isset($_GET['activated'] ) && $pagenow == 'themes.php' )
{
	$wp_rewrite->flush_rules();
}
?>