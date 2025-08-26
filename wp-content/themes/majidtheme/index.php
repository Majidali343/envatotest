<?php get_header(); ?>
<main id="content" class="container">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<article <?php post_class(); ?>>
<h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
<div class="entry-summary"><?php the_excerpt(); ?></div>
</article>
<?php endwhile; the_posts_pagination(); else: ?>
<p><?php _e('Nothing here yet.', 'portfolia'); ?></p>
<?php endif; ?>
</main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>