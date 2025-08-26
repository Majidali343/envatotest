<?php get_header(); ?>
<main id="content" class="container">
<h1 class="entry-title"><?php _e('Portfolio', 'portfolia'); ?></h1>
<?php if ( have_posts() ) : ?>
<div class="grid">
<?php while ( have_posts() ) : the_post(); ?>
<article <?php post_class(); ?>>
<a href="<?php the_permalink(); ?>">
<?php if ( has_post_thumbnail() ) {
the_post_thumbnail('portfolio-thumb');
} ?>
<h2 class="entry-title"><?php the_title(); ?></h2>
</a>
<div class="entry-excerpt"><?php the_excerpt(); ?></div>
</article>
<?php endwhile; ?>
</div>
<?php the_posts_pagination(); ?>
<?php else: ?>
<p><?php _e('No projects yet.', 'portfolia'); ?></p>
<?php endif; ?>
</main>
<?php get_footer(); ?>