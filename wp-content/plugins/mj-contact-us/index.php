<?php
/*
Plugin Name: MJ Contact us
Plugin URI: http://mecontact.wordpress.com/mj-contact-us-plugin/
Description: mj contact us a simple form with 4-5 fields to send email address to admin . its a simple contact us form with easy to customize coding standard and easy to customize html standard. <strong>add this code</strong> [mjcontactus] <strong>in page from admin section to activate plugin form also be sure that you have get_header() function in your header file so that validation can be work properly</strong>
Author: anil kumar
Version: 5.2
Author URI: http://about.me/anilDhiman
*/

include( plugin_dir_path( __FILE__ ) . 'files/includes.php');

add_action("wp_enqueue_scripts", "my_jquery_enqueue"); 
add_shortcode('mjcontactus', 'mj_contact_us');
add_action('admin_menu', 'AdminIndex');
add_action( 'admin_init', 'my_jquery_enqueue' );
function my_jquery_enqueue() {
   wp_deregister_script('mjform');
   wp_register_script( 'mjform', plugins_url( '/js/mj.js', __FILE__ ),'','1.0'  );  
   wp_register_script( 'mjvalidation', plugins_url( '/js/jquery.validate.js', __FILE__ ) );  
   wp_enqueue_script('jquery');
   wp_enqueue_script('mjvalidation');
   wp_register_style( 'mjform', plugins_url( '/css/mj.css', __FILE__ ) );  
   wp_enqueue_style( 'mjform' );  
}
 

function mj_contact_us(){ 
	$object	=	new mjContactHTML;
    $object->SendMail();
    $object->mjForm();
}
function AdminIndex(){
	add_menu_page('Mj Contact US', 'Mj Contact US', 'manage_options', 'mj-mainpage', 'AdminMainPage');
}
function AdminMainPage(){
	$obj	=	new mjContactPRO;
	$obj->AdminSwitch();
}
?>
