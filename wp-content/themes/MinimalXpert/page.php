<?php get_header(); ?>
<div id="post-content" class="clearfix">
  <?php
  if (have_posts()) :
    while (have_posts()) :
      the_post();
  ?>
      <h1 class="page-title"><?php the_title(); ?></h1>
      <?php the_content(); ?>
  <?php
    endwhile;
  endif;
  comments_template();
  if(str_replace(home_url('/'), '', trim(get_page_link(), '/')) == 'contact-us')
  {

    echo '<div id="enquiries_form">';
    echo do_shortcode("[mjcontactus]");
    echo '</div>';

  }
  ?>
</div>

<!-- END post-content -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>