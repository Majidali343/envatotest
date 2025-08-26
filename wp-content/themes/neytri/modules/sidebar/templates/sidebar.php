<?php
$sidebar_class   = neytri_get_secondary_classes();
$active_sidebars = neytri_get_active_sidebars();

if( $sidebar_class == 'content-full-width' || $sidebar_class == '' ) {
    return;
}

if( empty( $active_sidebars ) ) {
    return;
}?>
<!-- Secondary -->
<section id="secondary" class="<?php echo esc_attr( $sidebar_class ); ?>"><?php
    do_action( 'neytri_before_single_sidebar_wrap' );

    get_sidebar();

    do_action( 'neytri_after_single_sidebar_wrap' );?>
</section><!-- Secondary End -->