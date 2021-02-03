
	<div class="short-item">
		<a class="short-img img-resp img-fit anim" href="<?php echo get_post_permalink(); ?>">
			<?php if(has_post_thumbnail()): ?>
					<?php echo get_the_post_thumbnail(); ?>
					<?php else: ?>
						<img src="/wp-content/themes/nano/images/no_image.jpg" alt="нет фото">
				<?php endif; ?>
		</a>
		<div class="short-text">
			<div class="short-meta fx-row fx-middle icon-left">								
				<div class="short-views"><span class="far fa-eye"></span><?php echo do_shortcode( '[ngd-single-post-view]' ); ?></div>
				<div class="short-comms fx-1"><span class="far fa-comment-alt-dots"></span><?php $comm = get_comment_count(get_the_ID()); echo $comm['approved']; ?></div>
				<div class="short-date nowrap"><span class="far fa-calendar-alt"></span><?php echo get_the_date('d\.m\.y'); ?></div>
			</div>
			<a class="short-title title anim" href="<?php echo  get_post_permalink(); ?>"><?php echo get_the_title(); ?></a>
		</div>
	</div>