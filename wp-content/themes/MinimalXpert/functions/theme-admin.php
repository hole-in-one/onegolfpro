<?php
function mx_theme_settings_init(){
	register_setting( 'mx_theme_settings', 'mx_theme_settings' );
}
function mx_scripts() {
	
wp_enqueue_script("theme-admin", get_bloginfo('stylesheet_directory')."/functions/functions.js", false, "1.0");
wp_enqueue_script('bbq', get_bloginfo('stylesheet_directory') . '/functions/jquery.ba-bbq.min.js');
}

function mx_style() {
wp_enqueue_style("theme-admin", get_bloginfo('stylesheet_directory')."/functions/functions.css", false, "1.0", "all");
}

function mx_echo_scripts()
{
?>

<?php
}
if (isset($_GET['page']) && $_GET['page'] == 'mx-settings')
{
add_action('admin_print_scripts', 'mx_scripts'); 
add_action('admin_print_styles', 'mx_style');
}
add_action('admin_head', 'mx_echo_scripts');

//menu
function mx_add_settings_page() {
add_theme_page( __( 'Theme Settings' ), __( 'Theme Settings' ), 'manage_options', 'mx-settings', 'mx_theme_settings_page');
}

add_action( 'admin_init', 'mx_theme_settings_init' );
add_action( 'admin_menu', 'mx_add_settings_page' );

//options
$slider_effects = array("random", "fade", "fold", "slideInRight", "slideInLeft", "sliceDown", "sliceDownLeft", "sliceUp", "sliceUpLeft", "sliceUpDown", "sliceUpDownLeft", "boxRandom", "boxRain", "boxRainReverse", "boxRainGrow", "boxRainGrowReverse");
$categories = get_categories('hide_empty=0&orderby=name');
$wp_cats = array();

