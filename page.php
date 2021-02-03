<?php get_header(); ?>
	<div class="cols fx-row sect">
		<main class="col-left fx-1">
			<div class="speedbar nowrap"><span class="far fa-home"></span>
				<?php post_breadcrumbs(); ?>
			</div>
			<div id='dle-content'>
				<article class="article">
					<div class="fheader ignore-select fx-row fx-middle">
						<h1><?php the_title() ?></h1>
						<div class="fimg img-box img-fit ignore-select">
							<?php if(has_post_thumbnail()): ?>
		 						<?php the_post_thumbnail(); ?>
		 						<?php else: ?>
		 							<img src="/wp-content/themes/nano/images/no_image.jpg" alt="нет фото">
	 						<?php endif; ?>
							<div class="fimg-btm fx-row fx-middle">
								<div class="tile-meta fx-row fx-middle icon-left">
									<div class="tile-views"><span class="far fa-clock"></span><?php the_date('h:m, d M Y') ?></div>
									<div class="tile-views"><span class="far fa-eye"></span><?php echo do_shortcode( '[ngd-single-post-view]' ); ?></div>
									<div class="tile-comms"><span class="far fa-comment-alt-dots"></span><?php echo $post->comment_count; ?></div>
								</div>
							</div>
						</div>
					</div>


				    <div class="ftext fx-row">
						<div class="fctrl ignore-select">
							<div class="fshare">
								<span class="fab fa-facebook-f" data-id="fb"></span>
								<span class="fab fa-vk" data-id="vk"></span>
								<span class="fab fa-odnoklassniki" data-id="ok"></span>
								<span class="fab fa-twitter" data-id="tw"></span>
								<span class="fas fa-paper-plane" data-id="tlg"></span>
							</div>
						</div>
						<!-- end share buttons -->

						<div class="fdesc full-text video-box clearfix fx-1">
							<?php echo get_the_content(); ?>
						</div>
						<!-- end content -->
					</div>
				</article>
				<div class="ftext fx-row">
					<?php if( comments_open() ): ?>
						<div class="fcomms ignore-select sect hidden" id="full-comms">
							<?php comments_template(  ); ?>
						</div>
						<div class="sect sect-border ignore-select com-wr">
							<div class="sect-header fx-row fx-middle">
								<div class="sect-title fx-1 title sect-title-small">Комментарии</div>
							</div>
						       
						    <?php if ( have_comments() ): ?>
						       
								<div id="dle-ajax-comments">
									<?php
										wp_list_comments( array(
											'type'		=> 'comment',
											'style'      => 'div',
											'short_ping' => true,
											'callback' => 'my_comments_callback'
										) );
									?>
								</div>
							<?php endif; ?>
							<br>
					        <div class="faddcomms icon-left"><span class="far fa-comment-alt-dots"></span> Добавить комментарий </div>
					        <br>
						</div>
						<!-- end comments -->
					<?php endif; ?>
					
					</div>
			</div>
		</main>
		<?php dynamic_sidebar('sidebar'); ?>
		<!--  end sidebar -->

	</div>
<?php get_footer(); ?>