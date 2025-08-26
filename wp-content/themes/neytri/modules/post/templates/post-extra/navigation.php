<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>

<!-- Entry Navigation -->
<div class="entry-post-navigation"><?php
	if( ! is_attachment() ) :
		$prev_post = get_previous_post();
		if( !empty( $prev_post ) ):	?>

			<div class="post-prev-link"><?php
				if( has_post_thumbnail( $prev_post->ID ) ):
					$entry_bg = '';
					$url = get_the_post_thumbnail_url( $prev_post->ID, 'full' );
					$entry_bg = "style=background-image:url(".$url.")"; ?>

					<a href="<?php echo get_permalink( $prev_post->ID ); ?>" <?php echo esc_attr($entry_bg);?> class="prev-post-bgimg"></a><?php
				endif; ?>

				<div class="nav-title-wrap">
					<p><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 100" style="enable-background:new 0 0 100 100;" xml:space="preserve"><path d="M3.5,53.8L3.5,53.8c-0.2-0.5-0.3-0.9-0.4-1.4c0,0,0,0,0-0.1c-0.2-0.9-0.2-1.8,0-2.7c0,0,0,0,0-0.1 c0.1-0.4,0.2-0.9,0.4-1.3v-0.1c0.2-0.4,0.4-0.8,0.6-1.2v-0.1c0.3-0.4,0.6-0.8,0.9-1.1l29.7-29.6c2.9-2.9,7.6-2.9,10.5,0 c2.9,2.9,2.9,7.6,0,10.5l0,0l-16.9,17h62.3c4.1,0,7.4,3.3,7.4,7.4s-3.3,7.4-7.4,7.4H28.3l16.9,17c2.9,2.8,3,7.5,0.2,10.5 c-2.8,2.9-7.5,3-10.5,0.2c-0.1-0.1-0.1-0.1-0.2-0.2L5.1,56.2c-0.3-0.4-0.6-0.7-0.9-1.1V55C4,54.6,3.8,54.2,3.5,53.8"/></svg><a href="<?php echo get_permalink( $prev_post->ID ); ?>" title="<?php echo esc_attr($prev_post->post_title); ?>"><?php esc_html_e('Previous Story','neytri'); ?></a></p>
					<h3><a href="<?php echo get_permalink( $prev_post->ID ); ?>" title="<?php echo esc_attr($prev_post->post_title); ?>"><?php
						if( get_the_title( $prev_post->ID ) == '') {
							echo esc_html__('Previous Post', 'neytri');
						} else {
							echo "$prev_post->post_title";
						} ?></a>
					</h3>
				</div>

			</div>
			<?php
		else: ?>
			<div class="post-prev-link no-post">
                <a href="#" style="background-image:url(<?php echo esc_url(NEYTRI_ROOT_URI.'/assets/images/no-post.jpg') ?>);" class="prev-post-bgimg"></a>
				<div class="nav-title-wrap">
					<span class="zmdi zmdi-long-arrow-left zmdi-hc-fw"></span>
					<h3><?php echo esc_html__('No previous story to show!', 'neytri'); ?></h3>
				</div>
			</div>
			<?php
		endif;

		$next_post = get_next_post();
		if( !empty( $next_post ) ):	?>
			<div class="post-next-link"><?php

				if( has_post_thumbnail( $next_post->ID ) ):
					$entry_bg = '';
					$url = get_the_post_thumbnail_url( $next_post->ID, 'full' );
					$entry_bg = "style=background-image:url(".$url.")"; ?>

					<a href="<?php echo get_permalink( $next_post->ID ); ?>" <?php echo esc_attr($entry_bg);?> class="next-post-bgimg"></a><?php
				endif; ?>

				<div class="nav-title-wrap">
					<p><a href="<?php echo get_permalink( $next_post->ID ); ?>" title="<?php echo esc_attr($next_post->post_title); ?>"><?php esc_html_e('Next Story','neytri'); ?></a><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 100" style="enable-background:new 0 0 100 100;" xml:space="preserve"><path d="M97.5,53.8L97.5,53.8c0.2-0.5,0.3-0.9,0.4-1.4c0,0,0,0,0-0.1c0.2-0.9,0.2-1.8,0-2.7c0,0,0,0,0-0.1 c-0.1-0.4-0.2-0.9-0.4-1.3v-0.1c-0.2-0.4-0.4-0.8-0.6-1.2v-0.1c-0.3-0.4-0.6-0.8-0.9-1.1L66.3,16.2c-2.9-2.9-7.6-2.9-10.5,0 s-2.9,7.6,0,10.5l0,0l16.9,17H10.4C6.3,43.6,3,46.9,3,51s3.3,7.4,7.4,7.4h62.3l-16.9,17c-2.9,2.8-3,7.5-0.2,10.5 c2.8,2.9,7.5,3,10.5,0.2c0.1-0.1,0.1-0.1,0.2-0.2l29.6-29.6c0.3-0.4,0.6-0.7,0.9-1.1V55C97,54.6,97.2,54.2,97.5,53.8"/></svg></p>
					<h3><a href="<?php echo get_permalink( $next_post->ID ); ?>" title="<?php echo esc_attr($next_post->post_title); ?>"><?php
						if(get_the_title( $next_post->ID ) == '') {
							echo esc_html__('Next Post', 'neytri');
						} else {
							echo "$next_post->post_title";
						} ?></a>
					</h3>
				</div>

			</div>
			<?php
		else: ?>
			<div class="post-next-link no-post">
                <a href="#" style="background-image:url(<?php echo esc_url(NEYTRI_ROOT_URI.'/assets/images/no-post.jpg') ?>);" class="next-post-bgimg"></a>
				<div class="nav-title-wrap">
					<span class="zmdi zmdi-long-arrow-right zmdi-hc-fw"></span>
					<h3><?php echo esc_html__('No next story to show!', 'neytri'); ?></h3>
				</div>
			</div>
			<?php
		endif;
	endif; ?></div><!-- Entry Navigation -->