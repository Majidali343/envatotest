<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="site-header">
<div class="container">
<div class="branding">
<?php if ( has_custom_logo() ) { the_custom_logo(); } else { ?>
<a href="<?php echo esc_url(home_url('/')); ?>" class="site-title"><?php bloginfo('name'); ?></a>
<?php } ?>
</div>
<nav class="primary-nav" aria-label="<?php esc_attr_e('Primary Menu', 'portfolia'); ?>">
<?php wp_nav_menu([
'theme_location' => 'primary',
'container' => false,
'fallback_cb' => false,
'menu_class' => 'menu',
]); ?>
</nav>
</div>
</header>