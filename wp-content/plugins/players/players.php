<?php
/*
Plugin Name: Players
Plugin URI: http://onegolfpro.com/
Description: Golf academy members.
Version: 1.0
Author: Temba Mazingi
Author URI: http://victorylap.co.za/
*/
define('PLAYERS_PATH', plugin_dir_url( __FILE__ ));

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


function academy_metabox_stats( $post )
{
  $values = get_post_custom( $post->ID );
  $player_age = isset( $values['player_age'] ) ? esc_attr( $values['player_age'][0] ) : '';
  $home_town = isset( $values['home_town'] ) ? esc_attr( $values['home_town'][0] ) : '';
  $date_joined = isset( $values['date_joined'] ) ? esc_attr( $values['date_joined'][0] ) : '';
  $career_highlights = isset( $values['career_highlights'] ) ? esc_attr( $values['career_highlights'][0] ) : '';
  $twitter_link = isset( $values['twitter_link'] ) ? esc_attr( $values['twitter_link'][0] ) : '';
  $fb_link = isset( $values['fb_link'] ) ? esc_attr( $values['fb_link'][0] ) : '';
  wp_nonce_field( 'academy_metabox_nonce', 'metabox_nonce' );
  ?>
  <p>
  <label for="player_age"><strong>Age:</strong></label>
  <br>
  <input type="text" name="player_age" id="player_age" value="<?php echo $player_age; ?>" style="width:85%;"/>
  </p>
  <p>
  <label for="home_town"><strong>Hometown:</strong></label>
  <br>
  <input type="text" name="home_town" id="home_town" value="<?php echo $home_town; ?>" style="width:85%;"/>
  </p>
  <p>
  <label for="date_joined"><strong>Date Joined:</strong></label>
  <br>
  <input type="text" name="date_joined" id="date_joined" value="<?php echo $date_joined; ?>" style="width:85%;"/>
  </p>
  <p>
  <label for="career_highlights"><strong>Career Highlights So Far:</strong></label>
  <br>
  <textarea name="career_highlights" id="career_highlights" style="height:250px;width:85%;"><?php echo $career_highlights; ?></textarea>
  </p>
  <p>
  <label for="fb_link"><strong>Facebook:</strong></label>
  <br>
  <input type="text" name="fb_link" id="fb_link" value="<?php echo $fb_link; ?>" style="width:85%;"/>
  </p>
  <p>
  <label for="twitter_link"><strong>Twitter:</strong></label>
  <br>
  <input type="text" name="twitter_link" id="twitter_link" value="<?php echo $twitter_link; ?>" style="width:85%;"/>
  </p>
  <?php
}
function academy_add_metaboxes()
{
  add_meta_box( 'academy_metabox_id', 'Vital Statistics', 'academy_metabox_stats', 'players', 'side', 'high' );
}
add_action( 'add_meta_boxes', 'academy_add_metaboxes' );

/* Date widget CSS and JS */
function academy_backend_scripts($hook)
{
  global $post;

  if( ( !isset($post) || $post->post_type != 'players' )) return;

  wp_enqueue_style( 'jquery-ui-fresh', PLAYERS_PATH . 'css/jquery-ui-fresh.css');
  wp_enqueue_script( 'announcements', PLAYERS_PATH . 'js/datepicker.js', array( 'jquery', 'jquery-ui-datepicker' ) );
}
add_action( 'admin_enqueue_scripts', 'academy_backend_scripts' );


add_action('save_post', 'save_player_info');
function save_player_info()
{
  global $post;

  update_post_meta($post->ID, "player_age", $_POST["player_age"]);
  update_post_meta($post->ID, "date_joined", $_POST["date_joined"]);
  update_post_meta($post->ID, "home_town", $_POST["home_town"]);
  update_post_meta($post->ID, "career_highlights", $_POST["career_highlights"]);
  update_post_meta($post->ID, "fb_link", $_POST["fb_link"]);
  update_post_meta($post->ID, "twitter_link", $_POST["twitter_link"]);
}
?>