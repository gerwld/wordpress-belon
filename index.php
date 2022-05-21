<?php get_header(); ?>

<div class="lastposts_block content_wrapper">
<?php
if (have_posts()) :
  while (have_posts()) : the_post(); ?>
  <div class="post_block">
    <h2>
      <a href="<?php the_permalink(); ?>"><?php the_title() ?></a>
    </h2>
    <?php the_excerpt() ?>
  </div>
<?php endwhile;
else :
  echo `<p>There are no posts!</p>`;
endif;
?>
</div>
<?php get_footer(); ?>