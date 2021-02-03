		

		<a class="tile-item img-box img-fit tile-item-<?php echo $class; ?>" href="<?php echo get_post_permalink(); ?>">
				<?php if(has_post_thumbnail()): ?>
					<?php echo get_the_post_thumbnail(); ?>
					<?php else: ?>
						<img src="/wp-content/themes/nano/images/no_image.jpg" alt="нет фото">
				<?php endif; ?>
			<div class="tile-item-text">
				<div class="tile-item-title title"><?php echo get_the_title(); ?></div>
				<?php if( $i == 0 ): ?>
					<div class="tile-item-desc">...</div>
				<?php endif; ?>
				
				<div class="tile-meta fx-row fx-middle icon-left">
					<?php if( $i == 0 ): ?>
						<div class="tile-cat nowrap fx-1"><?php echo get_cat_name($cat_id); ?></div>
					<?php endif; ?>
					<div class="tile-views"><span class="far fa-eye"></span><?php echo do_shortcode( '[ngd-single-post-view]' ); ?></div>
					<div class="tile-comms"><span class="far fa-comment-alt-dots"></span><?php $comm = get_comment_count(get_the_ID()); echo $comm['approved']; ?></div>
				</div>
			</div>
		</a>