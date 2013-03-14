<?php
/*
Plugin Name: Players
Plugin URI: http://onegolfpro.com/
Description: Golf academy members.
Version: 1.0
Author: Temba Mazingi
Author URI: http://victorylap.co.za/
*/
define('PLAYER_PATH', plugin_dir_url( __FILE__ ));

function academy_register_players()
{

    $labels = array(
        'name' => _x( 'Players', 'post type general name' ),
        'singular_name' => _x( 'Player', 'post type singular name' ),
        'add_new' => _x( 'Add new', 'Player' ),
        'add_new_item' => __( 'Add new Player' ),
        'edit_item' => __( 'Edit Player' ),
        'new_item' => __( 'New Player' ),
        'view_item' => __( 'View Player' ),
        'search_items' => __( 'Search Players' ),
        'not_found' =>  __( 'No Players found' ),
        'not_found_in_trash' => __( 'No Players found in trash' ),
        'parent_item_colon' => ''
    );

    $args = array(
        'labels' => $labels,
        'menu_icon' => plugins_url( 'icons/golf.png', __FILE__ ),
        'singular_label' => __('Player', 'players'),
        'show_in_menu' => true,
        'public' => true,
        'capability_type' => 'page',
        'hierarchical' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'players', 'with_front' => FALSE),
        'supports' => array('title', 'editor', 'thumbnail', 'comments'),
        'taxonomies' => array('category', 'post_tag')
    );
    register_post_type('players', $args);
}

add_action('init', 'academy_register_players');

/* Incident Date widget */
function academy_add_metaboxes_links()
{
  add_meta_box( 'academy_metabox_id', 'Social Networks', 'academy_metabox_links', 'players', 'side', 'high' );
}

function academy_metabox_links( $post )
{
  $values = get_post_custom( $post->ID );
  $twitter_link = isset( $values['twitter_link'] ) ? esc_attr( $values['twitter_link'][0] ) : '';
  $fb_link = isset( $values['fb_link'] ) ? esc_attr( $values['fb_link'][0] ) : '';
  wp_nonce_field( 'academy_metabox_nonce', 'metabox_nonce' );
  ?>
  <p>
  <label for="fb_link">FB</label>
  <input type="text" name="fb_link" id="fb_link" value="<?php echo $fb_link; ?>" />
  </p>
  <p>
  <label for="twitter_link">Twitter</label>
  <input type="text" name="twitter_link" id="twitter_link" value="<?php echo $twitter_link; ?>" />
  </p>

  <?php
}
add_action( 'add_meta_boxes', 'academy_add_metaboxes_links' );

add_action('save_post', 'save_player_info');
function save_player_info()
{
  global $post;

  update_post_meta($post->ID, "fb_link", $_POST["fb_link"]);
  update_post_meta($post->ID, "twitter_link", $_POST["twitter_link"]);
}
?>