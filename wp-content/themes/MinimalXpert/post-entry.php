<?php while (have_posts()) : the_post(); ?>      

    <div class="post-entry clearfix">
        <?php if ( has_post_thumbnail() ) {  ?>
        
        <div class="post-entry-featured-image">
			<a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>" class="opacity"><?php the_post_thumbnail('post-image'); ?></a>
        </div>
        <!-- END post-entry-featured-image -->
        
    <div class="post-entry-content">
        	<h2><a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
					<?php the_news_excerpt('50','','','plain','no'); ?>
                    <a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>" class="read-more">Read More →</a>
        </div><!-- END post-entry-content -->
      
   <?php } else{ ?>
   <h2><a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
			<?php the_news_excerpt('50','','','plain','no'); ?>.
            <a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>" class="read-more">Read More →</a>
   <?php } ?>
 	</div>
	<!-- END post-entry -->

<?php endwhile; ?>
