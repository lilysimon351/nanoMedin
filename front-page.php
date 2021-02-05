<?php get_header(); ?>
    	<?php
    		$cat_ids = array( 3, 2);
    		foreach ($cat_ids as $cat_id):
        		$q = new WP_Query("cat=$cat_id&orderby=date&order=DESC&post_type=post&posts_per_page=4"); ?>
        		
			<div class="sect">
        		<?php
        		if( $q->have_posts() ): ?>
		        	
	    			<div class="sect-header fx-row fx-middle">
	    				<div class="sect-title fx-1 title"><?php echo get_cat_name($cat_id); ?></div>
	    				<a href="<?php echo get_category_link($cat_id); ?>" class="sect-link icon-left">Смотреть все рейтинги</a>
	    			</div>
	    			<div class="sect-content sect-grid">
	    				<?php $i = 0; ?>

						<?php while ( $q->have_posts() ) : ?>
			 				<?php $q->the_post(); ?>

			 				<?php if($i == 0): ?>
			 					<?php $class = "big"; ?>
			 				<?php elseif($i == 2): ?>
			 					<?php $class = "tall"; ?>
			 				<?php elseif($i == 1 || $i == 3): ?>
			 					<?php $class = "small"; ?>
			 				<?php endif; ?>

			 				<?php include( locate_template('post-templates/tile-item.php') ) ; ?>

			 				<?php $i++; ?>	
			 			<?php endwhile; ?>

	    			</div>
        	<?php else: ?>
        			<p>нет, постов</p>
        	<?php endif; ?>
        </div>
        <?php endforeach; ?>

	<!-- end categories posts -->

	<div class="sect">
		<div class="sect-header fx-row fx-middle">
			<div class="sect-title fx-1 title">Свежие публикации</div>
		</div>
		<div class="sect-content">
			<div id='dle-content'>
				<?php global $wp_query; ?>
					<?php 

	        		if( $wp_query->have_posts() ): ?>
			        	
						<?php while ( $wp_query->have_posts() ) : ?>
			 				<?php $wp_query->the_post(); ?>

			 				<?php get_template_part('post-templates/short-item') ; ?>

			 			<?php endwhile; ?>

		        	<?php else: ?>
		        			<p>нет, постов</p>
		        	<?php endif; ?>

			</div>
			<?php if($wp_query->max_num_pages > 1): ?>
				<!--noindex-->
			<div class="bottom-nav clr ignore-select" id="bottom-nav">					
				<div class="nav-load" id="nav-load"><a href="#" data-page-num="<?php echo  $wp_query->max_num_pages; ?>" data-offset="1" rel="nofollow">Загрузить еще</a></div>	
			</div>
				<!--/noindex-->
			<?php endif; ?>
			
		</div>
	</div>
	<!-- end fresh posts -->

<?php get_footer(); ?>
