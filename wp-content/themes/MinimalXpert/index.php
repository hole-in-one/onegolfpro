<?php
	// load the theme options
	$options = get_option( 'mx_theme_settings' ); 
?>
<?php get_header(' '); ?>

<div id="post-content">

<?php if (have_posts()) : ?>              
<?php get_template_part( 'post' , 'entry') ?>                	
<?php endif; ?>   
            
<?php if (function_exists("pagination")) { pagination($additional_loop->max_num_pages); } ?>
</div>
<!-- END post-content -->

<?php get_sidebar(); ?>
<div class="clear"></div>
<?php get_footer(' '); ?>