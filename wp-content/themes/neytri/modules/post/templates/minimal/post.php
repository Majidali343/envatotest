<?php
	$template_args['post_ID'] = $ID;
	$template_args['post_Style'] = $Post_Style;
	$template_args = array_merge( $template_args, neytri_single_post_params() ); ?>

    <?php neytri_template_part( 'post', 'templates/'.$Post_Style.'/parts/image', '', $template_args ); ?>

    <!-- Post Dynamic -->
    <?php echo apply_filters( 'neytri_single_post_dynamic_template_part', neytri_get_template_part( 'post', 'templates/'.$Post_Style.'/parts/dynamic', '', $template_args ) ); ?><!-- Post Dynamic -->