<?php
// load the theme options
$options = get_option( 'mx_theme_settings' );
?>
<?php get_header(); ?>
<div id="post-content">
  <div class="single-entry clearfix">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <h1><?php the_title(); ?></h1>
    <?php
    if ( is_singular( 'players' ) ):
    $fb_link      = get_post_meta(get_the_ID(), 'fb_link', 'true');
    $twitter_link = get_post_meta(get_the_ID(), 'twitter_link', 'true');
    ?>
      <nav class="player-links-out clear">
        <header>
          <h1>Social Networks:</h1>
        </header>
        <ul>
          <li>
            <a href="<?php echo $fb_link; ?>" target="_blank">
              <img src="<?php bloginfo( 'template_directory' ) ?>/images/icons/fb.png" alt="Facebook">
            </a>
          </li>
          <li>
            <a href="<?php echo $twitter_link; ?>" target="_blank">
              <img src="<?php bloginfo( 'template_directory' ) ?>/images/icons/twitter.png" alt="Twitter">
            </a>
          </li>
        </ul>
      </nav>

    <?php else: ?>

      <div class="post-entry-meta">
        <span class="meta-date"><?php the_time('F jS, Y') ?></span><span class="meta-category"><?php the_category(' &bull; '); ?></span><span class="meta-comments"><?php comments_popup_link('0 Comments', '1 Comment', '% Comments'); ?></span>
      </div>

    <?php endif; ?>
    <!-- END post-entry-meta -->

  <?php
  if ( is_singular( 'players' ) )
  {
    $display_bio = $bio = '';
    $home_town          = get_post_meta(get_the_ID(), 'home_town', 'true');
    $date_joined        = get_post_meta(get_the_ID(), 'date_joined', 'true');
    $career_highlights  = get_post_meta(get_the_ID(), 'career_highlights', 'true');
    $bio .= strlen($home_town) > 0 ? '<section><h1>Hometown:</h1><p>' . $home_town . '</p></section>': '';
    $bio .= strlen($date_joined) > 0 ? '<section><h1>Date Joined:</h1><time datetime="' . $date_joined .'">' . date('d F Y', strtotime($date_joined)) . '</time></section>': '';
    $bio .= strlen($career_highlights) > 0 ? '<section><h1>Career Highlights:</h1><p>' . $career_highlights . '</p></section>': '';
    $display_bio  = strlen($bio) > 0 ? '<aside class="player-bio"><header><h1>Quick Info</h1></header>' . $bio . '</aside>' : '';
    if ( strlen($display_bio) > 0)
    {
      echo '<article>';
      echo $display_bio;
      echo '<section class="player-profile">';
      if ( has_post_thumbnail() )
      {
        if ($options['disable_single_image'] != true)
        {
          echo '<div id="single-featured-image">';
          the_post_thumbnail('post-image');
          echo '</div>';
        }
      }
      the_content();
      echo '</section>';
      echo '</article>';
    }else{
      if ( has_post_thumbnail() )
      {
        if ($options['disable_single_image'] != true)
        {
          echo '<div id="single-featured-image">';
          the_post_thumbnail('post-image');
          echo '</div>';
        }
      }
      the_content();
    }
  }else{

    if ( has_post_thumbnail() )
    {
      if ($options['disable_single_image'] != true)
      {
        echo '<div id="single-featured-image">';
        the_post_thumbnail('post-image');
        echo '</div>';
      }
    }
    the_content();
  }
  ?>
  <div class="clear"></div>
  <?php wp_link_pages('before=<div id="post-page-navigation">&after=</div>'); ?>

  <?php
  if ($options['disable_single_pagination'] != true)
  {
  ?>
    <div id="single-nav" class="clearfix">
      <div id="single-nav-left"><?php previous_post_link('%link', 'Last Post', TRUE); ?></div>
      <div id="single-nav-right"><?php next_post_link('%link', 'Next Post', TRUE); ?></div>
    </div>
    <!-- END single-nav -->
  <?php
  }
  ?>

  <div class="post-entry-bottom">
    <?php the_tags('<div class="post-tags">',' ','</div>'); ?>
    <!-- END post-category -->
  </div>
  <!-- END post-entry-bottom -->

  </div>
  <!-- END post-entry -->
  <?php endwhile; ?>
  <?php endif; ?>

  <?php
  if ($options['disable_author'] != true)
  {
  ?>
    <div id="post-author" class="clearfix">
      <div id="author-avatar">
        <?php echo get_avatar( get_the_author_email(), '50' ); ?>
      </div>
      <!-- END author-avatar -->
      <div id="author-description">
        <h4>About The Author</h4>
        <?php the_author_description(); ?>
      </div>
      <!-- END author-description -->
    </div>
    <!-- END post-author -->
  <?php
  }
  ?>

  <?php
  if ($options['disable_related_posts'] != true)
  {
  ?>
    <div id="related-posts" class="clearfix">
      <h3>Related Posts</h3>
      <?php
      $category = get_the_category(); //get first current category ID
      $this_post = $post->ID; // get ID of current post
      $posts = get_posts('numberposts=3&orderby=rand&category=' . $category[0]->cat_ID . '&exclude=' . $this_post);
      ?>

      <?php
      foreach($posts as $post)
      {
        if ( has_post_thumbnail() )
        {
      ?>
          <div class="related-post clearfix">
            <div class="related-posts-thumbnail">
              <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" class="opacity"><?php the_post_thumbnail('related-posts'); ?></a>
            </div>
            <!-- /related-posts-thumbnail -->
            <div class="related-posts-content">
              <h4><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
              <?php the_news_excerpt('20','','','plain','no'); ?>
            </div>
            <!-- /related-posts-content -->
          </div>
          <!-- /related-post -->
      <?php
        }
      }
      wp_reset_postdata();
      ?>
    </div>
    <!-- END related-posts -->
    <div class="clear"></div>
  <?php
  }
  ?>

<?php comments_template(); ?>
</div>
<!-- END post-content -->
<?php get_sidebar(); ?>
<div class="clear"></div>
<?php get_footer(); ?>