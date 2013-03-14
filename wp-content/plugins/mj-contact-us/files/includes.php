<?php 

ob_start();
$upload_dir	=	wp_upload_dir();
/* defined variables */
$atn	=	(isset($_REQUEST['atn'])) ? $_REQUEST['atn'] :  '';
DEFINE('NAME', 'mj-contact-us');
DEFINE('IMGPATH' , plugins_url('/'.NAME.'/images/'));
DEFINE('CSSPATH' , plugins_url('/'.NAME.'/css/mj.css'));
DEFINE('URL' , admin_url('admin.php?page=mj-mainpage'));
DEFINE('ACTION' , $atn);

include( plugin_dir_path( __FILE__ ) . '/simple-php-captcha.php');
include( plugin_dir_path( __FILE__ ) . '/mj-class-functions.php');
include( plugin_dir_path( __FILE__ ) . '/mj-class-process.php');
include( plugin_dir_path( __FILE__ ) . '/mj-class-html.php');

?>