<?php

if( ! function_exists('neytri_event_breadcrumb_title') ) {
    function neytri_event_breadcrumb_title($title) {
        if( get_post_type() == 'tribe_events' && is_single()) {
            $etitle = esc_html__( 'Event Detail', 'neytri' );
            return '<h1>'.$etitle.'</h1>';
        } else {
            return $title;
        }
    }

    add_filter( 'neytri_breadcrumb_title', 'neytri_event_breadcrumb_title', 20, 1 );
}

?>