<?php
add_action( 'neytri_after_main_css', 'footer_style' );
function footer_style() {
    wp_enqueue_style( 'neytri-footer', get_theme_file_uri('/modules/footer/assets/css/footer.css'), false, NEYTRI_THEME_VERSION, 'all');
}

add_action( 'neytri_footer', 'footer_content' );
function footer_content() {
    neytri_template_part( 'content', 'content', 'footer' );
}