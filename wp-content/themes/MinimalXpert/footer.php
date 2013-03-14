<?php $options = get_option( 'mx_theme_settings' );  ?>
<div class="clear"></div>
</div>
<!-- END main -->
</div>
<!-- END wrap -->

<?php
    // check if the extended footer is disabled, if not show it
    if ($options['extended_footer'] != true) { ?>
<div id="footer-widgets" class="clearfix">
            <div class="footer-widget">
            	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('First Footer Area') ) : ?><?php endif; ?>
            </div>
            <!-- END footer-widget -->
            <div class="footer-widget">
            	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Second Footer Area') ) : ?><?php endif; ?>
            </div>
            <!-- END footer-widget -->
            <div class="footer-widget">
            	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Third Footer Area') ) : ?><?php endif; ?>
            </div>
            <!-- END footer-widget -->
            <div class="footer-widget remove-margin">
            	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Fourth Footer Area') ) : ?><?php endif; ?>
            </div>
            <!-- END footer-widget -->
        </div>
    	<!-- END footer-widgets -->

    </div>
	<!-- END footer -->
<?php } ?>

<div id="copyright">
<p><?php echo '&copy; ' . date('Y'); ?>  <?php bloginfo( 'name' ) ?></p>
</div>
<!-- END copyright - theme by WPExplorer.com -->
<!-- WP Footer -->
<?php wp_footer(); ?>
</body>
</html>