foreach ($categories as $category_list ) {
$wp_cats[$category_list->cat_ID] = $category_list->cat_name;
}
array_unshift($wp_cats, "Choose a category"); 
function mx_theme_settings_page() {

global $wp_cats, $slider_effects;
if ( ! isset( $_REQUEST['updated'] ) )
$_REQUEST['updated'] = false;
?>

<div class="wrap">
<div id="icon-options-general" class="icon32"></div><h2>Minimnal Xpert Settings</h2>

<div id="panel-content">
<?php if ( false !== $_REQUEST['updated'] ) : ?>
<div class="updated fade"><p><strong><?php _e( 'Options saved' ); ?></strong></p></div>
<?php endif; ?>
<form method="post" action="options.php">

<?php settings_fields( 'mx_theme_settings' ); ?>
<?php $options = get_option( 'mx_theme_settings' ); ?>
            
            
<div id="wrap-left">
	<ul class="tabs">
		<li><a href="#tab1">Main</a></li>
        <li><a href="#tab2">Image Slider</a></li>
		<li><a href="#tab3">Blog</a></li>
        <li><a href="#tab4">Footer</a></li>
		<li><a href="#tab5">Tracking code</a></li>
	</ul>
</div><!-- END wrap-left -->
            
<div id="wrap-right">
<div class="tab_container">

<div id="tab1" class="tab_content">
<ul>

<li><h3><?php _e( 'Custom Logo' ); ?></h3>
<input id="mx_theme_settings[custom_logo]" class="regular-text upload_field" type="text" size="36" name="mx_theme_settings[custom_logo]" value="<?php esc_attr_e( $options['custom_logo'] ); ?>" />
<label class="description abouttxtdescription" for="mx_theme_settings[custom_logo]"><?php _e( 'Enter the URL to your custom logo' ); ?></label>
</li>

<li><h3><?php _e( 'Favicon' ); ?></h3>
<input id="mx_theme_settings[upload_favicon]" class="regular-text upload_field" type="text" size="36" name="mx_theme_settings[upload_favicon]" value="<?php esc_attr_e( $options['upload_favicon'] ); ?>" />
<label class="description abouttxtdescription" for="mx_theme_settings[upload_favicon]"><?php _e( 'Enter the URL for the site favicon.' ); ?></label>
</li>

<li><h3><?php _e( 'Homepage Text' ); ?></h3>
<textarea id="mx_theme_settings[home_text]" class="regular-text" name="mx_theme_settings[home_text]"><?php esc_attr_e( $options['home_text'] ); ?></textarea>
<label class="description" for="mx_theme_settings[home_text]"><?php _e( 'Enter your text for the homepage top part - HTML is allowed' ); ?></label>
</li>

</ul>              
</div>

<div id="tab2" class="tab_content">
<ul>

<li><h3><?php _e( 'Disable Homepage Slider' ); ?></h3>
<input id="mx_theme_settings[disable_homepage_slider]" name="mx_theme_settings[disable_homepage_slider]" type="checkbox" value="1" <?php checked( '1', $options['disable_homepage_slider'] ); ?> />
<label class="description" for="mx_theme_settings[disable_homepage_slider]"><?php _e( 'Check this box if you would like to disable the homepage slider' ); ?></label>
</li>

<li><h3><?php _e( 'Transition' ); ?></h3>
<select name="mx_theme_settings[effect]">
<?php foreach ($slider_effects as $option) { ?>
<option <?php if ($options['effect'] == $option ){ echo 'selected="selected"'; } ?>><?php echo htmlentities($option); ?></option>
<?php } ?>
</select>					
<label class="description" for="mx_theme_settings[effect]"><?php _e( 'Choose the type of transition you want your slider to have. <small>~ Default is random.</small>' ); ?></label>
</li>

<li><h3><?php _e( 'Animation Speed' ); ?></h3>
<input id="mx_theme_settings[anim_speed]" class="regular-text" type="text" name="mx_theme_settings[anim_speed]" value="<?php esc_attr_e( $options['anim_speed'] ); ?>" />
<label class="description" for="mx_theme_settings[anim_speed]"><?php _e( 'Type in the speed for the slide transitions in milliseconds. <small>~ Default is 500.</small>' ); ?></label>
</li>


<li><h3><?php _e( 'Pause Time' ); ?></h3>
<input id="mx_theme_settings[pause_time]" class="regular-text" type="text" name="mx_theme_settings[pause_time]" value="<?php esc_attr_e( $options['pause_time'] ); ?>" />
<label class="description" for="mx_theme_settings[pause_time]"><?php _e( 'This is the time the image is displayed before it transits to the next, in milliseconds. <small>~ Default is 3000.</small>' ); ?></label>
</li>
                        
</ul>
</div>
 
<div id="tab3" class="tab_content">
<ul>

<li><h3><?php _e( 'Disable Featured Images On Single Posts' ); ?></h3>
<input id="mx_theme_settings[disable_single_image]" name="mx_theme_settings[disable_single_image]" type="checkbox" value="1" <?php checked( '1', $options['disable_single_image'] ); ?> />
<label class="description" for="mx_theme_settings[disable_single_image]"><?php _e( 'Check this box if you would like to disable the thumbnail images on single posts' ); ?></label>
</li>

<li><h3><?php _e( 'Disable Next and Previous Post Links' ); ?></h3>
<input id="mx_theme_settings[disable_single_pagination]" name="mx_theme_settings[disable_single_pagination]" type="checkbox" value="1" <?php checked( '1', $options['disable_single_pagination'] ); ?> />
<label class="description" for="mx_theme_settings[disable_single_image]"><?php _e( 'Check this box if you would like to disable the next and previous links on single posts' ); ?></label>
</li>

<li><h3><?php _e( 'Disable Author Bios' ); ?></h3>
<input id="mx_theme_settings[disable_author]" name="mx_theme_settings[disable_author]" type="checkbox" value="1" <?php checked( '1', $options['disable_author'] ); ?> />
<label class="description" for="mx_theme_settings[disable_author]"><?php _e( 'Check this box if you would like to disable the author bio sections on single posts' ); ?></label>
</li>

<li><h3><?php _e( 'Disable Related Posts' ); ?></h3>
<input id="mx_theme_settings[disable_related_posts]" name="mx_theme_settings[disable_related_posts]" type="checkbox" value="1" <?php checked( '1', $options['disable_related_posts'] ); ?> />
<label class="description" for="mx_theme_settings[disable_related_posts]"><?php _e( 'Check this box if you would like to disable the related posts section' ); ?></label>
</li>

</ul>
</div>

<div id="tab4" class="tab_content">
<ul>
						
<li><h3><?php _e( 'Disable Widgetized Footer' ); ?></h3>
<input id="mx_theme_settings[extended_footer]" name="mx_theme_settings[extended_footer]" type="checkbox" value="1" <?php checked( '1', $options['extended_footer'] ); ?> />
<label class="description" for="mx_theme_settings[disable_related_posts]"><?php _e( 'Check this box if you would like to disable the widgetized footer section' ); ?></label>
</li>

</ul>
</div>
                
<div id="tab5" class="tab_content">
<ul>
						
<li><h3><?php _e( 'Analytics Code' ); ?></h3>
<textarea id="mx_theme_settings[analytics]" class="regular-text" name="mx_theme_settings[analytics]"><?php esc_attr_e( $options['analytics'] ); ?></textarea>
<label class="description" for="mx_theme_settings[analytics]"><?php _e( 'Enter your analytics tracking code' ); ?></label>
</li>

</ul>
</div>
</div><!--end tab container-->
</div><!-- END wrap-right -->
<div class="clear"></div>

			<p class="submit-changes">
				<input type="submit" class="button-primary" value="<?php _e( 'Save Options' ); ?>" />
			</p>
</form>
</div><!-- END panel-content -->
</div><!-- END wrap -->

<?php
}
//sanitize and validate
function mx_options_validate( $input ) {
	global $select_options, $radio_options;
	if ( ! isset( $input['option1'] ) )
		$input['option1'] = null;
	$input['option1'] = ( $input['option1'] == 1 ? 1 : 0 );
	$input['sometext'] = wp_filter_nohtml_kses( $input['sometext'] );
	if ( ! isset( $input['radioinput'] ) )
		$input['radioinput'] = null;
	if ( ! array_key_exists( $input['radioinput'], $radio_options ) )
		$input['radioinput'] = null;
	$input['sometextarea'] = wp_filter_post_kses( $input['sometextarea'] );

	return $input;
}

?>