<?php $options = get_option( 'mx_theme_settings' ); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
  <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
  <title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>
  <!-- Stylesheet & Favicon -->
  <link rel="icon" type="image/png" href="<?php echo $options['upload_favicon']; ?>" />
  <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />
  <!-- Google Fonts -->
  <link href='http://fonts.googleapis.com/css?family=Droid+Serif:regular,bold' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:regular,bold' rel='stylesheet' type='text/css'>
  <!-- WP Head -->
  <?php if ( is_single() || is_page() ) wp_enqueue_script( 'comment-reply' ); ?>
  <?php wp_head(); ?>

  <script type="text/javascript" charset="utf-8">
  jQuery(function($){
  	$(document).ready(function(){
  		$('.opacity').css('opacity',1).hover(
  		function() {
  			$(this).fadeTo(250,0.5);},
  		function() {
  			$(this).fadeTo(600,1);
  		} );
  	// sliding links
  		slide(".sub-menu", 20, 15, 10, .5);
  		slide(".footer-box", 5, 0, 150, .8);
  	// superFish
  	$('ul.sf-menu').supersubs({
  		minWidth:    18, // minimum width of sub-menus in em units
  		maxWidth:    40, // maximum width of sub-menus in em units
  		extraWidth:  1 // extra width can ensure lines don't sometimes turn over
       })
      	.superfish(); // call supersubs first, then superfish
  	});
  });
  </script>

  <?php if(is_front_page())
  {
  ?>

    <script type="text/javascript">
    jQuery(function($){
    $(window).load(function() {
    //homepage Slider
    	$('#slider').nivoSlider({
    		directionNav: true,
    		directionNavHide: true,
    		captionOpacity: 0.8,
    		controlNav: false,
    		boxCols: 8,
    		boxRows: 4,
    		slices: 15,
    		effect:'<?php if($options['effect'] != '') { echo $options['effect']; } else { echo 'fade'; } ?>',
    		animSpeed: <?php if($options['anim_speed'] != '') { echo $options['anim_speed']; } else { echo 500; } ?>,
    		pauseTime: <?php if($options['pause_time'] != '') { echo $options['pause_time']; } else { echo 3000; } ?>
    	});
    	});
    });
    </script>

  <?php
  }
  echo stripslashes($options['analytics']);
  ?>
</head>
<body <?php body_class($class); ?>>
<div id="wrap">
	<div id="header" class="clearfix">
    	<div id="logo">
        	<?php if($options['custom_logo']) { ?>
            <a href="<?php bloginfo( 'url' ) ?>/" title="<?php bloginfo( 'name' ) ?>" rel="homepage"><img src="<?php echo $options['custom_logo']; ?>" alt="<?php bloginfo( 'name' ) ?>" /></a>
            <?php } else { ?>
        	<?php if (is_front_page()) { ?>
            <h1><a href="<?php bloginfo( 'url' ) ?>/" title="<?php bloginfo( 'name' ) ?>" rel="home"><?php bloginfo( 'name' ) ?></a></h1>
            <?php } else { ?>
        	<h2><a href="<?php bloginfo( 'url' ) ?>/" title="<?php bloginfo( 'name' ) ?>" rel="home"><?php bloginfo( 'name' ) ?></a></h2>
            <?php } ?>
            <p><?php bloginfo( 'description' ) ?></p>
            <?php } ?>
        </div>
        <!-- END logo -->
        <div class="clear"></div>
</div><!-- END header -->
<div id="navigation" class="clearfix">
			<?php
            //define main navigation
            wp_nav_menu( array(
            	'theme_location' => 'main nav',
            	'sort_column' => 'menu_order',
            	'menu_class' => 'sf-menu',
            	'fallback_cb' => 'default_menu'
            )); ?>
</div>
<!-- END navigation -->
<?php if ($options['disable_homepage_slider'] != true) { ?>
<?php if(is_front_page()) { ?>
<?php
// get custom post type ==> slides
global $post;
$args = array(
	'post_type' =>'slides',
	'numberposts' => -1,
	'orderby' => 'ASC'
);
$slider_posts = get_posts($args);
?>
<?php if($slider_posts) { ?>
<div id="slider" class="nivoSlider">
<?php
	foreach($slider_posts as $post) : setup_postdata($post);
	$thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'slider');
	// get metabox data
	$slidelink = get_post_meta($post->ID, 'slides_url', TRUE);
?>

      <?php if ( has_post_thumbnail() ) { ?>
		<?php
		// show link with slide if meta exists
		if($slidelink != '') { ?>
     	<a href="<?php echo $slidelink ?>" title="<?php the_title(); ?>"><img src="<?php echo $thumbnail[0]; ?>" alt="<?php the_title(); ?>" width="960" title="<?php the_title(); ?>" /></a>
        <?php
         // no meta link defined, show plain img
        } else { ?>
        <img src="<?php echo $thumbnail[0]; ?>" alt="<?php the_title(); ?>" width="960" height="360" title="<?php the_title(); ?>" />
        <?php } } ?>
<?php endforeach; ?>
</div>
<!-- END slider -->

<?php } wp_reset_postdata(); // there are no slides ?>
<?php } ?>
<?php } ?>

<div id="main">
<?php if(is_front_page()) { ?>
<?php if ($options['home_text'] !='') { ?>
<div id="home-quote">
	<?php echo stripslashes($options['home_text']);  ?>
</div>
<!-- END homepage-quote -->
<?php } ?>
<?php } ?>